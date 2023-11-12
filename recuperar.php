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

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El correo electrónico existe en la base de datos
      
        header("Location: cambiar_contraseña.php");
    } else {
              echo "The email does not exist, please enter a valid email"; 
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

        .container button {
            margin-top: 30px;
            
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Recover Password</h2>
    <form action="" method="POST">
        <label for="email">Enter Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Validate</button>
    </form>
</div>

</body>
</html>