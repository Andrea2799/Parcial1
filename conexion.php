<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

$conexion = new mysqli($servername, $username, $password, $database);


if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}


$conexion->select_db($database);


$tablaUsuarios = "usuarios";
$columnaNuevaPassword = "new_password";
$columnaConfirmarPassword = "confirm_password";
$columnaNombre = "name";
$columnaEmail = "email";
$columnaPassword = "password";
$columnaUser = "user";



?>




