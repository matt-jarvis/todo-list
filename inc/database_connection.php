<?php

$host = 'localhost';
$name = 'tododb';
$user = 'root';
$pass = 'root';
$dsn = 'mysql:host=' . $host . ';dbname=' . $name . ';charset=utf8';

try
{
    $dbconn = new PDO($dsn, $user, $pass);
    $dbconn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e)
{
    echo 'Error: ' . $e->getMessage();
}

?>