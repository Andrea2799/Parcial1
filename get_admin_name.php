<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlogin_registerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT name FROM usuarios WHERE id_cargo = 1 LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    echo $row["name"];
} else {
    
    echo "Usuario no encontrado";
}

$conn->close();
?>
