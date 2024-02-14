<?php
/* Local Database*/
date_default_timezone_set('America/La_Paz');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NOWDEMY_pharmacy";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?> 