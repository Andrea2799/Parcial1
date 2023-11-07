<?php
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
    $email = $_POST['email'];

    // Consulta para verificar si el correo electrónico existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El correo electrónico existe en la base de datos, genera un token único
        $token = bin2hex(random_bytes(16)); // Genera un token seguro de 32 caracteres hexadecimal

        // Guarda el token en la base de datos junto con la dirección de correo electrónico y una marca de tiempo para la expiración
        $timestamp = date("Y-m-d H:i:s");
        $sql = "UPDATE usuarios SET token='$token', token_expiracion='$timestamp' WHERE email='$email'";
        $conn->query($sql);

        // Ahora puedes enviar un correo electrónico al usuario con el enlace que contiene el token para restablecer la contraseña

        // Redirigir a la página de cambio de contraseña
        header("Location: cambiar_contrasena.php?token=$token");
    } else {
        // El correo electrónico no existe en la base de datos, mostrar un mensaje de error al usuario
        echo "El correo electrónico no existe en nuestra base de datos.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
</head>
<body>

<div class="container">
    <h2>Recuperar Contraseña</h2>
    <form action="procesar_recuperacion.php" method="POST">
        <label for="email">Ingresar Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Enviar</button>
    </form>
</div>

</body>
</html>