<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "crmtecnoservice";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$uname = $_POST['uname'];
$psw = $_POST['psw'];


$sql = "SELECT id FROM users WHERE username = '$uname' AND password = '$psw'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "¡Inicio de sesión exitoso!";
} else {
    
    echo "Usuario o contraseña incorrectos.";
}

$conn->close();
?>

