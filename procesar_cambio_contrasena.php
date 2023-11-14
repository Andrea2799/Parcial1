<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "modlogin_registerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$email = isset($_POST['reset_email']) ? $_POST['reset_email'] : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_pass = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

// para que las contraseñas coincidan
if ($pass != $confirm_pass) {
    $error_message = "Passwords do not match. He tries again.<a href='cambiar_contraseña.php'>back</a>";
} else {
   
    $sql = "UPDATE usuarios SET pass='$pass' WHERE email='$email'";
    $conn->query($sql);

    if ($conn->error) {
        echo "Error al actualizar la contraseña: " . $conn->error;
    } else {
     
        $success_message = "Password updated successfully. You can <a href='loginmod.html'>log in</a> with your new password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Source Sans 3', sans-serif;
        }

        #result-container {
            text-align: center;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            font-family: 'Source Sans 3', sans-serif;
        }
    </style>
</head>
<body>
    <div id="result-container">
        <?php if (isset($success_message)): ?>
            <p><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
