<?php
header('Content-Type: text/html; charset=utf-8');
@session_start();

require('databaza.php');
require('config.php');

$table = $_REQUEST["table"]; //  pg_escape_string($dbconn4, $_REQUEST["table"]);
$text = $_REQUEST["text"];
$action = $_REQUEST["action"];
$idintable = $_REQUEST["idintable"];

//echo "$table <br>";
//echo "$text <br>";
//echo "$action <br>";
//echo "$idintable <br>";

if ($table === 'SK') {
    $_SESSION['language'] = 'sk';
    echo "<head><meta http-equiv='refresh' content=''></head>";
}
if ($table === 'EN') {
    $_SESSION['language'] = 'en';
    echo "<head><meta http-equiv='refresh' content=''></head>";
}
if ($action == sha1('refresh')) {
    $_SESSION['select'] = "";
    $_SESSION['value'] = "";
    $_SESSION['order'] = "";
    $_SESSION['removed'] = 0;
    echo "<head><meta http-equiv='refresh' content='0'></head>";
}
if ($table === 'cff635c44dc551bc46e6709429aff85045f71925') { //show/hide deleted sha1('showdeleted')
    if ($_SESSION['removed'] != 1)
        $_SESSION['removed'] = 1;
    else $_SESSION['removed'] = 0;
    echo "<head><meta http-equiv='refresh' content='0'></head>";
}
if ($table === '19df8f17ab68ff0db9f639200b8e7a8b69cce3c2') { //nahrad sha1('nahrad')
    replace($dbconn4, $text, $action);
}
if ($action === '755084a108fdfcd60abd95388cfcce04c1b80574') { //vypis sha1('vypis')
    if ($table == 'c7f588235eb4d781000efad2e6ace6c60b7a63ef') //kontakt sha1('kontakt')
        contact($dbconn4, '', '', '');
    if($table == 'coll_addr')
        collection_addresses($dbconn4,'','','');
    if($table == 'unexistingEmails')
        showUnexistingEmailAddresses($dbconn4,'','','');
    if ($table == '0c25d1a648a3363fe30cad4541eac805b4cae5fd') //uzivatel sha1('uzivatel')
        user($dbconn4, '', '', '');
    if ($table == 'b10fb50537d357e0bcd28b904d46afa4b7a695d6') //mail_spec sha1('mail_spec')
        mail_spec($dbconn4, '', '', '');
    if ($table == '023d69ed795d2cfd4fa2db3f8f52b47599aa14ad') //group sha1('group')
        group($dbconn4, '', '', '');
    if ($table == 'fe5ce063f0e8231e16e59d4c4b94e9eb22a6b834') //upozornenie sha1('upozornenie')
        attention($dbconn4, '', '', '');
    if($table == sha1('unexistingEmails')){
        showUnexistingEmailAddresses($dbconn4,'','','');
    }
}
if ($action === 'c253f7677eea7bae64acc35a26a69632f942f19e') { //preusporiadaj sha1('preusporiadaj')
    if ($table == 'c7f588235eb4d781000efad2e6ace6c60b7a63ef')
        contact($dbconn4, $text, '', '');
    if ($table == '0c25d1a648a3363fe30cad4541eac805b4cae5fd')
        user($dbconn4, $text, '', '');
    if ($table == 'b10fb50537d357e0bcd28b904d46afa4b7a695d6')
        mail_spec($dbconn4, $text, '', '');
    if ($table == '023d69ed795d2cfd4fa2db3f8f52b47599aa14ad')
        group($dbconn4, $text, '', '');
}
if ($action === '81448fe273247b533b9f018e96c158cab7901247') { //select sha1('select')
    if ($table == 'c7f588235eb4d781000efad2e6ace6c60b7a63ef')
        contact($dbconn4, '', $text, $idintable);
    if ($table == '0a6f9261151d3dd3d2500ea02569507190f758f3') //kontaktDuplicit sha1('kontaktDuplicit')
        contact($dbconn4, 'duplicit', '', '');
    if ($table == '0c25d1a648a3363fe30cad4541eac805b4cae5fd')
        user($dbconn4, '', $text, $idintable);
    if ($table == 'b10fb50537d357e0bcd28b904d46afa4b7a695d6')
        mail_spec($dbconn4, '', $text, $idintable);
    if ($table == '023d69ed795d2cfd4fa2db3f8f52b47599aa14ad')
        group($dbconn4, '', $text, $idintable);
    if ($table == 'coll_addr')
        collection_addresses($dbconn4, '', $text, $idintable);
    if ($table == 'unexistingEmails')
        showUnexistingEmailAddresses($dbconn4, '', $text, $idintable);
}

if ($action === '3caf2dee3d5542b5dad9a58a3a790685b5f2ca34') { //updateK sha1('updateK')
    update($dbconn4, $text, $idintable, $table, 'Kontakt');
    contact($dbconn4, '', '', '');
    collection_addresses($dbconn4, '', '', '');
}
if ($action === '92fc4031b562e4e22ca64cfa67c41d30fe4fdc1b') { //updateM sha1('updateM')
    update($dbconn4, $text, $idintable, $table, 'Mail');
    contact($dbconn4, '', '', '');
    collection_addresses($dbconn4, '', '', '');
}
if ($action === 'e20dc989e677f53b912f708b48f541b6d25c4287') { //updateU sha1('updateU')
    update($dbconn4, $text, $idintable, $table, 'Uzivatel');
    user($dbconn4, '', '', '');
}
if ($action === 'add') {
    if ($table === 'mail') {
        addmail($dbconn4, $text, $idintable);
        contact($dbconn4, '', '', '');
    }
    if ($table === 'b10fb50537d357e0bcd28b904d46afa4b7a695d6') {
        addtogroup($dbconn4, $text, $idintable);
        mail_spec($dbconn4, '', '', '');
    }
    if ($table === '023d69ed795d2cfd4fa2db3f8f52b47599aa14ad') {
        addgroup($dbconn4, $idintable, $text);
        group($dbconn4, '', '', '');
    }
}

