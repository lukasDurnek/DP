<?php

error_reporting(E_ERROR | E_PARSE);
define('EMAIL_PATTERN', '/([\s]*)([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*([ ]+|)@([ ]+|)([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,}))([\s]*)/i');

interface HttpScraper
{
    public function parse($body, $head,$connection, $id_fictional,$typeParse);
    public function parseEmails($body, $head,$connection, $id_fictional,$typeParse);
}

class Scraper implements HttpScraper
{
    var $startURL;
    var $array;
//    var $parserEmail;

    function startURL($theURL)
    {
        $this->startURL = $theURL;
    }



    function getTableSearched($emails, $insertedCount)
    {
        echo "<table border='2'>";

        foreach($emails as $m){
            for($tr=1;$tr<=$insertedCount;$tr++){

                echo "<tr>";

                echo "<td>".$tr."</td><td>".$m."</td>";

                echo "</tr>";
            }
        }


        echo "</table>";
//        echo '
//        <table border=2>
//        <tr>
//            <th>EMAILS</th>';
//        echo '
//        </tr> ';
//                echo '
//            <td> ' .
//                $emails . ';
//            </td>
//            ';
//            echo '
//        </tr>';
//        echo '
//</table>
//';
    }

    public function parseEmails($body, $head, $connection, $id_fictional,$typeParse)
    {
        // echo $head;

        if ($head == 200) {
            $p = preg_match_all(EMAIL_PATTERN, $body, $matches);       //global regular expression
            if ($p) {


                $prem_inserted = 0;
                $prem_unpublished = 0;


                foreach ($matches[0] as $emails) {
                    echo "<pre>";
                    $emails = trim($emails);
                    print_r($emails);
                    echo "<pre>";

                    $mail_small = strtolower($emails);
                    $hash_delete = sha1("table=coll_addr&text=web&action=delete&idintable=" . $mail_small);
                    //echo $id_fictional ."| ". $emails . "| " . $mail_small . "| " . $hash_delete ."| ". $_SESSION['TableMail'];
//                    //vlozit insert do databazy
                    $Tid = 0; //Ak existuje zadany mail v databaze tak Tid nadobudne hodnotu roznu od nuly a odmietne vytvorit kontakt
                    $sql = $connection->query("select count(*) as count_of_f from $_SESSION[TableMail] where id_kontakt = -1 and mail_male='$mail_small'");
                    foreach ($sql as $row) {
                        $Tid = $row['count_of_f'];
                    }
                    //echo " prvy " . $Tid;



                    if ($Tid != 0)
                        $prem_unpublished = $prem_unpublished +1;
                    else {

                        $qury = "insert into $_SESSION[TableMail](id_kontakt,mail, mail_male, poslat, vymazany, zdroj, hash_delete,spam)
                        values ($id_fictional,'$emails','$mail_small','true','false','$_SESSION[login]','$hash_delete','0')";
                        $prem_inserted = $prem_inserted +1;

                        //echo $qury;
                        $sql = $connection->query($qury);

                        //echo $id_fictional . " |" . $emails . " |" . $mail_small . " |"  . $_SESSION['login'];
                    }

                    // upload all addresses
                    $this->getTableSearched($emails,$prem_inserted);
                }
                echo "<p class='center success'>" . $GLOBALS['number_of_adds'] . '<br/>' . $prem_inserted ."</p> ";
                echo "<p class='center error'>" . $GLOBALS['number_of_duplicates'] . '<br/>' . $prem_unpublished ."</p> ";
            }
        }
    }


