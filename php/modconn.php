<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "modlogin_registerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if($conn->connect_error){
    die("Conexión fallida: " . $conn->connect_error);
}

// Resto del código si es necesario
?>
