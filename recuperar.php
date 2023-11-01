<?php
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array();
if (!empty($_POST)) {
    $email = $mysqli->real_escape_string($_POST['email']);

    if (!isEmail($email)) {
        $errors[] = "Debes ingresar un correo electrónico válido";
    }
}
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