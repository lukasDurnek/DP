<?php
require('base.php');
$title = $GLOBALS['new_user'];
$active = 4;
$table='';
$action='';
generateBase();

echo '
<form id="formular" action="#" method="post">
    <p>' . $fname . '        <input type="text" required style="width: 150px;" placeholder="Lukáš" name="name"/></p>
    <p>' . $surname . ' 	<input type="text" required style="width: 150px;" placeholder="Durnek" name="surname"/></p>
    <p>' . $login . '       <input type="text" style="width: 150px;" placeholder="John124" name="login"/></p>
    <p>' . $password . '       <input type="password" style="width: 150px;" placeholder="' . $password . ' " name="password1"/></p>
    <p>' . $password . '       <input type="password" style="width: 150px;" placeholder="' . $password . ' " name="password2"/></p>
    <p>' . $rights . '       <input type="text" style="width: 150px;" placeholder="admin" name="rights"/></p>
    <p>                 <input type="submit" name="btn1" value="' . $add . '" /></p>
</form>
';

require('databaza.php');
if (isset($_POST['btn1'])) {
    if ($_POST['name'] != "" && $_POST['surname'] != "" && $_POST['password1'] != "" && $_POST['login'] != "") {
        $error = 0;
        $_POST[login]=trim($_POST[login]);
        $sql = $dbconn4->query("select id from $_SESSION[TableUzivatel] where login='$_POST[login]'");
        foreach ($sql as $row) {
            $error = $row["id"];
        }
        if ($error != 0) {
            echo "<p class='center error'> $existing_login </p>";
        }
        if ($_POST['password1'] != $_POST['password2']) {
            echo "<p class='center error'> $mismatched_passwords </p>";
            $error = 1;
        }

        if ($error == 0) {
            $password = sha1($_POST['password1']);
            $_POST[name]=trim($_POST[name]);
            $_POST[surname]=trim($_POST[surname]);

            $sql = $dbconn4->query("insert into $_SESSION[TableUzivatel](meno, priezvisko, login, heslo, prava) values('$_POST[name]','$_POST[surname]','$_POST[login]','$password','$_POST[rights]')");
            echo "<p class='center success'> $user_add </p>";
        }
    } else echo "<p class='center error'> $unlisted_field </p>";
}
?>
</body>
</html>