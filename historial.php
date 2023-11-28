<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlogin_registerdb";


$conexion_citas = new mysqli($servername, $username, $password, $dbname);


if ($conexion_citas->connect_error) {
    die("Error de conexión a la base de datos de citas: " . $conexion_citas->connect_error);
}


if (isset($_POST['ver_horarios'])) {
    $nombreSeleccionado = $_POST['nombre'];

    $queryHorarios = "SELECT nombre, fecha, hora FROM citas WHERE nombre = '$nombreSeleccionado'";
    $resultHorarios = $conexion_citas->query($queryHorarios);
}


$conexion_citas->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>

<body style="background-color: #f3f3f3;">
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
                                class="ion-md-mail"></i>enter availability</a>
                        <a href="disponibilidad.php" class="my-custom-block" id="hidden-button-2"><i
                                class="ion-md-cart"></i><b>see availability</b></a>
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
                <div style="display: flex; flex-direction: column;">
                    <b>Welcome
                        <p style="color: #8c8c8d; font-size: 18px;">
                        </p>
                </div>
            </div>


            <ul class="navbar-nav ml-auto">
                <li class="navbar-nav dropdown">
                    <div class="position-relative">
                        <a href="#" class="my-custom-block" id="perfil-button"
                            style="color:black !important; text-decoration: none !important; font-family: 'Source Sans 3', sans-serif !important; font-size: 16px !important; background-color: transparent !important;font-weight: normal !important;">
                            <img src="" class="img-fluid rounded-circle avatar mr-2 small-avatar">
                            User
                            <i class="ion-md-arrow-dropdown"></i>
                        </a>
                        <div id="hidden-buttons-container5" class="position-absolute"
                            style="top: 100%; left: 0; display: none;">

                            <a href="loginmod.html" class="my-custom-block" id="hidden-button-5"
                                style="color: black !important; text-decoration: none !important; font-family: 'Source Sans 3', sans-serif !important; font-size: 14px !important; background-color: transparent !important;font-weight: normal !important;">Log
                                out</a>
                       </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    </div>
    </div>
   <br> 
   <br> 
   <br> 
   <br> 
    
   <div class="container mt-4">
        <h1 class="text-center">My Schedules for <?php echo isset($nombreSeleccionado) ? $nombreSeleccionado : ''; ?></h1>

        
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>date</th>
                    <th>Hour</th>
                    <th>Scheduled</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if (isset($resultHorarios) && $resultHorarios->num_rows > 0) {
                    while ($rowHorario = $resultHorarios->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $rowHorario['nombre'] . "</td>";
                        echo "<td>" . $rowHorario['fecha'] . "</td>";
                        echo "<td>" . $rowHorario['hora'] . "</td>";
                        echo "<td>Additional Information</td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No se encontraron horarios para el nombre seleccionado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
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

        const profileDropdown = document.getElementById('profile-dropdown');
    </script>


</body>

</html>