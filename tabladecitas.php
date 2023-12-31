<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlogin_registerdb";

// Crear la conexión a la base de datos
$conexion_usuarios = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion_usuarios->connect_error) {
    die("Error de conexión a la base de datos de usuarios: " . $conexion_usuarios->connect_error);
}

// Consulta para obtener la lista de usuarios
$queryUsuarios = "SELECT ID, name FROM usuarios";
$resultUsuarios = $conexion_usuarios->query($queryUsuarios);

// Cerrar la conexión a la base de datos de usuarios
$conexion_usuarios->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Horarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .whatsapp-button img {
            width: 50px;
            /* Ajusta el tamaño según tus preferencias */
            height: auto;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Mis Horarios</h1>

        <form action="mis_horarios.php" method="post">
            <div class="form-group">
                <label for="usuario">Selecciona tu usuario:</label>
                <select name="usuario" id="usuario" class="form-control">
                    <?php
                    // Mostrar opciones del dropdown con los nombres de los usuarios
                    if ($resultUsuarios->num_rows > 0) {
                        while ($rowUsuario = $resultUsuarios->fetch_assoc()) {
                            echo "<option value='" . $rowUsuario['ID'] . "'>" . $rowUsuario['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ver Mis Horarios</button>
        </form>
    </div>
    <div class="whatsapp-button">
        <a href="https://wa.me/3013519794" target="_blank">
          <img src="whatsapp-icon-png.png" alt="WhatsApp">
        </a>
      </div>
</body>
</html>
