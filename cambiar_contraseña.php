<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "19994710Andrea";
$dbname = "modlog";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = $_POST['password'];

    // Verificar si el token es válido y aún está dentro del período de validez (debes implementar esta verificación)

    // Actualizar la contraseña en la base de datos
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE usuarios SET pass='$hashedPassword' WHERE token='$token'";
    $conn->query($sql);

    // Limpia el token en la base de datos
    $sql = "UPDATE usuarios SET token=NULL, token_expiracion=NULL WHERE token='$token'";
    $conn->query($sql);

    // Redirigir al usuario a una página de éxito o inicio de sesión
    header("Location: cambio_contrasena_exitoso.php");
}

// Cerrar la conexión a la base de datos
$conn->close();
?>