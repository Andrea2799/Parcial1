<?php
// obtener_horarios.php

$selectedUser = $_POST['usuario'];

// Realiza la consulta a la base de datos para obtener los horarios del usuario seleccionado
// Aquí debes adaptar la consulta según la estructura de tu base de datos y tus necesidades
// El siguiente código es solo un ejemplo:

$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "modlogin_registerdb";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$queryHorarios = "SELECT * FROM citas WHERE nombre = '$selectedUser'";
$resultHorarios = $conexion->query($queryHorarios);

// Cerrar la conexión a la base de datos
$conexion->close();

// Mostrar los resultados en una tabla
echo "<h2>Horarios disponibles para el usuario $selectedUser:</h2>";
echo "<table class='table'>";
echo "<thead>";
echo "<tr>";
echo "<th>ID Cita</th>";
echo "<th>Fecha</th>";
echo "<th>Hora</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

while ($row = $resultHorarios->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . $row['fecha'] . "</td>";
    echo "<td>" . $row['hora'] . "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
?>
