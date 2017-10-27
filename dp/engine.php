<?php
require('base.php');
$title = 'ENGINE';
$active = 1;
$table = '';
$action = '';
$attachment = '';
generateBase();

            $dir = './upload/';
            $files = scandir($dir);
            if(count($files) <= 2){
                $attachment = 'Žiadny súbor';
            }else{
                for ($j = 2; $j < count($files); $j++) {
                    $attachment = $attachment . '<b>||'.$files[$j].'||</b>  ';
                }
            }
echo '
<div class="center">
    <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <div><p>'.$attach_files.' '.$attachment.'  
            </p></div>
            <input type="submit" value="' . $upload . '" name="submit">
            <input type="submit" value="' . $remove_attachment .'" name="delete">
    </form>

    <form action="" method="post">
        <p>' . $groups . '<input id="groups" type="text" name="groups"/></p>
        <p>' . $header . '<input id="header" type="text" name="header"/></p>
        <p><textarea rows="10" cols="100" name="text" placeholder="' . $textmail . '"></textarea></p>
        <p>' . $after_sending . '<input id="countMail" type="text" name="countMail" style=\'width:25px;\'> ' . $wait . '<input id="pocetSek" type="text" name="pocetSek" style=\'width:25px;\'>  ' . $seconds . '</p>
        <p>' . $possibility_remove . '<input type="checkbox" value="true" name="link"> 
        <input type="submit" name="send"></p>
    </form><br>

</div>';
$myfile = fopen("sleep.php", "w") or die("Unable to open file!");

//try {
//    echo "ZACIATOK POKUS 2";
//    $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
//    $username = 'pracabakalarka@gmail.com';
//    $password = '554452554452';
//    $inbox = imap_open($hostname,$username,$password);
//    echo "ZACIATOK POKUS";
//    //$mailbox = imap_open("{imap.gmail.com:993/imap/ssl}INBOX", "pracabakalarka@gmail.com", "554452554452") or die('Cannot connect to Gmail: ' . imap_last_error());
//} catch (Exception $e) {
//    echo 'Caught exception: ',  $e->getMessage(), "\n";
//}
//
// echo "zaciatok pokus";
// $hostname = '{imap.gmail.com:993/imap/ssl}inbox';
// $username = 'pracabakalarka@gmail.com';
// $password = '554452554452';
// //$inbox = imap_open($hostname,$username,$password) or die('cannot connect to gmail: ' . imap_last_error());
// echo "   2";
// $mailbox = imap_open("{imap.gmail.com:993/imap/ssl}inbox", "pracabakalarka@gmail.com", "554452554452") or die('cannot connect to gmail: ' . imap_last_error());
// echo "   2";
// $mail = imap_search($mailbox, "all");
// $mail_headers = imap_headerinfo($mailbox, $mail[0]);
// $subject = $mail_headers->subject;
// $from = $mail_headers->fromaddress;
// imap_setflag_full($mailbox, $mail[0], "\\seen \\flagged");
// imap_close($mailbox);

