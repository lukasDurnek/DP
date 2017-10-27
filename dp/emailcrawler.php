<?php

class scraper
{
    var $startURL;
    var $allowedExtensions = array('.css', '.xml', '.rss', '.ico', '.js', '.gif', '.jpg', '.jpeg', '.png', '.bmp', '.wmv', '.avi', '.mp3', '.flash', '.swf', '.css');
    var $useURL;
    var $startPath;
    var $array;

    function setStartPath($path = NULL)
    {

        if ($path != NULL) $this->startPath = $path;
        else {
            $temp = explode('/', $this->startURL);
           // echo $temp[0] . ' ' . $temp[1];
            $this->startPath = $temp[0] . '//' . $temp[2];
        }
    }

    function startURL($theURL)
    {
        $this->startURL = $theURL;
    }

    function getContents($url)
    {
        $ch = curl_init(); // initialize curl handle
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7);
        curl_setopt($ch, CURLOPT_REFERER, 'http://' . $this->useURL);
        curl_setopt($ch, CURLOPT_URL, $url); // set url to post to
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
        curl_setopt($ch, CURLOPT_TIMEOUT, 50); // times out after 50s
        curl_setopt($ch, CURLOPT_POST, 0); // set POST method
        $buffer = curl_exec($ch); // run the whole process
        curl_close($ch);
        return $buffer;
    }

    function startScraping($array, $meno, $priezvisko, $id, $spojenie)
    {
        $pageContent = $this->getContents($this->startURL);
        echo "1" . $this->startURL;
        preg_match_all('/([\w+\.]*\w+@[\w+\.]*\w+[\w+\-\w+]*\.\w+)/is', $pageContent, $results);
        $insertCount = 0;
        var_dump($results);
        echo $pageContent;
        foreach ($results[1] as $curEmail) {
            if (!in_array($curEmail, $array)) {
                $array[] = $curEmail;
                echo "$curEmail <br><br><br>";
                $mail_male = strtolower($curEmail);
                $hash_delete = sha1("table=kontakt&text=web&action=delete&idintable=" . $mail_male);
                $sql = $spojenie->query("insert into $_SESSION[TableMail](id_kontakt, mail, mail_male, poslat, vymazany, zdroj, hash_delete) values('$id', '$curEmail','$mail_male','true','false','$_SESSION[login]','$hash_delete')");
            }
        }
        var_dump($array);

        preg_match_all('/href="([^"]+)"/Umis', $pageContent, $results);
        $currentList = $this->cleanListURLs($results[1]);
        $insertURLCount = 0;
        if ($this->startURL == NULL) {
            return;
        }
        unset($results, $pageContent);
        $this->startScraping($array);
    }

    function cleanListURLs($linkList)
    {
        foreach ($linkList as $sub => $url) {
            if (strlen($url) <= 1) {
                unset($linkList[$sub]);
            }
            if (strpos('javascript', $url)) {
                unset($linkList[$sub]);
            }
            str_replace($this->allowedExtensions, '', $url, $count);
            if ($count > 0) {
                unset($linkList[$sub]);
            }
            if (substr($url, 0, 1) == '#') {
                unset($linkList[$sub]);
            }
            if (substr($url, 0, 1) == '/' || substr($url, 0, 1) == '?' || substr($url, 0, 1) == '=') {
                $linkList[$sub] = $this->startPath . $url;
            }
        }
        return $linkList;
    }
}

?>