<?php 	
date_default_timezone_set('America/La_Paz');
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "nowdemy_pharmacy";
$store_url = "http://localhost/dawapharma/";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>