if ($table === 'b10fb50537d357e0bcd28b904d46afa4b7a695d6')
    if ($text != '' && $action != 'add' && $action != '9485989ff514b5106b7738850fd73c23e8c1e3f7' && $action != 'c253f7677eea7bae64acc35a26a69632f942f19e' && $action != '81448fe273247b533b9f018e96c158cab7901247') {
        deleteMail_spec($dbconn4, $text, $action, $idintable);
        mail_spec($dbconn4, '', '', '');
    }

if ($action === '9485989ff514b5106b7738850fd73c23e8c1e3f7') { //delete sha1('delete')
    if ($table === 'c7f588235eb4d781000efad2e6ace6c60b7a63ef') {
        deleteMail($dbconn4, $idintable);
        contact($dbconn4, '', '', '');
    }
    if ($table === '0c25d1a648a3363fe30cad4541eac805b4cae5fd') {
        deleteUser($dbconn4, $idintable);
        user($dbconn4, '', '', '');
    }
    if ($table === '023d69ed795d2cfd4fa2db3f8f52b47599aa14ad') {
        deleteGroup($dbconn4, $idintable);
        group($dbconn4, '', '', '');
    }
}

//if($action == sha1('deleteOut')){ //deleteOut sha1('deleteOut')
//    $sql = $dbconn4->query("UPDATE mail SET vymazany='true' where hash_delete='$idintable'");
//    $sql = $dbconn4->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas,poznamka) values('mail','$idintable','vymazany','false','true',CURRENT_TIMESTAMP,'lukas')");
//    var_dump($sql);
//    echo "<p class='center success'> " . $GLOBALS['mail_deleted'] . " </p>";
//}

if($action == '5cc9fd81801cf14264b2786b8a01dad2f3e4979d'){       //hash - refreshDelete
    if ($table === 'c7f588235eb4d781000efad2e6ace6c60b7a63ef') {
        refreshDelete($dbconn4,$idintable);
        contact($dbconn4, '', '', '');
    }
}

if ($action === 'fa119f8dd2bd5910063d13016a3ad5909aebf2d8') { //multi sha1('multi')
    if ($table == 'add') {
        multiadd($dbconn4, $text, $idintable);
        mail_spec($dbconn4, '', '', '');
    }
    if ($table == 'db99845855b2ecbfecca9a095062b96c3e27703f') { //remove sha1('remove')
        multiremove($dbconn4, $text, $idintable);
        mail_spec($dbconn4, '', '', '');
    }
}

if ($action == '05425480ddceaa07bd073ebaac46cc71acaf70c3') { //spoj sha1('spoj')
    connectGroups($dbconn4, $text, $idintable);
    group($dbconn4, '', '', '');
}

function refreshDelete($dbconn4, $email){
    $sql = $dbconn4->query("UPDATE mail set vymazany = 'false', delete_time = null, poznamka = null where mail = '$email'");
}

function connectGroups($connection, $to_stay, $deleted)
{
    $error = $id_to_stay = $id_deleted = 0;
    $sql = $connection->query("Select id from skupina where nazov='$to_stay'");
    foreach ($sql as $row) {
        $id_to_stay = $row[0];
    }
    $sql = $connection->query("Select id from skupina where nazov='$deleted'");
    foreach ($sql as $row) {
        $id_deleted = $row[0];
    }

    if ($id_to_stay == 0 || $id_deleted == 0) {
        echo "<p class='center error'> " . $GLOBALS['failed_group'] . " </p>";
        $error = 1;
    }

    if ($error != 1) {
        $sql = $connection->query("Select * from mail_spec where id_skupina='$id_deleted' AND cas_do is NULL ");
        foreach ($sql as $row) {
            $sql2 = $connection->query("insert into mail_spec(id_mail, id_skupina, pridal, cas_od) values('$row[1]', '$id_to_stay', '$_SESSION[id]', CURRENT_TIMESTAMP)");
            $sql2 = $connection->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas) values('mail_spec','$row[0]','id_skupina','$id_deleted','$id_to_stay',CURRENT_TIMESTAMP)");
        }
        $sql = $connection->query("DELETE from mail_spec where id_skupina='$id_deleted'");
        $sql = $connection->query("DELETE from skupina where nazov='$deleted'");
        $sql2 = $connection->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas) values('skupina','$deleted','vsetko','$deleted','$to_stay',CURRENT_TIMESTAMP)");
    }
}

function multiadd($connection, $id, $group)
{
    $id = str_replace(',', ' ', $id);
    $id = implode(" ", array_unique(explode(" ", $id)));
    $pieces = explode(" ", $id);
    foreach ($pieces as $row) {
        if (is_numeric($row))
            addtogroup($connection, $group, $row);
    }
}

function multiremove($connection, $id, $group)
{
    $id = str_replace(',', ' ', $id);
    $pieces = explode(" ", $id);
    for ($i = 0; $i < count($pieces); $i++) {
        if (is_numeric($pieces[$i])) {
            $date1 = $i + 1;
            $date2 = $i + 2;
            $time = "$pieces[$date1] $pieces[$date2]";
            deleteMail_spec($connection, $pieces[$i], $group, $time);
        }
    }
}

