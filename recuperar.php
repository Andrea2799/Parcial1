<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlogin_registerdb";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El correo electrónico existe en la base de datos
      
        header("Location: cambiar_contraseña.php");
    } else {
              echo "El correo electrónico no existe en nuestra base de datos.";
    }
}


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
    <form action="" method="POST">
        <label for="email">
                        Enter Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">validate</button>
    </form>
</div>

</body>
</html>