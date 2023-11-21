<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "modlogin_registerdb";

$conexion_usuarios = new mysqli($servername, $username, $password, $dbname);

if ($conexion_usuarios->connect_error) {
    die("Error de conexión a la base de datos de usuarios: " . $conexion_usuarios->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST["name"];
    $input_password = $_POST["pass"];

       // Consulta para obtener todos los campos del usuario seleccionado
       $queryUsuario = "SELECT ID, name, email, user, pass FROM usuarios WHERE name = '$name_usuario'";
       $resultUsuario = $conexion_usuarios->query($queryUsuario);
   
       if ($resultUsuario->num_rows > 0) {
           $rowUsuario = $resultUsuario->fetch_assoc();
           $stored_password = $rowUsuario["pass"];
   
           // Verificar la contraseña
           if (password_verify($input_password, $stored_password)) {
               // Contraseña correcta, redirigir a la página de horarios
               $_SESSION["user_id"] = $rowUsuario["ID"];
               header("Location: tablasdiponibilidad.php");
           } else {
               // Contraseña incorrecta, mostrar un mensaje de error
               echo "Incorrect password. Please try again.";
           }
       } else {
           echo "User not found.";
       }
   }
?>