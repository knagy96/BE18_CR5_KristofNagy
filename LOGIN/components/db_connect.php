<?php


$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "be18_cr5_animal_adoption_kristof_nagy";

//create connection

$connect = new mysqli($localhost, $username, $password, $dbname);

//check connection
if($connect -> connect_error) {
    die("Connection Faild: " .$connect -> connect_error);
}