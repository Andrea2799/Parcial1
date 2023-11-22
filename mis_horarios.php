<?php


$selectedUser = $_POST['usuario'];

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