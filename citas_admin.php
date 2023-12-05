<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlogin_registerdb";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = trim($_POST["id_usuario"]);
    $nombre_usuario = trim($_POST["nombre"]);
    $fecha = trim($_POST["fecha"]);
    $hora = trim($_POST["hora"]);

    // Verificar si ya existe una cita para el usuario y la fecha seleccionada
    $verificarCita = "SELECT * FROM citas WHERE id_usuario=? AND fecha=? AND hora=?";

    $stmt = $conexion->prepare($verificarCita);
    $stmt->bind_param("sss", $id_usuario, $fecha, $hora);
    $stmt->execute();
    echo "Consulta de verificación: " . $verificarCita . "<br>";

    $resultadoVerificacion = $stmt->get_result();

    if ($resultadoVerificacion->num_rows > 0) {
        // Ya existe una cita para este usuario en la fecha y hora seleccionadas
        $error = "Ya existe una cita para este usuario en la fecha y hora seleccionadas.";
    } else {
        // Insertar datos en la tabla de citas
        $insertarCita = "INSERT INTO citas (id_usuario, nombre, fecha, hora) VALUES (?, ?, ?, ?)";

        $stmt = $conexion->prepare($insertarCita);
        $stmt->bind_param("ssss", $id_usuario, $nombre_usuario, $fecha, $hora);

        if ($stmt->execute()) {
            header("Location: tabladisponibilidad.php");
        } else {
            echo "Error al programar la cita: " . $stmt->error;
        }
    }

    $stmt->close();
}

// conexion a usuarios
$conexion_usuarios = new mysqli($servername, $username, $password, $dbname);
// cierre de conexion
$conexion_usuarios->close();
$conexion->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="citas.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dating Platform</title>
    <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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

<body>

    <body style="background-color: #f3f3f3;">
        <div class="d-flex">
            <div class="black-container">
                <div id="sidebar-container">



                </div>

                <div class="menu-container" id="menu-container">
                    <div class="menu">
                        <a href="indexmod_admin.html" class="my-custom-block"><i class="ion-md-apps"></i>Overview</a>
                        <a href="" class="my-custom-block" id="Summary-button"><i class="ion-md-funnel"></i>Summary</a>

                        <a href="#" class="my-custom-block" id="custom-view-button"><i class="ion-md-arrow-dropdown"></i></b>Quotes<b></b></a>

                        <div id="hidden-buttons-container">
                            <a href="citas_admin.php" class="my-custom-block" id="hidden-button-1"><i class="ion-md-mail"></i>enter availability</a>
                            <a href="disponibilidad_admin.php" class="my-custom-block" id="hidden-button-2"><i class="ion-md-cart"></i><b>see availability</b></a>
                            <a href="users_admin.php" class="my-custom-block" id="hidden-button-3"><i class="ion-md-book"></i>Admin users</a>
                            <a href="" class="my-custom-block" id="hidden-button-4"><i class="ion-md-person"></i>Customers</a>
                        </div>
                        <hr style="width: 186px; height: 1px; background-color: grey; border: none; margin: 10px 0;">
                        <a href="" class="my-custom-block" id="settings-button"><i class="ion-md-cog"></i>Settings</a>
                        <a href="" class="my-custom-block" id="Help-button">Help</a>
                        <a href="Perfil.html" class="my-custom-block" id="Contact-button">Edit Profile</a>
                        <a href="loginmod.html" class="my-custom-block" id="Log-button"><i class="ion-md-open"></i>Log out</a>

                    </div>
                </div>
            </div>

            <div class="horizontal-container" style="display: flex; align-items: center;">

                <div style="display: flex; flex-direction: column;">
                    <b>Welcome administrator <span id="admin-name"></span></b>
                    <p style="color: #8c8c8d; font-size: 18px;"></p>
                </div>


                <ul class="navbar-nav ml-auto">
                    <li class="navbar-nav dropdown">
                        <div class="position-relative">
                            <a href="#" class="my-custom-block" id="perfil-button" style="color:black !important; text-decoration: none !important; font-family: 'Source Sans 3', sans-serif !important; font-size: 16px !important; background-color: transparent !important;font-weight: normal !important;">
                                <img src="" class="img-fluid rounded-circle avatar mr-2 small-avatar">
                                <span id="user-name">User</span>
                                <i class="ion-md-arrow-dropdown"></i>
                            </a>
                            <div id="hidden-buttons-container5" class="position-absolute" style="top: 100%; left: 0; display: none;">

                                <a href="loginmod.html" class="my-custom-block" id="hidden-button-5" style="color: black !important; text-decoration: none !important; font-family: 'Source Sans 3', sans-serif !important; font-size: 14px !important; background-color: transparent !important;font-weight: normal !important;">Log
                                    out</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        </div>
        </div>
        <div class="whatsapp-button">
        <a href="https://wa.me/3013519794" target="_blank">
          <img src="whatsapp-icon-png.png" alt="WhatsApp">
        </a>
      </div>




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

        <?php
        if (!empty($error)) {
            echo '<script>alert("' . $error . '");</script>';
        }
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const campoFecha = document.getElementById('fecha');
                const campoHora = document.getElementById('hora');

                flatpickr(campoFecha, {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    minDate: "today",
                    onChange: function(selectedDates, dateStr, instance) {
                        const eventoFecha = new CustomEvent('fechaSeleccionada', {
                            detail: {
                                fecha: selectedDates[0]
                            }
                        });
                        calendario.dispatchEvent(eventoFecha);
                    }
                });

                // Flatpickr 
                flatpickr(campoHora, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                });

                // Agrega la siguiente función para mostrar una alerta si el servidor devuelve un mensaje de error
                <?php
                if (isset($_GET['error'])) {
                    echo 'alert("' . $_GET['error'] . '");';
                }
                ?>
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Manejar el clic en #perfil-button para mostrar/ocultar #hidden-buttons-container5
                $("#perfil-button").click(function(e) {
                    e.preventDefault();
                    $("#hidden-buttons-container5").toggle();
                });

                // Obtener el nombre del administrador usando AJAX
                $.ajax({
                    url: "get_admin_name.php",
                    type: "GET",
                    success: function(data) {
                        $("#admin-name").text(data);
                    },
                    error: function() {
                        $("#admin-name").text("Error al obtener el nombre");
                    }
                });


                // Obtener el nombre de usuario usando AJAX
                $.ajax({
                    url: "get_user_name.php", // Ajusta la URL según tu estructura de archivos
                    type: "GET",
                    success: function(data) {
                        $("#user-name").text(data);
                    },
                    error: function() {
                        $("#user-name").text("Error al obtener el nombre de usuario");
                    }
                });
            });
        </script>


        <script>
            const customViewButton = document.getElementById('custom-view-button');
            const hiddenButtonsContainer = document.getElementById('hidden-buttons-container');
            customViewButton.addEventListener('click', () => {
                hiddenButtonsContainer.classList.toggle('show');
            });

            const profileDropdown = document.getElementById('profile-dropdown');
        </script>

    </body>

</html>