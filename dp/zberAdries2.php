<?php
require('base.php');
$title = $GLOBALS['collection_of_addresses'];
$active = 10;

//function get_url($id_source){
//    global $dbconn4;
//    $sql = $dbconn4->query("select url_zdroja from URL where id_zdroja = 1 and prehladany='false' limit 1");
//    foreach ($sql as $row) {
//        echo "skusam dostat URL";
//        return $row["url_zdroja"];
//    }
//    return false;
//}
generateBase();

echo '
<form id="formular" action="#" method="post">
<p class="error"> ' . $GLOBALS['time_consuming'] . ' <p>
<p> ' . $GLOBALS['address'] . ' <input type="text"  name="address" placeholder="http://www.fri.uniza.sk/  ">
<p> ' . $GLOBALS['level'] . ' <input type="text"  name="level" placeholder="1">
<p><button type="submit" value="Select" name="btnRun"> ' . $GLOBALS['run'] . ' </button></form>';


if (isset($_POST['btnRun'])){
    include('databaza.php');

    $sql = $dbconn4->query("select id from $_SESSION[TableKontakt] where id = -1");
    foreach ($sql as $row) {
        $id_false_contact = $row["id"];
        // $id_false_contact = -1;
    }


    include 'emailcrawler2.php';
    $target = $_POST['address'];
    $depth = $_POST['level'];

    $urls = array();
    $urls[$target] = $target;


    $data = file_get_contents($target);
    $data = strip_tags($data,"<a>");
//var_dump($data);

    $divided_data = preg_split("/<\/a>/",$data);
//foreach ($divided_data as $k=>$received_url){
//    if( strpos($received_url, "<a href=") !== FALSE ){
//        //splituje podla ukoncovacieho tagu /a>,  /.*-vsetko co bolo predtym tak ponahradzuje prazdnym retazcom
//        $received_url = preg_replace("/.*<a\s+href=\"/sm","",$received_url);
//        $received_url = preg_replace("/\".*/","",$received_url);
//        if(!(strpos($received_url,"#") === 0 || strcmp($received_url,"/") === 0 || strlen($received_url) === 0 )) {   //filtruje urls, ktore sa skladaju len zo znaku # a / alebo su prazdne
//            //echo $received_url."<br/>";
//            $received_url= trim($received_url);
//
//
//            if((strpos($received_url,".") === 0) && strpos($received_url,"/") === 1){ //nahradi bodku a / korenovou strankou
//            $received_url = substr($received_url,1);
//            }
//
//            if(strpos($received_url,"/") === 0){   //ak je na prvej pozicii lomitko tak ho nahradi korenovou strankou
//                $received_url = $target.$received_url;
//            }
//
//            //echo $received_url . "   " . substr_count(substr($received_url,strlen("https://")),"/") . "<br/>";
//
//            $url_depth = substr_count(substr($received_url,strlen("https://")),"/");   //hlbka url adresy
//            //ak najde na poslednej pozicii len lomitko
//            if(strrpos($received_url,"/") === strlen($received_url) -1){
//                $url_depth = $url_depth -1;
//            }
//
//
//            if($url_depth <= $depth && substr($received_url,strlen($target)+1) !== "index.php" && strpos($received_url,$target)!== FALSE)
//                $urls[$received_url] = $received_url;
//
//
//
//        }
//    }
//}




//var_dump($urls);
//foreach ($urls as $received_urls){
//    echo $received_url."<br/>";
//}

//$up = new Scraper;
//foreach ($urls as $every_url){
//    $test = new HttpCurl($up);
//    $test->get($every_url, $dbconn4,$id_false_contact);
//}


    $target = $_POST['address'];
    $up = new Scraper;
    $test = new HttpCurl($up);
    //$test->typeOfParse(1);   //parse of emails
    $test->getEmails($target, $dbconn4,$id_false_contact,1);




}