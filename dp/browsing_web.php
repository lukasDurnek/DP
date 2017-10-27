<?php
require('base.php');
$title = $GLOBALS['browsing_web'];
$active = 8;

function get_url($id_source){
    global $dbconn4;
    $sql = $dbconn4->query("select url_zdroja from URL where id_zdroja = '$id_source' and prehladany='false' limit 1");
    foreach ($sql as $row) {
        return $row["url_zdroja"];
    }
    return false;
}
generateBase();

echo '
<form id="formular" action="#" method="post">
<p class="error"> ' . $GLOBALS['time_consuming'] . ' <p>
<p> ' . $GLOBALS['address'] . ' <input type="text"  name="address" placeholder="http://www.fri.uniza.sk/  ">
<p> ' . $GLOBALS['domain'] . ' <input type="text"  name="domain" placeholder="fri.uniza">
<p> ' . $GLOBALS['field'] . ' <input type="text"  name="field" placeholder="informatika">
<p><button type="submit" value="Select" name="btn1"> ' . $GLOBALS['run'] . ' </button></form>';


if (isset($_POST['btn1'])){
    include('databaza.php');
    include 'emailcrawler2.php';
    $target = $_POST['address'];

    $up = new Scraper;
    $test = new HttpCurl($up);

    $sql = $dbconn4->query("insert into URL(id_zdroja,url_zdroja,prehladany) values('1','$target','false')");

    while(true){
        global $dbconn4;
        $url = get_url("1");
        echo "URL :";
        var_dump($url);

        if(!$url){
            echo "KONCIM";
            //skonci
            break;
        }
        //parsujeme ....
        try {
            $test->get($url, $dbconn4, $id_false_contact, $id_source,2);
        }catch(Exception $e){

        }
        echo "FALUSJEM URL ".$url;
        $sql = $dbconn4->query("update URL set prehladany = 'true' where url_zdroja = '$url'");

    }
}