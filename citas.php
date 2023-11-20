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
        header("Location: tabladecitas.php");
        exit();
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
    <title>CRM TECNOSERVICE</title>
    <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    
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
<div class="d-flex">
        <div class="black-container">
            <div id="sidebar-container">



            </div>

            <div class="menu-container" id="menu-container">
                <div class="menu">
                    <a href="indexmod.html" class="my-custom-block"><i class="ion-md-apps"></i>Overview</a>
                    <a href="" class="my-custom-block" id="Summary-button"><i
                            class="ion-md-funnel"></i>Summary</a>

                    <a href="#" class="my-custom-block" id="custom-view-button"><i
                            class="ion-md-arrow-dropdown"></i>Quotes</a>

                    <div id="hidden-buttons-container">
                        <a href="citas.php" class="my-custom-block" id="hidden-button-1"><i
                                class="ion-md-mail"></i>schedule</a>
                        <a href="" class="my-custom-block" id="hidden-button-2"><i
                                class="ion-md-cart"></i>Products</a>
                        <a href="" class="my-custom-block" id="hidden-button-3"><i
                                class="ion-md-book"></i>Orders</a>
                        <a href="" class="my-custom-block" id="hidden-button-4"><i
                                class="ion-md-person"></i>Customers</a>
                    </div>
                    <hr style="width: 186px; height: 1px; background-color: grey; border: none; margin: 10px 0;">
                    <a href="" class="my-custom-block" id="settings-button"><i
                            class="ion-md-cog"></i>Settings</a>
                    <a href="" class="my-custom-block" id="Help-button">Help</a>
                    <a href="Perfil.html" class="my-custom-block" id="Contact-button">Edit Profile</a>
                    <a href="loginmod.html" class="my-custom-block" id="Log-button"><i class="ion-md-open"></i>Log out</a>

                </div>
            </div>
        </div>



                <div class="horizontal-container" style="display: flex; align-items: center;">

                    <div class="left-column">
                        <div style="display: flex; flex-direction: column; margin-left: 50px !important;">
                            <b>Assign Appointments</b>
                        </div>
                    </div>

                    <ul class="navbar-nav ml-auto">
                        <li class="navbar-nav dropdown">
                            <div class="position-relative">
                                <a href="login.html" class="my-custom-block" id="perfil-button"
                                    style="color:black !important; text-decoration: none !important; font-family: 'Source Sans 3', sans-serif !important; font-size: 16px !important; background-color: transparent !important;font-weight: normal !important;">
                                    <img src="" class="img-fluid rounded-circle avatar mr-2 small-avatar">
                                    user
                                    <i class="ion-md-arrow-dropdown"></i>
                                </a>
                                <div id="hidden-buttons-container5" class="position-absolute"
                                    style="top: 100%; left: 0; display: none;">

                                    <a href="loginmod.html" class="my-custom-block" id="hidden-button-5"
                                        style="color: black !important; text-decoration: none !important; font-family: 'Source Sans 3', sans-serif !important; font-size: 14px !important; background-color: transparent !important;font-weight: normal !important;">Log
                                        out</a>
                                </div>
                                </a>
                        </li>
                    </ul>
                </div>

            </div>


        </div>

        <div class="additional-container" style="display: flex; flex-wrap: wrap; width:100%; height: 100%;">
        <section style="flex: 1; height: 100vh; display: flex; justify-content: center; align-items: center;">
            <div class="card-header2 bg-light"
                style="flex: 1; height: 100vh; display: flex; justify-content: center; align-items: center;">
                <div class="container">
                    <h1 class="text-center mt-4"></h1>

                    <div id="calendario"></div>

                    <div id="horas-disponibles">
                        <h2>Available Hours</h2>
                        <ul id="lista-horas"></ul>
                    </div>

                    <form method="POST" action="tabladecitas.php"> 
                        <div id="formulario-cita" class="mx-auto mt-4 d-flex flex-column justify-content-center">
                            <label for="id_usuario">User ID:</label>
                            <input type="text" name="id_usuario" id="id_usuario" required class="form-control">

                            <label for="nombre">Name:</label>
                            <input type="text" name="nombre" id="nombre" required class="form-control">

                            <label for="fecha">Date and Time:</label>
                            <input type="text" name="fecha" id="fecha" readonly class="form-control">

                            <label for="hora">Hours:</label>
                            <input type="text" name="hora" id="hora" readonly class="form-control">

                            <button type="submit" class="btn btn-primary mt-3">Schedule Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const campoFecha = document.getElementById('fecha');
        const campoHora = document.getElementById('hora');

        flatpickr(campoFecha, {
            enableTime: true,  
            dateFormat: "Y-m-d H:i",  
            minDate: "today",
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
            </div>
        </section>
    </div>
    </div>



    </div>
    </div>


    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#perfil-button").click(function (e) {
                e.preventDefault();
                $("#hidden-buttons-container5").toggle(); 
            });
        });
    </script>
    
    <script>
        const customViewButton = document.getElementById('custom-view-button');
        const hiddenButtonsContainer = document.getElementById('hidden-buttons-container');
        customViewButton.addEventListener('click', () => {
            hiddenButtonsContainer.classList.toggle('show');
        });




    </script>

</body>

</html>
</script>

</body>

</html>