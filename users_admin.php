<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlogin_registerdb";

$conexion_usuarios = new mysqli($servername, $username, $password, $dbname);

if ($conexion_usuarios->connect_error) {
    die("Error de conexión a la base de datos de usuarios: " . $conexion_usuarios->connect_error);
}

// Manejar la eliminación de usuarios
if (isset($_POST['id_usuario'])) {
    $idUsuario = $_POST['id_usuario'];

    // No eliminar al administrador (ID 1)
    if ($idUsuario != 1) {
        // Consulta preparada para eliminar al usuario
        $queryEliminarUsuario = "DELETE FROM usuarios WHERE ID = ?";
        $stmt = $conexion_usuarios->prepare($queryEliminarUsuario);
        $stmt->bind_param("i", $idUsuario);
        $resultadoEliminar = $stmt->execute();

        if ($resultadoEliminar) {
            echo "<script>alert('Usuario eliminado correctamente');</script>";
        } else {
            echo "<script>alert('Error al eliminar usuario');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('No puedes eliminar al administrador');</script>";
    }
}

// Obtener lista de usuarios
$queryUsuarios = "SELECT ID, name, email, user, id_cargo FROM usuarios WHERE ID != 1"; // Excluir al administrador
$resultUsuarios = $conexion_usuarios->query($queryUsuarios);

$conexion_usuarios->close();
?>


<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="citas.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dating Platform</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    
   
   <script>
        $(document).ready(function() {
            
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

</head>

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

    <div class="container mt-4">
        <h1 class="text-center">Usuarios</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User</th>
                    <th>Cargo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($resultUsuarios) && $resultUsuarios->num_rows > 0) {
                    while ($rowUsuario = $resultUsuarios->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $rowUsuario['ID'] . "</td>";
                        echo "<td>" . $rowUsuario['name'] . "</td>";
                        echo "<td>" . $rowUsuario['email'] . "</td>";
                        echo "<td>" . $rowUsuario['user'] . "</td>";
                        echo "<td>" . $rowUsuario['id_cargo'] . "</td>";
                        echo "<td>
                                <form method='post' action='' id='form_usuario_" . $rowUsuario['ID'] . "'>
                                    <input type='hidden' name='id_usuario' value='" . $rowUsuario['ID'] . "'>
                                    <button type='button' class='btn btn-danger' onclick='confirmDelete(" . $rowUsuario['ID'] . ", \"" . $rowUsuario['name'] . "\")'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(idUsuario, nombre) {
            var result = confirm("¿Seguro que quieres eliminar al usuario " + nombre + "?");
            if (result) {
                // Si el usuario confirma, enviar el formulario para eliminar directamente
                document.getElementById('form_usuario_' + idUsuario).submit();
            }
        }
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