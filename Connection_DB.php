<?php

class Connection_DB
{

static function getConnection(){

    $servername = "localhost";
    $username = "root";
    $password = "";


    $conn = new PDO("mysql:host=$servername;dbname=sms_db", $username, $password);
return $conn;

}
}
