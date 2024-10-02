<?php

$dbhost = "localhost";
$dbuser = "ugzl49";
$dbpass = "2yTpvYgzu4fAig0R";
$dbname = "ugzl49_1";

if(!$workercon = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect!");
}