function update($connection, $value, $what, $key, $table)
{
    $error = 0;
    $value = trim($value);
    if ($what == 'mail_male') {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $mail_small = strtolower($value);
            $sql = $connection->query("Select $what from $table where $what='$mail_small'") or die(pg_last_error($connection));
            foreach ($sql as $row) { //toto je iba na kontrolu existujuceho mailu
                $error = 1;
            }
            if ($error == 0) {
                $sql = $connection->query("Select $what from $table where id='$key'") or die(pg_last_error($connection));
                foreach ($sql as $row) {
                    $sql = $connection->query("UPDATE $table SET mail='$value' where id='$key'") or die(pg_last_error($connection));
                    $sql = $connection->query("UPDATE $table SET $what='$mail_small' where id='$key'") or die(pg_last_error($connection));

                    $sql = $connection->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas) values('$table','$key','mail','$row[0]','$value',CURRENT_TIMESTAMP)");
                    $sql = $connection->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas) values('$table','$key','$what','$row[0]','$mail_small',CURRENT_TIMESTAMP)");
                }
            } else echo "<p class='center error'>" . $GLOBALS['existing_mail'] . " </p> ";
        } else echo "<p class='center error'>" . $GLOBALS['format_mail'] . " </p> ";
    }
    if ($what != 'mail_small') {
        $sql = $connection->query("Select $what from $table where id='$key'") or die(pg_last_error($connection));
        foreach ($sql as $row) {
            $sql = $connection->query("UPDATE $table SET $what='$value' where id='$key'") or die(pg_last_error($connection));
            $sql = $connection->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas) values('$table','$key','$what','$row[0]','$value',CURRENT_TIMESTAMP)");
        }
        echo "<p class='center success'> " . $GLOBALS['change'] . " </p>";
    }

}

function addgroup($connection, $name, $copy)
{
    $name = trim($name);
    $error = 0;
    if ($name != '') {
        $sql = $connection->query("Select count(*) from skupina where nazov='$name'");
        foreach ($sql as $row) {
            if ($row[0] != 0) {
                echo "<p class='center error'> " . $GLOBALS['existing_group'] . " </p>";
                $error = 1;
            }
        }
        if ($copy != '') {
            $sql = $connection->query("Select count(*) from skupina where nazov='$copy'");
            foreach ($sql as $row) {
                if ($row[0] == 0) {
                    echo "<p class='center error'> " . $GLOBALS['failed_group'] . " </p>";
                    $error = 1;
                }
            }
        }
        if ($error != 1) {
            $sql = $connection->query("insert into skupina(nazov) values('$name')");
            echo "<p class='center success'> " . $GLOBALS['group_added'] . " </p>";
        }
        if ($copy != '') {
            $sql = $connection->query("Select id from skupina where nazov='$copy'");
            foreach ($sql as $row) {
                $idCop = $row[0];
            }
            $sql = $connection->query("Select id from skupina where nazov='$name'");
            foreach ($sql as $row) {
                $idOrig = $row[0];
            }
            $sql = $connection->query("Select * from mail_spec where id_skupina='$idCop' AND cas_do is NULL ");
            foreach ($sql as $row) {
                //echo "<br> HODNOTY '$row[1]', '$idOrig', '$_SESSION[id]'";
                $sql2 = $connection->query("insert into mail_spec(id_mail, id_skupina, pridal, cas_od) values('$row[1]', '$idOrig', '$_SESSION[id]', CURRENT_TIMESTAMP)");
            }
        }

    } else echo "<p class='center error'> " . $GLOBALS['unlisted_field'] . " </p>";
}

function addmail($dbconn4, $text, $idintable)
{
    $text = trim($text);
    $mail_small = strtolower($text);
    $error = 0;
    if (!filter_var($text, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='center error'> " . $GLOBALS['format_mail'] . " </p>";
        $error = 1;
    }
    $sql = $dbconn4->query("Select count(*) from mail where mail_male='$mail_small'");
    foreach ($sql as $row) {
        if ($row['count'] != 0) {
            echo "<p class='center error'> " . $GLOBALS['existing_mail'] . " </p>";
            $error = 1;
        }
    }
    if ($error != 1) {
        $hash_delete = sha1("table=kontakt&text=web&action=delete&idintable=".$mail_small);
        $sql = $dbconn4->query("insert into mail(id_kontakt, mail, mail_male, poslat, vymazany, zdroj, hash_delete) values('$idintable', '$text', '$mail_small', 'true', 'false', '$_SESSION[login]', '$hash_delete')");
        echo "<p class='center success'> " . $GLOBALS['mail_add'] . " </p>";
    }
}

function addtogroup($dbconn4, $text, $idintable)
{
    $text = trim($text);
    if ($text != '') {
        $sql = $dbconn4->query("select count(*) from skupina where nazov='$text'");
        foreach ($sql as $row) {
            if ($row['count'] < 1) {
                $sql2 = $dbconn4->query("insert into skupina(nazov) values('$text')");
            }
        }

        $sql = $dbconn4->query("select skupina.id, mail.id from skupina, mail where skupina.nazov='$text' AND mail.id=$idintable");
        foreach ($sql as $row) {
            $sql2 = $dbconn4->query("insert into mail_spec(id_mail, id_skupina, pridal, cas_od) values('$row[1]', '$row[0]', '$_SESSION[id]', CURRENT_TIMESTAMP)");
            echo "<p class='center success'> " . $GLOBALS['user_add'] . " </p>";
        }
    } else echo "<p class='center error'> " . $GLOBALS['unlisted_field'] . " </p>";
}

function deleteMail($dbconn4, $mail)
{
    $sql = $dbconn4->query("UPDATE mail SET vymazany='true', delete_time = CURRENT_TIMESTAMP where mail='$mail'");
    $sql = $dbconn4->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas,poznamka) values('mail','$mail','vymazany','false','true',CURRENT_TIMESTAMP,'$_SESSION[login]')");
    echo "<p class='center success'> " . $GLOBALS['mail_deleted'] . " </p>";
}

