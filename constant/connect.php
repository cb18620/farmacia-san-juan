<?php 
// DB credentials.
date_default_timezone_set('America/La_Paz');
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "nowdemy_pharmacy";
//$store_url = "http://localhost/phpinventory/";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);

// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // Establecer la zona horaria para esta sesión
  $connect->query("SET SESSION time_zone = '-04:00'");
  // echo "Successfully connected";
}
?>
