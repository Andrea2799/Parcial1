<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "modlogin_registerdb";

// Crear la conexión a la base de datos
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Consultar los datos de la tabla citas
$queryCitas = "SELECT id_cita, id_usuario, nombre, fecha, hora FROM citas";
$resultCitas = $conexion->query($queryCitas);

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Citas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Tabla de Citas</h1>
        
        <?php
        // Verificar si hay datos en la tabla citas
        if ($resultCitas->num_rows > 0) {
            echo '<table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Cita</th>
                            <th>ID Usuario</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>';

            // Mostrar los datos en la tabla
            while ($rowCita = $resultCitas->fetch_assoc()) {
                echo '<tr>
                        <td>' . $rowCita['id_cita'] . '</td>
                        <td>' . $rowCita['id_usuario'] . '</td>
                        <td>' . $rowCita['nombre'] . '</td>
                        <td>' . $rowCita['fecha'] . '</td>
                        <td>' . $rowCita['hora'] . '</td>
                    </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p class="text-center">No hay citas registradas.</p>';
        }
        ?>
    </div>
</body>
</html>