function deleteUser($dbconn4, $id)
{
    $id_user = substr($id, 1);
    $sql = $dbconn4->query("UPDATE uzivatel SET prava='removed' where id=$id_user");
    echo "<p class='center success'> " . $GLOBALS['user_delete'] . " </p>";
}

function deleteMail_spec($connection, $mail, $group, $time)
{
    if (!is_numeric($group)) {
        $sql = $connection->query("select skupina.id from skupina where skupina.nazov='$group'");
        foreach ($sql as $row) {
            $group = $row[0];
        }
    }
    $sql = $connection->query("UPDATE mail_spec SET cas_do = CURRENT_TIMESTAMP where id_mail='$mail' AND id_skupina='$group' AND cas_od='$time'");
    echo "<p class='center success'> " . $GLOBALS['mail_spec_delete'] . " </p>";
}

function deleteGroup($connection, $id)
{
    $sql = $connection->query("DELETE from mail_spec WHERE id_skupina='$id'");
    $sql = $connection->query("DELETE FROM skupina WHERE id='$id'");
    $sql = $connection->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas, poznamka) values('skupina','$id','vsetko','$id','$id',CURRENT_TIMESTAMP,'$_SESSION[login]')");
    echo "<p class='center success'> " . $GLOBALS['group_deleted'] . " </p>";
}

function replace($connection, $old, $new)
{
    $sql = $connection->query("Select id from mail where id_kontakt='$old'");
    foreach ($sql as $row) {
        $id = $row[0];
    }
    $sql = $connection->query("UPDATE mail_spec SET  id_mail='$new' where id_mail='$id'");
    $sql = $connection->query("UPDATE mail SET  id_kontakt='$new' where id_kontakt='$old'");
    $sql = $connection->query("Delete from uzivatel where id='$old'");
    $sql = $connection->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, time) values('kontakt','$new','vsetko','$old','$new',CURRENT_TIMESTAMP)");
}


