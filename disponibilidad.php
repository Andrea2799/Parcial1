<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
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
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Mis Horarios</h1>

        <form id="horarios-form">
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

        <!-- Contenedor para mostrar los horarios -->
        <div id="horarios-container" class="mt-4"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Manejar el envío del formulario mediante AJAX
            $('#horarios-form').submit(function (event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del formulario

                // Obtener el valor seleccionado del usuario
                var selectedUser = $('#usuario').val();

                // Realizar la solicitud AJAX
                $.ajax({
                    type: 'POST',
                    url: 'obtener_horarios.php',
                    data: { usuario: selectedUser },
                    success: function (response) {
                        // Actualizar el contenido del contenedor con los horarios disponibles
                        $('#horarios-container').html(response);
                    },
                    error: function () {
                        alert('Error al obtener los horarios.');
                    }
                });
            });
        });
    </script>
</body>
</html>

