<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "trip_dbase";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
