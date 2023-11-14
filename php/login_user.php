<?php
include 'modconn.php'; // Asegúrate de que esta inclusión apunte al archivo correcto de conexión a la base de datos

$email = $_POST['email'];
$pass = $_POST['pass'];

// Verifica si la conexión a la base de datos es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$validar_login = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email' AND pass = '$pass'");

if(mysqli_num_rows($validar_login) > 0){
    header("location: ../indexmod.html");
} else {
    echo '
        <script>
            alert("The user does not exist, please register with us");
            window.location = "../loginmod.html";
        </script>
    ';
    exit();
}
?>
