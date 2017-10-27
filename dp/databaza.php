<?php
const DB_HOST = 'localhost';
const DB_PORT = '5432';
const DB_NAME = 'KIS_databaza';
const DB_USER = 'durnek1';
const DB_PASSWORD = '12345';

$conn_string =
    "host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD;
try {
    $dbconn4 = new PDO("pgsql:" . $conn_string);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>