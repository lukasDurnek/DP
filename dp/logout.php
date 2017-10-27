<?php
@session_start();
unset($_SESSION['prihlaseny']);
header("Location: http://localhost/dp/engine.php");
?>