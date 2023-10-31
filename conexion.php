<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

// Crear la conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Seleccionar base de datos
$conexion->select_db($database);

// Las siguientes variables representan el nombre de la tabla y los nombres de las columnas
$tablaUsuarios = "usuarios";
$columnaNuevaPassword = "new_password";
$columnaConfirmarPassword = "confirm_password";
$columnaNombre = "name";
$columnaEmail = "email";
$columnaPassword = "password";
$columnaUser = "user";

// Puedes realizar consultas a la tabla de usuarios con estas nuevas columnas

?>




