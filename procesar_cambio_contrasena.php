<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "modlogin_registerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Actualizar la contraseña en la base de datos
    $sql = "UPDATE usuarios SET pass='$pass' WHERE email='$email'";
    $conn->query($sql);

    // Redirigir al usuario a una página de éxito o inicio de sesión
    header("Location: loginmod.html");
}
else {
    // Error en la consulta
    echo "Error al actualizar la contraseña: " . $conn->error;
}
$conn->close();
?>