function contact($dbconn4, $order, $select, $value)
{
    if ($select != '') {
        $_SESSION['select'] = $_SESSION['select'] . " " . $select;
        $_SESSION['value'] = $_SESSION['value'] . " " . $value;
    }

    if ($order != '') {
        $_SESSION['order'] = $_SESSION['order'] . " " . $order;
    }


    $query = "SELECT * FROM kontakt LEFT JOIN mail ON (kontakt.id = mail.id_kontakt) ORDER BY kontakt.id";
    $query2 = "SELECT * FROM kontakt LEFT JOIN mail ON (kontakt.id = mail.id_kontakt) WHERE kontakt.id != -1";

    if ((isset($_SESSION['select']) && $_SESSION['select'] != '') || (isset($_SESSION['removed']) && $_SESSION['removed'] == 1)) { //mam/mal som select konkretnych hodnot
        $query2 = $query2 . " AND ";
        if ($_SESSION['removed'] == 1)
            $query2 = $query2 . " mail.vymazany != 'true' ";


        $select = explode(" ", $_SESSION['select']);
        $value = explode(" ", $_SESSION['value']);


        for ($i = 1; $i < count($select); $i++) {
            if ($i == 1 && $_SESSION['removed'] != 1) {
                $query2 = $query2 . $select[$i] . " = '" . $value[$i] . "' ";
            }
            else {
                $query2 = $query2 . " AND " . $select[$i] . " = '" . $value[$i] . "' ";
            }
        }

    }


    if (isset($_SESSION['order']) && $_SESSION['order'] != '') { //mam/mal som nejaky order
        $order = implode(" ", array_unique(explode(" ", $_SESSION['order'])));
        $order = explode(" ", $order);

        //echo "$order[0] a $order[1] b $order[2] <br>";
        for ($i = 1; $i < count($order); $i++) {
            if ($i == 1)
                $query2 = $query2 . " ORDER BY " . $order[$i];
            else if ($order[$i] != '')
                $query2 = $query2 . ", " . $order[$i];
        }
        if ($_SESSION['KontaktOrder'] % 2 != 1) {
            $query2 = $query2 . " desc";
        }
        $_SESSION['KontaktOrder']++;
    }

    if(isset($order[1]) && $order[1] == 'duplicit')
        $query2 = "select * from kontakt where priezvisko in (
                  select priezvisko from kontakt group by priezvisko having count(*) > 1) AND meno in (
                  select meno from kontakt group by meno having count(*) > 1)";
    $sql = $dbconn4->query($query2);
    echo "
        <table id='kontakty'>
            <tr>
                <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','kontakt.id','c253f7677eea7bae64acc35a26a69632f942f19e','')\">ID</th>
                <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','pred','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['title_before'] . "</th>
	            <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','meno','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['fname'] . "</th>
	            <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','priezvisko','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['surname'] . "</th>
	            <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','za','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['title_for'] . "</th>
	            <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','mail','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['mail'] . "</th>
	            <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','poslat','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['send'] . "</th>
	            <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','vymazany','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['removed'] . "</th>
	            <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','poznamka','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['note'] . "</th>
	            <th onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','delete_time','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['del_time'] . "</th>
	            <th class='mouse nothover' style='width:20px;' ></th>
	            <th class='mouse nothover'></th>
	            <th class='mouse nothover'></th>
	        </tr>";

    foreach ($sql as $row) { //$row[0] $row[1] $row[2] $row[3] $row[4] $row[5] $row[6] $row[7] $row[8] $row[9] $row[10]
        echo "
            <tr>
			    <td>$row[0]</td>
			    <td id='1$row[mail_male]' contenteditable=\"true\" onblur=\"IDU('pok','$row[0]',document.getElementById('1$row[mail_male]').innerHTML,'3caf2dee3d5542b5dad9a58a3a790685b5f2ca34','before')\">$row[pred]</td>
			    <td id='2$row[mail_male]' contenteditable=\"true\" onblur=\"IDU('pok','$row[0]',document.getElementById('2$row[mail_male]').innerHTML,'3caf2dee3d5542b5dad9a58a3a790685b5f2ca34','name')\">$row[meno]</td>
			    <td id='3$row[mail_male]' contenteditable=\"true\" onblur=\"IDU('pok','$row[0]',document.getElementById('3$row[mail_male]').innerHTML,'3caf2dee3d5542b5dad9a58a3a790685b5f2ca34','surname')\">$row[priezvisko]</td>
			    <td id='4$row[mail_male]' contenteditable=\"true\" onblur=\"IDU('pok','$row[0]',document.getElementById('4$row[mail_male]').innerHTML,'3caf2dee3d5542b5dad9a58a3a790685b5f2ca34','for')\">$row[za]</td>
			    <td id='5$row[mail_male]' contenteditable=\"true\" onblur=\"IDU('pok','$row[6]',document.getElementById('5$row[mail_male]').innerHTML,'92fc4031b562e4e22ca64cfa67c41d30fe4fdc1b','mail_small')\">$row[mail_male]</td>
			    <td id='6$row[mail_male]' contenteditable=\"true\" onblur=\"IDU('pok','$row[6]',document.getElementById('6$row[mail_male]').innerHTML,'92fc4031b562e4e22ca64cfa67c41d30fe4fdc1b','send')\">$row[poslat]</td>
			    <td id='7$row[mail_male]' contenteditable=\"true\" onblur=\"IDU('pok','$row[6]',document.getElementById('7$row[mail_male]').innerHTML,'92fc4031b562e4e22ca64cfa67c41d30fe4fdc1b','removed')\">$row[vymazany]</td>
			    <td id='8$row[mail_male]' contenteditable=\"true\" onblur=\"IDU('pok','$row[6]',document.getElementById('8$row[mail_male]').innerHTML,'92fc4031b562e4e22ca64cfa67c41d30fe4fdc1b','note')\">$row[poznamka]</td>
			    <td id='9$row[mail_male]' contenteditable=\"true\" onblur=\"IDU('pok', '$row[6]', document . getElementById('9$row[mail_male]') . innerHTML, '92fc4031b562e4e22ca64cfa67c41d30fe4fdc1b', 'del_time')\">$row[delete_time]</td>
			    <td class='delete'><img alt='delete'  id='D$row[id]' src='./images/delete.png' onclick=\"IDU('pok','c7f588235eb4d781000efad2e6ace6c60b7a63ef','','9485989ff514b5106b7738850fd73c23e8c1e3f7','$row[mail]')\" style='width:20px;'/></td>
			    <td class='refresh_token'><img alt='refresh' id='C$row[id]' src='./images/refresh.png' onclick=\"IDU('pok', 'c7f588235eb4d781000efad2e6ace6c60b7a63ef', '', '5cc9fd81801cf14264b2786b8a01dad2f3e4979d', '$row[mail]')\" style='width:20px;'/></td>
			    <td id = 'B$row[0]' class='addmail'><img alt='addmail' src='./images/plus.png' onclick=\"newmail('B$row[0]', '$row[0]')\" style='width:20px;'/></td>
			</tr>";
    }
    echo "</table>";
    showDeleted();
}


function collection_addresses($dbconn4, $order, $select, $value)
{
    if ($select != '') {
        $_SESSION['select'] = $_SESSION['select'] . " " . $select;
        $_SESSION['value'] = $_SESSION['value'] . " " . $value;
    }

    $query = "SELECT Kontakt.id,meno,priezvisko, mail FROM Kontakt FULL OUTER JOIN Mail on(Kontakt.id = Mail.id_kontakt) WHERE Kontakt.id = -1";
    if((isset($_SESSION['select']) && $_SESSION['select']  != '') || (isset($_SESSION['removed']) && $_SESSION['removed'] == 1)){
        $query = $query . " AND ";

        $select = explode(" ", $_SESSION['select']);
        $value = explode(" ", $_SESSION['value']);



        for ($i = 1; $i < count($select); $i++) {
            if ($i == 1 && $_SESSION['removed'] != 1) {
                $query = $query . $select[$i] . " = '" . $value[$i] . "' ";
            }
            else {
                $query = $query . " AND " . $select[$i] . " = '" . $value[$i] . "' ";
            }
        }
        var_dump($query);
    }

    $sql = $dbconn4->query($query);

    echo "
        <table id='zber_emailov'>
            <tr>
                <th onclick=\"IDU('pok','coll_addr','kontakt.id','c253f7677eea7bae64acc35a26a69632f942f19e','')\">ID</th>
	            <th onclick=\"IDU('pok','coll_addr','meno','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['fname'] . "</th>
	            <th onclick=\"IDU('pok','coll_addr','priezvisko','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['surname'] . "</th>
	            <th onclick=\"IDU('pok','coll_addr','mail','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['mail'] . "</th>
	            <th class='mouse nothover' style='width:20px;' ></th>
	            <th class='mouse nothover'></th>
	        </tr>";

    foreach ($sql as $row) {
        echo "
            
            <tr>
			    <td>$row[0]</td>
			    <td id='1$row[mail]' contenteditable=\"true\" onblur=\"IDU('pok','$row[0]',document.getElementById('1$row[mail]').innerHTML,'3caf2dee3d5542b5dad9a58a3a790685b5f2ca34','name')\">$row[meno]</td>
			    <td id='2$row[mail]' contenteditable=\"true\" onblur=\"IDU('pok','$row[0]',document.getElementById('2$row[mail]').innerHTML,'3caf2dee3d5542b5dad9a58a3a790685b5f2ca34','surname')\">$row[priezvisko]</td>
			    <td id='3$row[mail]' contenteditable=\"true\" onblur=\"IDU('pok','$row[3]',document.getElementById('3$row[mail]').innerHTML,'92fc4031b562e4e22ca64cfa67c41d30fe4fdc1b','mail_small')\">$row[mail]</td> 
			    <td id='B$row[0]' style='width:20px;' >
			    <form action='novy_kontakt.php' method='post'>
			        <input type='hidden' name='found_mail' value=\"".$row['mail']."\"> 
			        <input name=\"createCont\" type=\"submit\" value=\"" . $GLOBALS['new_contact'] . "\">
			    </form>
			    </td>
			</tr>";
    }
    echo "</table>";
}