    public function parse($body, $head, $connection, $id_fictional,$typeParse)
    {
       // echo $head;
            if ($head == 200) {

                //parsujem
                $data = file_get_contents($body);
                print("DATA : ");
//                var_dump($body);


                preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $body, $match);
                echo "match : \n";
//                var_dump($match);
                foreach ($match[0] as $u) {
                    echo "DUMPUJEM url";
//                    var_dump($u);
                    //filter

                    $domain = $_POST['domain'];
                    if (strpos($u, $domain) !== false) {

                        // start request...
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_RETURNTRANSFER => 1,
                            CURLOPT_URL => $u,
                            CURLOPT_SSL_VERIFYPEER => false
                        ));
                        $resp = curl_exec($curl);
                        if (FALSE === $resp) {
                            var_dump([
                                curl_error($curl), curl_errno($curl)
                            ]);
                        }
                        $this->_info  = curl_getinfo($curl);
                        curl_close($curl);
                        $body = $resp;
                        // end request...

                        $test = 'FAKULTA';
                        $statement = "
                                  select Kluc_slovo.nazov from Kluc_slovo 
                                  join Identita_kluc_slova on(Identita_kluc_slova.id_kl_slova = Kluc_slovo.id_slova) 
                                  join Oblast on(Identita_kluc_slova.id_oblast = Oblast.id_oblast) 
                                  where Oblast.nazov = '$test'";
                        var_dump($statement);
                        $needles = $connection->query($statement)
                            ->fetchAll();

                        var_dump($needles);
                        $fields = [];
                        foreach ($needles as $row) {
                            $fields[] = $row["nazov"];
                        }
//                        var_dump($fields);exit;

                        $body = explode(' ', $body); // body dalsej stranky
                        array_walk($body, function (&$value) { // &$value je referencia na prvok pola
                            $value = strtolower($value);
                        });
                        array_walk($fields, function (&$value) {
                            $value = strtolower($value);
                        });

                        $intersection = array_intersect($body, $fields);       //prienik klucoveho slova a slova na stranke
                        var_dump([
                           $body,
                           $fields,
                           $intersection
                        ]);
                        $containsKeyWord = is_array($intersection) && count($intersection) > 0;     
                        try {
                            $statement = "insert into URL(id_zdroja,url_zdroja,prehladany) values('1','$u','".json_encode($containsKeyWord)."')";
                            var_dump($statement);
                            $sql2 = $connection->query($statement);
                        } catch (Exception $e) {
                        }

//                        exit;
                    }
                }
            }
        }

}

class HttpCurl {
    protected $_cookie, $_parser, $_timeout;
    private $_info, $_body, $_error, $parserEmail;

    public function __construct($p = null) {
        if (!function_exists('curl_init')) {
            throw new Exception('cURL not enabled!');
        }
        $this->setParser($p);
    }

//    public function typeOfParse($type){
//        $this->parserEmail = $type;
//    }


    public function get($url, $connection, $id_fictional,$id_source, $type) {
        return $this->request($url, $connection, $id_fictional,$type);
    }

    public function getEmails($url, $connection, $id_fictional,$type) {
        return $this->request($url, $connection, $id_fictional, $type);
    }

    protected function request($url, $connection, $id_fictional,$type) {
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false
        ));

        // Send the request & save response to $resp
        $resp = curl_exec($curl);

        if (FALSE === $resp) {
            var_dump([
                curl_error($curl), curl_errno($curl)
            ]);
        }
        $this->_info  = curl_getinfo($curl);

//        var_dump($this->_info);exit;

        // Close request to clear up some resources
        curl_close($curl);

//        echo '-- 1<br />';
//        echo $this->_body;
//        echo '-- 2<br />';

        $this->_body = $resp;
        $this->_error = curl_error($curl);
        curl_close($curl);

        $this->runParser($this->_body, $this->getStatus(), $connection, $id_fictional,$type);

    }

    public function getStatus() {
        return $this->_info['http_code'];
    }

    public function getHeader() {
        return $this->_info;
    }

    public function getBody() {
        return $this->_body;
    }

    public function __destruct() {
    }

    public function setParser($p)	{
        if ($p === null || $p instanceof HttpScraper || is_callable($p))
            $this->_parser = $p;
    }

    public function runParser($content, $header, $connection, $id_fictional,$type)	{
        if ($this->_parser !== null)
        {
            if ($this->_parser instanceof HttpScraper){
                    if($type === 1) {
                        $this->_parser->parseEmails($content, $header, $connection, $id_fictional, $type);
                    }else {

                        $this->_parser->parse($content, $header, $connection, $id_fictional, $type);
                    }
            }
        }

            else
                call_user_func($this->_parser, $content, $header);
        }







}
?>