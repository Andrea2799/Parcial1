<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
</head>
<body>
<div class="container">
    <h2>Cambiar Contraseña</h2>
    <form action="procesar_cambio_contrasena.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Nueva Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Cambiar Contraseña</button>
    </form>
</div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['password'];

    // Hash de la nueva contraseña
    $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
    
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "19994710Andrea";
    $dbname = "modlog";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Sentencia preparada para actualizar la contraseña
    $sql = "UPDATE usuarios SET pass = ? WHERE email = ?";
  

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $hashedPassword, $email);

        if ($stmt->execute()) {
            // Contraseña actualizada con éxito
            echo "Contraseña actualizada con éxito. Puede <a href='loginmod.html'>iniciar sesión</a> con su nueva contraseña.";
        } else {
            echo "Error al actualizar la contraseña: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
    
    $conn->close();
}
?>

