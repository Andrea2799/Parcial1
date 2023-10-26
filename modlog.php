<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlog";


$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$uname = $_POST['uname'];
$psw = $_POST['psw'];


$sql = "SELECT id FROM users WHERE username = '$uname' AND password = '$psw'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // El usuario y la contraseña son correctos
    echo "¡Inicio de sesión exitoso!";
} else {
    // El usuario o la contraseña son incorrectos
    echo "Usuario o contraseña incorrectos.";
}

$conn->close();
?>