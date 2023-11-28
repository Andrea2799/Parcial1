<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlogin_registerdb";

$idCita = $_GET['id'];

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$consulta = "DELETE FROM citas WHERE id = $idCita";
$resultado = $conexion->query($consulta);


$conexion->close();


echo "Cita cancelada con éxito.";
?>
