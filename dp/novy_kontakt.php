<?php
require('base.php');
require('logger.php');
$title=$GLOBALS['new_contact'];
$active=2;
$table='';
$action='';
$post_email = '';
generateBase();

ini_set('display_errors', 'On');
if(isset($_POST['createCont'])){
    $post_email = $_POST['found_mail'];
}

echo "
<form id='formular' action='#' method='post' onsubmit=\"return checkFormR(this, '$format_mail')\">"; echo'
    <p>' . $title_before . '  <input type="text" style="width: 150px;" placeholder="Bc." name="before"/></p>
    <p>' . $fname . '        <input type="text" required style="width: 150px;" name="name"/></p>
    <p>' . $surname . ' 	<input type="text" required style="width: 150px;" name="surname"/></p>
    <p>' . $title_for . '    <input type="text" style="width: 150px;" placeholder="PhD." name="for"/></p>
    <p>' . $mail . ' 		<input type="text" required style="width: 150px;" placeholder="' . $mail_example . '" name="email" value="' .$post_email .'"/></p>
    <p>' . $to_send . '    <input type="checkbox" value="true" name="send"><br>
    <p>                 <input type="submit" name="btn1" value="' . $add . '" />
                        <a href="engine.php"><input type="button" name="storno" value="storno"></a>
    </p>
</form>

';
require('databaza.php');
var_dump($post_email);
var_dump($_POST);
if (isset($_POST['btn1']) && $_POST['name']!="" && $_POST['surname']!="" && $_POST['email']!="") {
    $Tid = 0; //Ak existuje zadany mail v databaze tak Tid nadobudne hodnotu roznu od nuly a odmietne vytvorit pouzivatela
    $Tid_fiction = 0;

    $_POST['email']=trim($_POST['email']);
    $mail_small=strtolower($_POST['email']);
    $sql = $dbconn4->query("select count(*) from $_SESSION[TableMail] where id_kontakt != -1 and mail_male='$mail_small'");
    foreach ($sql as $row) {
        $Tid = $row['count'];
    }

    //echo "prvy " . $Tid;
    $sql = $dbconn4->query("select count(*) as count_from_finding from $_SESSION[TableMail] where id_kontakt = -1 and mail_male='$mail_small'");
    foreach($sql as $row2){
        $Tid_fiction = $row2['count_from_finding'];
    }
    //echo "druhy" .$Tid_fiction;
    if ($Tid != 0 || $Tid_fiction > 2)
        echo "<p class='center error'> $existing_mail </p> ";
    else {
        $sql = $dbconn4->query("select nextval('osoba_id_seq')");
        foreach ($sql as $row) {
            $Next_Id_Contact = $row["nextval"];
        }

        $send = isset($_POST['send']) && $_POST['send'] ? 'true' : 'false';
        $_POST['name']=trim($_POST['name']);
        $_POST['surname']=trim($_POST['surname']);
        $_POST['before']=trim($_POST['before']);
        $_POST['for']=trim($_POST['for']);
        
        $hash_delete = sha1("table=kontakt&text=web&action=delete&idintable=".$mail_small);
        $sql = $dbconn4->query("insert into $_SESSION[TableKontakt](id, meno, priezvisko, pred, za) values('$Next_Id_Contact','$_POST[name]','$_POST[surname]','$_POST[before]','$_POST[for]')");
        $isPresent = ($isPresent = $dbconn4->query("SELECT * FROM $_SESSION[TableMail] WHERE id_kontakt = -1 AND mail = '$_POST[email]'")->fetchAll() && is_array($isPresent) && count($isPresent) > 0);

        if($isPresent) {
            $sql = $dbconn4->query("update $_SESSION[TableMail] set id_kontakt = '$Next_Id_Contact' where id_kontakt = -1 and mail = '$_POST[email]'");
        }else{
            $sql = $dbconn4->query("insert into $_SESSION[TableMail](id_kontakt, mail, mail_male, poslat, vymazany, zdroj, hash_delete,spam) values('$Next_Id_Contact','$_POST[email]','$mail_small','$send','false','$_SESSION[login]','$hash_delete','0')");
        }
        //var_dump($sql);
        //exit;

       // echo $Next_Id_Contact ."| " . $_POST['email'] . "| " . $post_email ."| ". $mail_small;
      //  var_dump($sql);
        echo "<p class='center success'> $contact_add </p>";
    }
}

?>
</body>
</html>