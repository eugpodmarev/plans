<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "plans";

// $conn = mysqli_connect($servername, $username, $password, $dbname);
// if(!$conn){
// 	die("Connection failed:".mysqli_connect_error());
// }



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plans";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
	die(mysqli_connect_error());
}