function showUnexistingEmailAddresses($dbconn4, $order, $select, $value)
{
    if ($select != '') {
        $_SESSION['select'] = $_SESSION['select'] . " " . $select;
        $_SESSION['value'] = $_SESSION['value'] . " " . $value;
    }

    $query = "SELECT Kontakt.id,meno,priezvisko, mail FROM Kontakt FULL OUTER JOIN Mail on(Kontakt.id = Mail.id_kontakt) WHERE vymazany = 'true'";
    if ((isset($_SESSION['select']) && $_SESSION['select'] != '') || (isset($_SESSION['removed']) && $_SESSION['removed'] == 1)) { //mam/mal som select konkretnych hodnot

        $query = $query . " AND ";

        $select = explode(" ", $_SESSION['select']);
        $value = explode(" ", $_SESSION['value']);

        for ($i = 1; $i < count($select); $i++) {
            if ($i == 1 && $_SESSION['removed'] != 1) {
                $query = $query . $select[$i] . " = '" . $value[$i] . "' ";
            }
            else {
                $query = $query . " AND " . $select[$i] . " = '" . $value[$i] . "' ";
            }
        }

    }

    $sql = $dbconn4->query($query);

    echo "
        <table id='unexistedMails'>
            <tr>
                <th onclick=\"IDU('pok','coll_addr','kontakt.id','c253f7677eea7bae64acc35a26a69632f942f19e','')\">ID</th>
	            <th onclick=\"IDU('pok','coll_addr','meno','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['fname'] . "</th>
	            <th onclick=\"IDU('pok','coll_addr','priezvisko','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['surname'] . "</th>
	            <th onclick=\"IDU('pok','coll_addr','mail','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['mail'] . "</th>
	        </tr>";

    foreach ($sql as $row) {
        echo "
            
            <tr>
			    <td>$row[0]</td>
			    <td id='1$row[mail]' contenteditable=\"true\" onblur=\"IDU('pok','$row[0]',document.getElementById('1$row[mail]').innerHTML,'3caf2dee3d5542b5dad9a58a3a790685b5f2ca34','name')\">$row[meno]</td>
			    <td id='2$row[mail]' contenteditable=\"true\" onblur=\"IDU('pok','$row[0]',document.getElementById('2$row[mail]').innerHTML,'3caf2dee3d5542b5dad9a58a3a790685b5f2ca34','surname')\">$row[priezvisko]</td>
			    <td id='3$row[mail]' contenteditable=\"true\" onblur=\"IDU('pok','$row[3]',document.getElementById('3$row[mail]').innerHTML,'92fc4031b562e4e22ca64cfa67c41d30fe4fdc1b','mail_small')\">$row[mail]</td>
			    </td>
			</tr>";
    }
    echo "</table>";
}

