<?php

class Connection_DB
{

static function getConnection(): PDO
{

    $servername = "localhost";
    $username = "root";
    $password = "";


    $conn = new PDO("mysql:host=$servername;dbname=sms_db", $username, $password);
    $conn->exec("set names utf8");
return $conn;

}
}
