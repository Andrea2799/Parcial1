<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "modlogin_registerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Redirige a la página de recuperación si no se accede correctamente
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: recuperar.php");
    exit;
}

$email = $_POST['email'];
$pass = $_POST['password'];

// Actualizar la contraseña en la base de datos
$sql = "UPDATE usuarios SET pass='$pass' WHERE email='$email'";
$conn->query($sql);

// Verifica si hubo errores al actualizar la contraseña
if ($conn->error) {
    echo "Error al actualizar la contraseña: " . $conn->error;
} else {
    // Muestra un mensaje de éxito o error
    echo "Contraseña actualizada con éxito. Puede <a href='loginmod.html'>iniciar sesión</a> con su nueva contraseña.";
}

$conn->close();
?>