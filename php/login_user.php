<?php
include 'modconn.php';

$email = $_POST['email'];
$pass = $_POST['pass'];

// Verifica si la conexión a la base de datos es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$validar_login = mysqli_query($conn, "SELECT id_cargo FROM usuarios WHERE email = '$email' AND pass = '$pass'");

if(mysqli_num_rows($validar_login) > 0){
    $fila = mysqli_fetch_assoc($validar_login);
    $id_cargo = $fila['id_cargo'];

    // Redirección basada en el valor de id_cargo
    if ($id_cargo == 2) {
        header("Location: ../indexmod.html");
    } elseif ($id_cargo == 1) {
        header("Location: ../indexmod_admin.html");
    } else {
        echo '
            <script>
                alert("Invalid id_cargo");
                window.location = "../loginmod.html";
            </script>
        ';
        exit();
    }
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
