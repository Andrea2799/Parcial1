<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "modlogin_registerdb";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $id_usuario = $_POST["id_usuario"]; 
    $nombre_usuario = $_POST["nombre"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];

    // Insertar datos en la tabla de citas
    $insertarCita = "INSERT INTO citas (id_usuario, nombre, fecha, hora) VALUES ('$id_usuario', '$nombre_usuario', '$fecha', '$hora')";

    if ($conexion->query($insertarCita) === TRUE) {
        header("Location: tabladecitas.html");
            
    } else {
        echo "Error al programar la cita: " . $conexion->error;
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CITAS</title>
    <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="citas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4">Assign Appointments</h1>

        <div id="calendario"></div>

        <div id="horas-disponibles">
            <h2>Available Hours</h2>
            <ul id="lista-horas"></ul>
        </div>

        <form id="formulario-cita" class="mx-auto mt-4" method="post" action="citas.php">
            <label for="id_usuario">User ID:</label>
            <input type="text" name="id_usuario" id="id_usuario" required class="form-control">

            <label for="nombre">Name:</label>
            <input type="text" name="nombre" id="nombre" required class="form-control">

            <label for="fecha">Date and Time:</label>
            <input type="text" name="fecha" id="fecha" readonly class="form-control">

            <label for="hora">Hours:</label>
            <input type="text" name="hora" id="hora" readonly class="form-control">

            <button type="submit" class="btn btn-primary mt-3">Schedule Appointment</button>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const campoFecha = document.getElementById('fecha');
        const campoHora = document.getElementById('hora');

        flatpickr(campoFecha, {
            enableTime: true,  // Habilita la selección de fecha y tiempo
            dateFormat: "Y-m-d H:i",  // Formato de fecha y hora
            minDate: "today",  // Para evitar seleccionar fechas pasadas
            onChange: function (selectedDates, dateStr, instance) {
                const eventoFecha = new CustomEvent('fechaSeleccionada', {
                    detail: {
                        fecha: selectedDates[0]
                    }
                });
                calendario.dispatchEvent(eventoFecha);
            }
        });

        // Utiliza Flatpickr para seleccionar la hora
        flatpickr(campoHora, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    });
    </script>
</body>
</html>
