<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Source Sans 3', sans-serif;
        }

        .container {
            text-align: center;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            font-family: 'Source Sans 3', sans-serif;
        }

        .container label,
        .container input,
        .container button {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Change Password</h2>
    <form action="procesar_cambio_contrasena.php" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required><br><p>
        <label for="password">New Password:</label><br>
        <input type="password" name="password" id="password" required><br><p>
        <!-- Nuevo campo para confirmar la contraseña -->
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" name="confirm_password" id="confirm_password" required><br><p>
        <button type="submit">Change Password</button>
    </form>
</div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar que la contraseña y la confirmación coincidan
    if ($new_password !== $confirm_password) {
        echo "La contraseña y la confirmación de contraseña no coinciden.";
    } else {
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
}
?>