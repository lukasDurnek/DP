<?php
header('Content-Type: text/html; charset=utf-8');
@session_start();
require('config.php');

function generateBase()
{
    if (!isset($_SESSION['prihlaseny'])) {
        $_SESSION['prihlaseny'] = "nie";
    }

    if ($_SESSION['prihlaseny'] != 'ano') {
        echo('
<!DOCTYPE html>
<head>
    <meta http-equiv="Refresh" content="2; URL=index.php" />
    <title>' . $GLOBALS['log_out'] . '</title>
</head>
<body>' . $GLOBALS['log_out'] . '</body>
</html>
        ');
        die("");
    }


    echo "
<!doctype html>
<head>
    <meta charset='utf-8'>
    <link rel='stylesheet' href='styly/menu.css'>
    <script src='script.js'></script>
    <title>" . $GLOBALS['title'] . "</title>
</head>
<body>

<div id='cssmenu'>
    <ul>";
    if ($GLOBALS['active'] == 1) echo "
        <li class='active'><a href='#'>Engine</a></li> "; else echo "
        <li><a href='engine.php'>Engine</a></li>";
    if ($_SESSION['rights'] === "admin") {

        if ($GLOBALS['active'] == 2 || $GLOBALS['active'] == 3) echo "
        <li class='active has-sub'><a href='#'>" . $GLOBALS['contacts'] . "</a>"; else echo "
        <li class='has-sub'><a href='#'>" . $GLOBALS['contacts'] . "</a>";
        if ($GLOBALS['active'] == 2) echo "
            <ul>
                <li class='has-sub'><a class='active' href='novy_kontakt.php'><span>" . $GLOBALS['new_contact'] . "</span></a></li>
                <li class='has-sub'><a href='kontakty.php'><span>" . $GLOBALS['contacts'] . "</span></a></li>
            </ul>
        </li>";
        if ($GLOBALS['active'] == 3) echo "
            <ul>
                <li class='has-sub'><a href='novy_kontakt.php'><span>" . $GLOBALS['new_contact'] . "</span></a></li>
                <li class='active has-sub'><a href='kontakty.php'><span>" . $GLOBALS['contacts'] . "</span></a></li>
            </ul>
        </li>";
        if ($GLOBALS['active'] != 2 && $GLOBALS['active'] != 3) echo "
            <ul>
                <li class='has-sub'><a href='novy_kontakt.php'><span>" . $GLOBALS['new_contact'] . "</span></a></li>
                <li class='has-sub'><a href='kontakty.php'><span>" . $GLOBALS['contacts'] . "</span></a></li>
            </ul>
        </li>

        ";

        if ($GLOBALS['active'] == 4 || $GLOBALS['active'] == 5) echo "
        <li class='active has-sub'><a href='#'><span>" . $GLOBALS['users'] . "</span></a>"; else echo "
        <li class='has-sub'><a href='#'><span>" . $GLOBALS['users'] . "</span></a>";
        if ($GLOBALS['active'] == 4) echo "
            <ul>
                <li class='active has-sub'><a href='novy_uzivatel.php'><span>" . $GLOBALS['new_user'] . "</span></a></li>
                <li class='has-sub'><a href='uzivatelia.php'><span>" . $GLOBALS['users'] . "</span></a></li>
            </ul>
        </li>";
        if ($GLOBALS['active'] == 5) echo "
            <ul>
                <li class='has-sub'><a href='novy_uzivatel.php'><span>" . $GLOBALS['new_user'] . "</span></a></li>
                <li class='active has-sub'><a href='uzivatelia.php'><span>" . $GLOBALS['users'] . "</span></a></li>
            </ul>
        </li>";
        if ($GLOBALS['active'] != 4 && $GLOBALS['active'] != 5) echo "
            <ul>
                <li class='has-sub'><a href='novy_uzivatel.php'><span>" . $GLOBALS['new_user'] . "</span></a></li>
                <li class='has-sub'><a href='uzivatelia.php'><span>" . $GLOBALS['users'] . "</span></a></li>
            </ul>
        </li>";

        if ($GLOBALS['active'] == 6 || $GLOBALS['active'] == 7) echo "
        <li class='active has-sub'><a href='#'><span>" . $GLOBALS['groups'] . "</span></a>"; else echo "
        <li class='has-sub'><a href='#'><span>" . $GLOBALS['groups'] . "</span></a>";
        if ($GLOBALS['active'] == 6) echo "
            <ul>
                <li class='active has-sub'><a href='adminskupiny.php'><span>" . $GLOBALS['administration_group'] . "</span></a></li>
                <li class='has-sub'><a href='skupiny.php'><span>" . $GLOBALS['arrangement'] . "</span></a></li>
            </ul>
        </li>";
        if ($GLOBALS['active'] == 7) echo "
            <ul>
                <li class='has-sub'><a href='adminskupiny.php'><span>" . $GLOBALS['administration_group'] . "</span></a></li>
                <li class='active has-sub'><a href='skupiny.php'><span>" . $GLOBALS['arrangement'] . "</span></a></li>
            </ul>
        </li>";
        if ($GLOBALS['active'] != 6 && $GLOBALS['active'] != 7) echo "
            <ul>
                <li class='has-sub'><a href='adminskupiny.php'><span>" . $GLOBALS['administration_group'] . "</span></a></li>
                <li class='has-sub'><a href='skupiny.php'><span>" . $GLOBALS['arrangement'] . "</span></a></li>
            </ul>
        </li>";

        if ($GLOBALS['active'] == 8) echo "
        <li class='active has-sub'><a href='#'><span>" . $GLOBALS['searching_web'] . "</span></a>"; else echo "
        <li class='has-sub'><a href='browsing_web.php'><span>" . $GLOBALS['searching_web'] . "</span></a>";
        if ($GLOBALS['active'] == 9) echo "
        <li class='active has-sub'><a href='#'><span>" . $GLOBALS['config'] . "</span></a>"; else echo "
        <li class='has-sub'><a href='setEmail.php'><span>" . $GLOBALS['config'] . "</span></a>";


        if ($GLOBALS['active'] == 10 || ($GLOBALS['active'] == 11 ) ||  ($GLOBALS['active'] == 12))  echo "
            <li class='active has-sub'><a href='#'><span>" . $GLOBALS['mail_addresses'] . "</span></a>";
        else  echo "
            <li class='has-sub'><a href='#'><span>" . $GLOBALS['mail_addresses'] . "</span></a>";


        if($GLOBALS['active'] == 10) echo "
            <ul>
                <li class='active has-sub'><a href='zberAdries2.php'><span>" . $GLOBALS['collection_of_addresses'] . "</span></a></li>
                <li class='has-sub'><a href='searching_addresses.php'><span>" .$GLOBALS['searching_adr'] . "</span></a></li>
                <li class='has-sub'><a href='analyzed_mails.php'><span>" .$GLOBALS['analyzed_mails'] . "</span></a>
                    <ul class='submenu'>
                        <li><a href='analyzed_mails.php' onclick=\"IDU('pok','unexistingEmails','','755084a108fdfcd60abd95388cfcce04c1b80574','')\" title='Sub Menu'>" . $GLOBALS['unexistingMails'] . "</a></li>
                        <li><a href='#' title='Sub Menu'>" . $GLOBALS['spam'] . "</a></li>
                    </ul>
                </li>
            </ul>
        ";

        if($GLOBALS['active'] == 11) echo "
            <ul>
                <li class='has-sub'><a href='zberAdries2.php'><span>" . $GLOBALS['collection_of_addresses'] . "</span></a></li>
                <li class='active has-sub'><a href='searching_addresses.php'><span>" .$GLOBALS['searching_adr'] . "</span></a></li>
                <li class='has-sub'><a href='analyzed_mails.php'><span>" .$GLOBALS['analyzed_mails'] . "</span></a>
                    <ul class='submenu'>
                        <li><a href='analyzed_mails.php' onclick=\"IDU('pok','unexistingEmails','','755084a108fdfcd60abd95388cfcce04c1b80574','')\" title='Sub Menu'>" . $GLOBALS['unexistingMails'] . "</a></li>
                        <li><a href='#' title='Sub Menu'>" . $GLOBALS['spam'] . "</a></li>
                    </ul>
                </li>
            </ul>
        ";

        if($GLOBALS['active'] == 12) echo "
            <ul>
                <li class='has-sub'><a href='zberAdries2.php'><span>" . $GLOBALS['collection_of_addresses'] . "</span></a></li>
                <li class='has-sub'><a href='searching_addresses.php'><span>" .$GLOBALS['searching_adr'] . "</span></a></li>
                <li class='active has-sub'><a href='analyzed_mails.php'><span>" .$GLOBALS['analyzed_mails'] . "</span></a>
                    <ul class='submenu'>
                        <li><a href='analyzed_mails.php' onclick=\"IDU('pok','unexistingEmails','','755084a108fdfcd60abd95388cfcce04c1b80574','')\" title='Sub Menu'>" . $GLOBALS['unexistingMails'] . "</a></li>
                        <li><a href='#' title='Sub Menu'>" . $GLOBALS['spam'] . "</a></li>
                    </ul>
                </li>
            </ul>
        ";

        if ($GLOBALS['active'] != 10 && $GLOBALS['active'] != 11 && $GLOBALS['active'] != 12) echo "
            <ul>
                <li class='has-sub'><a href='zberAdries2.php'><span>" . $GLOBALS['collection_of_addresses'] . "</span></a></li>
                <li class='has-sub'><a href='searching_addresses.php'><span>" . $GLOBALS['searching_adr'] . "</span></a></li>
                 <li class='has-sub'><a href='analyzed_mails.php'><span>" . $GLOBALS['analyzed_mails'] . "</span></a>
                    <ul class='submenu'>
                        <li><a href='analyzed_mails.php' onclick=\"IDU('pok','unexistingEmails','','755084a108fdfcd60abd95388cfcce04c1b80574','')\" title='Sub Menu'>" . $GLOBALS['unexistingMails'] . "</a></li>
                        <li><a href='#' title='Sub Menu'>" . $GLOBALS['spam'] . "</a></li>
                    </ul>
                 </li>
            </ul>
        </li>";

    }
    echo "
        <li class='last ' ><a href='logout.php'>" . $GLOBALS['cancel'] . "</a></li>
        <li class='last has-sub'><a href='#'><span>" . $GLOBALS['language'] . "</span></a>
            <ul>
                <li class='has-sub language'><a href='' onclick=\"IDU('hide', 'SK', '', '', '')\"> SK</a></li>
                <li class='has-sub language'><a href='' onclick=\"IDU('hide', 'EN', '', '', '')\"> EN</a></li>
            </ul>
        </li>
    </ul>
</div>";
    echo "<link rel='stylesheet' href='styly/styly.css'>"; echo '
<h1>' . $GLOBALS['title'] . '</h1>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>';
if(isset($GLOBALS['table']) && isset($GLOBALS['action'])){
	echo '
<script>
$(document).ready(IDU("pok","' . $GLOBALS['table'] . '","","' . $GLOBALS['action'] . '",""));
</script>


    ';
}
}
//echo $GLOBALS['table'];
//exit;

//generateBase();