function user($dbconn4, $order, $select, $value)
{
    if ($select != '') {
        $_SESSION['select'] = $_SESSION['select'] . " " . $select;
        $_SESSION['value'] = $_SESSION['value'] . " " . $value;
    }

    $query = "SELECT id, meno, priezvisko, login, prava FROM uzivatel";
    if  ((isset($_SESSION['select']) && $_SESSION['select'] != '') || (isset($_SESSION['removed']) && $_SESSION['removed'] == 1)) { //mam/mal som select konkretnych hodnot
        $query = $query . " WHERE ";
        if ($_SESSION['removed'] == 1)
            $query = $query . " prava != 'removed' ";

        $select = explode(" ", $_SESSION['select']);
        $value = explode(" ", $_SESSION['value']);
        for ($i = 1; $i < count($select); $i++) {
            if ($i == 1 && $_SESSION['removed'] != 1)
                $query = $query . $select[$i] . " = '" . $value[$i] . "' ";
            else
                $query = $query . " AND " . $select[$i] . " = '" . $value[$i] . "' ";
        }
    }

    if ($order != '') { //mam/mal som nejaky order
        $order = explode(" ", $order);
        for ($i = 0; $i < count($order); $i++) {
            if ($i == 0)
                $query = $query . " ORDER BY " . $order[$i];
            else
                $query = $query . ", " . $order[$i];
        }
        if ($_SESSION['KontaktOrder'] % 2 != 1) {
            $query = $query . " desc";
        }
        $_SESSION['KontaktOrder']++;

    }
	//echo $query;
    $sql = $dbconn4->query($query);
    echo "
        <table id='uzivatel'>
            <tr>
                <th onclick=\"IDU('pok','0c25d1a648a3363fe30cad4541eac805b4cae5fd','id','c253f7677eea7bae64acc35a26a69632f942f19e','')\">ID</th>
	            <th onclick=\"IDU('pok','0c25d1a648a3363fe30cad4541eac805b4cae5fd','meno','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['fname'] . "</th>
	            <th onclick=\"IDU('pok','0c25d1a648a3363fe30cad4541eac805b4cae5fd','priezvisko','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['surname'] . "</th>
	            <th onclick=\"IDU('pok','0c25d1a648a3363fe30cad4541eac805b4cae5fd','login','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['login'] . "</th>
	            <th onclick=\"IDU('pok','0c25d1a648a3363fe30cad4541eac805b4cae5fd','prava','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['rights'] . "</th>
	            <th class='mouse' style='width:20px;'></th>
	        </tr>";
    foreach ($sql as $row) { //updateK($dbconn4, $text, $idintable, $table); table, text, action, idintable
        echo "
            <tr>
			    <td>$row[id]</td>
			    <td id='1$row[id]' contenteditable=\"true\" onblur=\"IDU('pok','$row[id]',document.getElementById('1$row[id]').innerHTML,'e20dc989e677f53b912f708b48f541b6d25c4287','meno')\">$row[meno]</td>
			    <td id='2$row[id]' contenteditable=\"true\" onblur=\"IDU('pok','$row[id]',document.getElementById('2$row[id]').innerHTML,'e20dc989e677f53b912f708b48f541b6d25c4287','priezvisko')\">$row[priezvisko]</td>
			    <td id='3$row[id]' contenteditable=\"true\" onblur=\"IDU('pok','$row[id]',document.getElementById('3$row[id]').innerHTML,'e20dc989e677f53b912f708b48f541b6d25c4287','login')\">$row[login]</td>
			    <td id='4$row[id]' contenteditable=\"true\" onblur=\"IDU('pok','$row[id]',document.getElementById('4$row[id]').innerHTML,'e20dc989e677f53b912f708b48f541b6d25c4287','prava')\">$row[prava]</td>";
        if ($row['login'] != 'lukas23') echo "
			    <td class='delete'><img alt='delete'  id='D$row[id]' src='./images/delete.png' onclick=\"IDU('pok', '0c25d1a648a3363fe30cad4541eac805b4cae5fd', '', '9485989ff514b5106b7738850fd73c23e8c1e3f7', 'D$row[id]')\" style='width:20px;'/></td>";
        else echo "<td></td>";
        echo "
			</tr>";
    }
    echo "</table>";
    showDeleted();
}

function mail_spec($dbconn4, $order, $select, $value)
{
    if ($select != '') {
        $_SESSION['select'] = $_SESSION['select'] . " " . $select;
        $_SESSION['value'] = $_SESSION['value'] . " " . $value;
    }

    $query = "SELECT * FROM Mail LEFT JOIN Mail_spec ON (mail.id = mail_spec.id_mail) LEFT JOIN skupina on (skupina.id = mail_spec.id_skupina)";
    if ((isset($_SESSION['select']) && $_SESSION['select'] != '') || (isset($_SESSION['removed']) && $_SESSION['removed'] == 1)) { //mam/mal som select konkretnych hodnot
        $query = $query . " WHERE ";
        if ($_SESSION['removed'] == 1)
            $query = $query . " Mail.vymazany != 'true' AND Mail_spec.cas_do is NULL";

        $select = explode(" ", $_SESSION['select']);
        $value = explode(" ", $_SESSION['value']);
        for ($i = 1; $i < count($select); $i++) {
            if ($i == 1 && $_SESSION['removed'] != 1)
                $query = $query . $select[$i] . " = '" . $value[$i] . "' ";
            else
                $query = $query . " AND " . $select[$i] . " = '" . $value[$i] . "' ";
        }
    }

    if ($order != '') { //mam/mal som nejaky order
        $order = explode(" ", $order);
        for ($i = 0; $i < count($order); $i++) {
            if ($i == 0)
                $query = $query . " ORDER BY " . $order[$i];
            else
                $query = $query . ", " . $order[$i];
        }
        if ($_SESSION['KontaktOrder'] % 2 != 1) {
            $query = $query . " desc";
        }
        $_SESSION['KontaktOrder']++;

    }

    $sql = $dbconn4->query($query);
    $counter = 1;
    echo "
        <table id='mail_spec'>
            <tr>
                <th><input type='checkbox' onClick='toggle(this)' /></th>
                <th onclick=\"IDU('pok','b10fb50537d357e0bcd28b904d46afa4b7a695d6','mail.id','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['mail_id'] . "</th>
                <th onclick=\"IDU('pok','b10fb50537d357e0bcd28b904d46afa4b7a695d6','mail','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['mail'] . "</th>
                <th>" . $GLOBALS['removed'] . "</th>
                <th>" . $GLOBALS['send'] . "</th>
                <th onclick=\"IDU('pok','b10fb50537d357e0bcd28b904d46afa4b7a695d6','skupina.id','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['group_id'] . "</th>
                <th onclick=\"IDU('pok','b10fb50537d357e0bcd28b904d46afa4b7a695d6','nazov','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['group'] . "</th>
                <th onclick=\"IDU('pok','b10fb50537d357e0bcd28b904d46afa4b7a695d6','cas_od','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['from'] . "</th>
                <th onclick=\"IDU('pok','b10fb50537d357e0bcd28b904d46afa4b7a695d6','cas_do','c253f7677eea7bae64acc35a26a69632f942f19e','')\">" . $GLOBALS['to'] . "</th>
                <th class='mouse nothover' style='width:20px;'></th>
	            <th class='mouse nothover' ></th>
	        </tr>";
    foreach ($sql as $row) {
        $id_mail = $row[3];
        $counter++;
        if($row['cas_od'] != '')
            $time_from = substr($row['cas_od'], 8, 2).".".substr($row['cas_od'], 5, 2).".".substr($row['cas_od'], 0, 4);
        else $time_from='';
        if($row['cas_do'] != '')
            $time_to = substr($row['cas_do'], 8, 2).".".substr($row['cas_do'], 5, 2).".".substr($row['cas_do'], 0, 4);
        else $time_to='';
        echo "
            <tr>
                <td><input type='checkbox' name='foo' value='$row[0] $row[cas_od]'></td>
                <td>$row[0]</td>
			    <td>$id_mail</td>
			    <td>$row[vymazany]</td>
			    <td>$row[poslat]</td>
			    <td>$row[id_skupina]</td>
			    <td>$row[nazov]</td>
			    <td>$time_from</td>
			    <td>$time_to</td>
			    <td class='delete'><img alt='delete'  id='D$id_mail' src='./images/delete.png' onclick=\"IDU('pok', 'b10fb50537d357e0bcd28b904d46afa4b7a695d6', '$row[0]', '$row[id_skupina]', '$row[cas_od]')\" style='width:20px;'/></td>
			    <td id='B$id_mail'><img alt='plus' src='./images/plus.png' onclick=\"pridajskupinu('B$id_mail', '$row[0]')\" style='width:20px;'/></td>
			</tr>";
    }
    echo "</table>";
    showDeleted();
    echo '
<p class="center"> ' . $GLOBALS['mails_to_group'] . '
<input type="text" list="group" name="group" />
<datalist id="group">';
    $sql = $dbconn4->query("SELECT nazov FROM skupina");
    foreach ($sql as $row) echo "
    <option> $row[0] </option>";
    echo '
</datalist>';

}

