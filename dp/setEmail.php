<?php
require('base.php');
$title = $GLOBALS['config'];
$active = 9;
$table = '';
$action = '';
generateBase();

echo "<form id='formular' action='#' method='post' onsubmit=\"return checkFormR(this,'$format_mail')\">";
echo '
    <p>' . $mail . ' 		<input type="text" required style="width: 150px;" placeholder="' . $mail_example . '" name="email"/></p>
    <p>' . $fname . '        <input type="text" required style="width: 150px;" placeholder="Lukáš" name="name"/></p>
    <p>' . $password . '       <input type="password" style="width: 150px;" placeholder="' . $password . ' " name="password1"/></p>
    <p>' . $server . '       <input type="text" style="width: 150px;" placeholder="' . $server_name . ' " name="server"/></p>

    <p>                 <input type="submit" name="send" value="' . $add . '" /></p>
</form>';

require('databaza.php');
if (isset($_POST['send'])) {
    $config = 'set from = "MAIL"
set realname = "MENO"
set imap_user = "MAIL"
set imap_pass = "PASSWORD"
set folder = "imaps://imap.SERVER.com:993"
set spoolfile = "+INBOX"
set postponed ="+[SERVER]/Drafts"
set header_cache =~/BC/.mutt/cache/headers
set message_cachedir =~/BC/.mutt/cache/bodies
set certificate_file =~/BC/.mutt/certificates
set smtp_url = "smtp://MAIL:587/"
set smtp_pass = "PASSWORD"
set move = no
set imap_keepalive = 900
set copy=no';
    $config = str_replace("MAIL", $_POST['email'], $config);
    $config = str_replace("NAME", $_POST['name'], $config);
    $config = str_replace("PASSWORD", $_POST['password1'], $config);
    $config = str_replace("SERVER", $_POST['server'], $config);
    echo $config;
}