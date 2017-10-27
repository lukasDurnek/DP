<?php
var_dump($_FILES);
echo "<br>";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
$target_dir = "/home/kozak28/public_html/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo "$target_file";
?>