function group($dbconn4, $order, $select, $value)
{
    $query = "SELECT * FROM skupina ";
    if ($select != '') { //mam select konkretnych hodnot
        $query = $query . " WHERE ";
        $select = explode(" ", $select);
        $value = explode(" ", $value);
        for ($i = 0; $i < count($select); $i++) {
            if ($i == 0)
                $query = $query . $select[$i] . " = '" . $value[$i] . "' ";
            else
                $query = $query . " AND " . $select[$i] . " = '" . $value[$i] . "' ";
        }
    }

    if ($order != '') { //mam nejaky order
        $order = explode(" ", $order);
        for ($i = 0; $i < count($order); $i++) {
            if ($i == 0)
                $query = $query . " ORDER BY " . $order[$i];
            else
                $query = $query . ", " . $order[$i];
        }
        if ($_SESSION['KontaktOrder'] % 2 != 1) {
            $query = $query . " desc";
        }
        $_SESSION['KontaktOrder']++;

    }
    $sql = $dbconn4->query($query);

    echo "
        <table id='skupiny'>
            <tr>
                <th onclick=\"IDU('pok','023d69ed795d2cfd4fa2db3f8f52b47599aa14ad','id','c253f7677eea7bae64acc35a26a69632f942f19e','')\"  style='width:30px;'>ID</th>
                <th onclick=\"IDU('pok','023d69ed795d2cfd4fa2db3f8f52b47599aa14ad','nazov','c253f7677eea7bae64acc35a26a69632f942f19e','')\" >" . $GLOBALS['group_name'] . "</th>
	            <th class='mouse nothover' style='width:20px;'></th>
	        </tr>";
    foreach ($sql as $row) {
        echo "
            <tr>
                <td>$row[0]</td>
			    <td>$row[1]</td>
			    <td class='delete'><img alt='delete'  id='D$row[0]' src='./images/delete.png' onclick=\"IDU('pok', '023d69ed795d2cfd4fa2db3f8f52b47599aa14ad', '', '9485989ff514b5106b7738850fd73c23e8c1e3f7', '$row[0]')\" style='width:20px;'/></td>
			</tr>";
    }
    echo "</table>";
}

function attention($dbconn4, $order, $select, $value){
    $sql = $dbconn4->query("SELECT * FROM upozornenie ");
    echo "
        <table id='upozornenie'>
            <tr>
                <th onclick=\"IDU('pok','','','','')\"  style='width:30px;'>ID</th>
                <th onclick=\"IDU('pok','','','','')\" >" . $GLOBALS['key'] . "</th>
                <th onclick=\"IDU('pok','','','','')\" >" . $GLOBALS['value'] . "</th>
                <th onclick=\"IDU('pok','','','','')\" >" . $GLOBALS['reason'] . "</th>
                <th onclick=\"IDU('pok','','','','')\" >" . $GLOBALS['operation'] . "</th>
	            <th class='mouse nothover' style='width:20px;'></th>
	            <th class='mouse nothover' style='width:20px;'></th>
	        </tr>";
    foreach ($sql as $row) {
        echo "
            <tr>
                <td>$row[0]</td>
			    <td>$row[1]</td>
			    <td>$row[2]</td>
			    <td>$row[3]</td>
			    <td>$row[4]</td>
			    <td><img alt='plus' src='./images/ok.png' onclick=\"POKUS()\" style='width:20px;'/></td>
			    <td><img alt='delete' src='./images/delete.png' onclick=\"POKUS()\" style='width:20px;'/></td>
			</tr>";
    }
    echo "</table>";
}

function showDeleted()
{
    echo '<div class="center"><p><button value="" onclick=IDU("pok","cff635c44dc551bc46e6709429aff85045f71925","","")>' . $GLOBALS['hide_show'] . '</button>';
}