if (isset($_POST['send'])) {
    $posted_emails = 0;
    $number_mails = $_POST['countMail'];
    echo $number_mails . "<br>";
    $waitSeconds = 0;
    $mails = "";
    //
    $date = date('H:i:s');
    echo "Zaciatok" . $date . "<br>";
    require('databaza.php');
    $sql = $dbconn4->query("select nextval('sprava_id_seq')");
    foreach ($sql as $row) {
        $Next_Id_message = $row["nextval"];
    }
    $sql = $dbconn4->query("insert into sprava(id, id_uzivatel, hlavicka, sprava, cas) values('$Next_Id_message','$_SESSION[id]','$_POST[header]','$_POST[text]',CURRENT_TIMESTAMP)");

    $groups = explode(", ", $_POST['groups']);
    foreach ($groups as $row) {
        //
        $date = date('H:i:s');
        echo "Vyberam e-maily" . $date . "<br>";

        $sql = $dbconn4->query("SELECT mail.id, mail_male FROM Mail JOIN Mail_spec ON (mail.id = mail_spec.id_mail) JOIN skupina on (skupina.id = mail_spec.id_skupina) where poslat='true' AND  vymazany='false' AND cas_do IS NULL AND nazov='$row'");
        //
        $date = date('H:i:s');
        echo "OK" . $date . "<br>";
        foreach ($sql as $mail) {
            $mails = $mails . " " . $mail[0] . " " . $mail[1];
        }
    }
    $mails = explode(" ", implode(" ", array_unique(explode(" ", trim($mails)))));
	require('/PHPMailer-master/PHPMailerAutoload.php');
    for ($i = 0; $i < count($mails); $i++) {
        if (!is_numeric($mails[$i])) {
            //
            $date = date('H:i:s');
            echo "Vyberam osobne udaje" . $date . "<br>";
            $sql = $dbconn4->query("SELECT pred, meno, priezvisko, za FROM kontakt JOIN mail ON (kontakt.id = mail.id_kontakt) where mail='$mails[$i]'");
            //
            $date = date('H:i:s');
            echo "ok" . $date . "<br>";
            foreach ($sql as $name) {
                $addressing = "$name[0] $name[1] $name[2] $name[3]";
                $fname = $name[1];
                $lname = $name[2];
            }
            $message = str_replace("__OSLOVENIE__", $addressing, $_POST['text']);
            $message = str_replace("__name__", $fname, $message);
            $message = str_replace("__PRIEZVISKO__", $lname, $message);
            if (isset($_POST['link']))
                $message = $message . "
Ak si neprajete dostávať viacero e-mailov, kliknite na nasledujuci odkaz http://st.fri.uniza.sk/~kozak28/idu.php?action=7720ea5d2793ba68c692a819ea4089ed92e11bdf&idintable=" . sha1("table=kontakt&text=web&action=delete&idintable=" . $mails[$i]);
//echo 'http://'.$_SERVER['HTTP_HOST'];

            $i -= 1;
            //
            $date = date('H:i:s');
            echo "Vkladam udaje" . $date . "<br>";
            $sql = $dbconn4->query("insert into Prijemca(id_sprava, id_mail) values('$Next_Id_message','$mails[$i]')");
            //
            $date = date('H:i:s');
            echo "OK" . $date . "<br>";
            $i += 1;
            //
			
            $date = date('H:i:s');
            echo "Vytvaram a posielam Mail" . $date . "<br>";

			//posielanie mailu - doplnil LD

                    $mail = new PHPMailer();
                    $mail->SMTPDebug = 0;
                    $mail->CharSet = 'UTF-8';

                    $body = $message;

                    $mail->IsSMTP();
                    $mail->Host = 'smtp.gmail.com';

                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->SMTPDebug = 2;
                    $mail->SMTPAuth = true;

                    $mail->Username = 'pracabakalarka@gmail.com';
                    $mail->Password = '554452554452';

                    $mail->SetFrom('pracabakalarka@gmail.com', 'server');
                    //$mail->AddReplyTo('pracabakalarka@gmail.com','no-reply');
                    $mail->Subject = $_POST['header'];
                    //$mail->MsgHTML($body);
                    $mail->Body = $body;
                    var_dump($mails[$i]);
                    $mail->AddAddress($mails[$i]);



			//prilohy k mailu
			//$mail->addAttachment('./upload/kredity.txt');

			//$mail->send();

            $dir = './upload/';
            $files = scandir($dir);
            for ($j = 2; $j < count($files); $j++) {
                echo $files[$j];
                $mail->addAttachment($dir.$files[$j]);
            }


            if(isset($_POST['send'])){
                $mail->send();
            }


            $dir = './upload/';
            $files = scandir($dir);
            for ($j = 2; $j < count($files); $j++) {
               // echo $files[$j];
                unlink($dir.$files[$j]);
            }

            $date = date('H:i:s');
            echo "OK" . $date . "<br>";
        }
    }
    $delete_attachment='<?php require("databaza.php");
    $files = scandir("./upload/");
    for ($i = 0; $i < count($files); $i++) {
        $dir = "./upload/";
        $dir = $dir . $files[$i];
        echo $dir;
        $p = fopen($dir, "r");
        $data = fread($p, filesize($dir));
        $data = addslashes($data);
        $dat = pg_escape_bytea($data);
        $sql = $dbconn4->query("insert into Priloha(id_sprava, priloha) values('.$Next_Id_message.','.'{$dat}'.')");
        exec("rm " . $dir);
    }?>';
    fwrite($myfile, $delete_attachment);
    exec('php sleep.php > ./message.txt &');

}

if (isset($_POST['submit'])) {
    echo "<br>";
    $target_dir = './upload/';
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    header("Refresh:0");

//    $dir = './upload/';
//    $files = scandir($dir);
//    if(count($files) <= 2){
//        $attachment = 'Žiadny súbor';
//    }else{
//        for ($j = 2; $j < count($files); $j++) {
//            $attachment = $attachment . '<b>||'.$files[$j].'||</b>  ';
//        }
//    }
}
if(isset($_POST['delete'])){    // ak je spustene tlacidlo delete vymaze vsetky prilohy
    $dir = './upload/';
    $files = scandir($dir);
    if(count($files) > 2){
        for ($j = 2; $j < count($files); $j++) {
            unlink($dir.$files[$j]);
        }
    }
    header("Refresh:0");
}



/* skuska odoslania  emailu*/
/*if (isset($_POST['send'])) {
	require('/PHPMailer-master/PHPMailerAutoload.php');
$mail=new PHPMailer();
$mail->CharSet = 'UTF-8';

$body = 'Posielam skusobnu spravu';

$mail->IsSMTP();
$mail->Host       = 'smtp.gmail.com';

$mail->SMTPSecure = 'tls';
$mail->Port       = 587;
$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = true;

$mail->Username   = 'pracabakalarka@gmail.com';
$mail->Password   = '554452554452';

$mail->SetFrom('pracabakalarka@gmail.com');
//$mail->AddReplyTo('pracabakalarka@gmail.com','no-reply');
$mail->Subject    = 'Vazeny pan profesor';
//$mail->MsgHTML($body);
$mail->Body = $body;

$mail->AddAddress('ldurnek@gmail.com');

//prilohy k mailu
//$mail->addAttachment('./upload/fcie_BLOB_CLOB.sql');

$mail->send();

}
*/

?>
</body>
</html>
