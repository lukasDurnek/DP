<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$_SESSION['language'] = 'sk';
require('config.php');
$par = exec("ls");
echo $par;
//echo phpinfo();

//echo "ZACIATOK POKUS";
//$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
//$username = 'pracabakalarka@gmail.com';
//$password = '554452554452';
//$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
//echo "   2";




echo '
<!DOCTYPE html>
<head>
    <title>' . $title . '</title>
    <link rel="stylesheet" href="styly/stylLog.css">
	<script type="text/javascript"></script>
</head>

<body>
<div>
    <form action="#" method="post" >
        <p>' . $name . '		<input type="text"      name="login" align="right" style="width: 100px; " placeholder="nick"/></p>
        <p>' . $password . '		<input type="password"  name="password" align="right" style="width: 100px; " placeholder="' . $password . '"/></p>
        <p>                     <input type="submit"    name="btn1" value="' . $log_in . '" /></p>
    </form>';
echo "
</div>";

if (isset($_POST['btn1'])) {
    require('databaza.php');
    $sql = $dbconn4->query("select id, login, heslo, prava FROM $_SESSION[TableUzivatel]  WHERE login='$_POST[login]' AND prava != 'removed'");
    foreach ($sql as $row) {
        $Tid = $row["id"];
        $Tlogin = $row["login"];
        $Theslo = $row["heslo"];
        $Tprava = $row["prava"];
    }

    if (sha1($_POST['password']) == $Theslo && $_POST['password'] != "") {
        $_SESSION['prihlaseny'] = 'ano';
        $_SESSION['id'] = $Tid;
        $_SESSION['login'] = $Tlogin;
        $_SESSION['rights'] = $Tprava;

        $sql = $dbconn4->query("insert into $_SESSION[TablePrihlasenie](id_uzivatel, cas) values('$Tid', CURRENT_TIMESTAMP )");
        //echo "<meta http-equiv='Refresh' content='1; URL=http://st.fri.uniza.sk/~kozak28/engine.php'>";
		echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/dp/engine.php'>";
    } else
        echo "<p class='center'> $wrong_mail_password </p>";
}

?>
<!--</body>-->
<!--</html>-->
<?php
//
//$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
//$username = 'pracabakalarka@gmail.com';
//$password = '554452554452';
//echo "som tu2";
//
//$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
//echo "som tu3";
//$in=imap_open("{pop.gmail.com:995/pop3/ssl}","pracabakalarka@gmail.com", "554452554452");
//$msgs=imap_headers($in); // gets the headers from the currently available msgs
//$nummessages =count($msgs);
//echo "som tu";
//
//
//function gmail_login_page()
//{
//    ?>
<!--    <html>-->
<!--    <head><title>Gmail summary login</title>-->
<!--        <style type="text/css">body { font-family: arial, sans-serif; margin: 40px;}</style>-->
<!--    </head>-->
<!--    <body>-->
<!--    <div>This page demonstrates how to access your Gmail account using IMAP in PHP. </div><br/>-->
<!--    <div>Enter your full email address and password, and the next page will show a selection of information about your account.</div><br/>-->
<!--    <hr/><br/>-->
<!--    <div>-->
<!--        <form action="index.php" method="POST">-->
<!--            <input type="text" name="user"> Gmail address<br/>-->
<!--            <input type="password" name="password"> Password<br/>-->
<!--            <br/>-->
<!--            <input type="submit" value="Get summary">-->
<!--        </form>-->
<!--    </div>-->
<!--    <hr/>-->
<!--    </body>-->
<!--    </html>-->
<!--    --><?php
//}
//
//function gmail_summary_page($user, $password)
//{
//    ?>
<!--    <html>-->
<!--    <head><title>Gmail summary for --><?//=$user?><!--</title>-->
<!--        <style type="text/css">body { font-family: arial, sans-serif; margin: 40px;}</style>-->
<!--    </head>-->
<!--    <body>-->
<!--    --><?php
//
//    $imapaddress = "{imap.azet.sk:993/imap/ssl}";
//    $imapmainbox = "INBOX";
//    $maxmessagecount = 10;
//
//    display_mail_summary($imapaddress, $imapmainbox, $user, $password, $maxmessagecount);
//    ?>
<!--    </body>-->
<!--    </html>-->
<!--    --><?php
//}
//
//function display_mail_summary($imapaddress, $imapmainbox, $imapuser, $imappassword, $maxmessagecount)
//{
//    $imapaddressandbox = $imapaddress . $imapmainbox;
//
//    $connection = imap_open ($imapaddressandbox, $imapuser, $imappassword)
//    or die("Can’t connect to ‘" . $imapaddress .
//        "’ as user ‘" . $imapuser .
//        "’ with password ‘" . $imappassword .
//        "’: " . imap_last_error());
//
//    echo "<u><h1>Gmail information for " . $imapuser ."</h1></u>";
//
//    echo "<h2>Mailboxes</h2>\n";
//    $folders = imap_listmailbox($connection, $imapaddress, "*")
//    or die("Can’t list mailboxes: " . imap_last_error());
//
//    foreach ($folders as $val)
//        echo $val . "<br />\n";
//
//    echo "<h2>Inbox headers</h2>\n";
//    $headers = imap_headers($connection)
//    or die("can’t get headers: " . imap_last_error());
//
//    $totalmessagecount = sizeof($headers);
//
//    echo $totalmessagecount . " messages<br/><br/>";
//
//    if ($totalmessagecount<$maxmessagecount)
//        $displaycount = $totalmessagecount;
//    else
//        $displaycount = $maxmessagecount;
//
//    for ($count=1; $count<=$displaycount; $count+=1)
//    {
//        $headerinfo = imap_headerinfo($connection, $count)
//        or die("Couldn’t get header for message " . $count . " : " . imap_last_error());
//        $from = $headerinfo->fromaddress;
//        $subject = $headerinfo->subject;
//        $date = $headerinfo->date;
//        echo "<em><u>".$from."</em></u>: ".$subject." – <i>".$date."</i><br />\n";
//    }
//
//    echo "<h2>Message bodies</h2>\n";
//
//    for ($count=1; $count<=$displaycount; $count+=1)
//    {
//        $body = imap_body($connection, $count)
//        or die("Can’t fetch body for message " . $count . " : " . imap_last_error());
//        echo "<pre>". htmlspecialchars($body) . "</pre><hr/>";
//    }
//
//    imap_close($connection);
//}
//
//$user = $_POST["user"];
//$password = $_POST["password"];
//
//echo $user;
//
//if (!$user or !$password)
//    gmail_login_page();
//else
//    gmail_summary_page($user, $password);