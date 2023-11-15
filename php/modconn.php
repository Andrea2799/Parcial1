<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlogin_registerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// conexión
if($conn->connect_error){
    die("Conexión fallida: " . $conn->connect_error);
}


?>
