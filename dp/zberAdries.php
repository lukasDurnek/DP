<?php
require('base.php');
$title = $GLOBALS['collection_of_addresses'];
$active = 10;
generateBase();

echo '
<form id="formular" action="#" method="post">
<p class="error"> ' . $GLOBALS['time_consuming'] . ' <p>
<p> ' . $GLOBALS['address'] . ' <input type="text"  name="address" placeholder="http://www.fri.uniza.sk/  ">
<p> ' . $GLOBALS['fname'] . ' <input type="text"  name="name" placeholder="' . $name . '">
<p> ' . $GLOBALS['surname'] . ' <input type="text"  name="surname" placeholder="' . $surname . '">
<p><button type="submit" value="Select" name="btn1"> ' . $GLOBALS['run'] . ' </button></form>';


if (isset($_POST['btn1'])){
    include('databaza.php');

    $sql = $dbconn4->query("select nextval('osoba_id_seq')");
    foreach ($sql as $row) {
        $Next_Id_Contact = $row["nextval"];
    }
    $sql = $dbconn4->query("insert into $_SESSION[TableKontakt](id, meno, priezvisko, pred, za) values('$Next_Id_Contact','$_POST[name]','$_POST[surname]','','')");

    include('emailcrawler.php');
    $array;
    $new = new scraper;
    $new->setStartPath();
    //echo $_POST['address'];
    //$temp = explode('/',$_POST['address']);
   // echo $temp[0] . '1' . $temp[1] . '2' . $temp[2];
    $new->startURL($_POST['address']);
    $new->startScraping($array, $_POST['name'], $_POST['surname'], $Next_Id_Contact, $dbconn4);
}
