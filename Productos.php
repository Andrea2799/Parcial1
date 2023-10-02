<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "crmtecnoservice";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);    
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ID_Productos = $_POST["ID_Productos"];
    $Nombre = $_POST["Nombre"];
    $Descripcion = $_POST["Descripcion"];
    $Precio = $_POST["Precio"];
    $Tipo_De_Licencia= $_POST["Tipo_De_Licencia"];
    $Version = $_POST["Version"];

    
    $sql = "INSERT INTO productos (ID_Productos,Nombre, Descripcion, Precio, Tipo_De_Licencia, Version) VALUES ('$ID_Productos', '$Nombre', '$Descripcion', '$Precio', '$Tipo_De_Licencia', '$Version')";
    
    if ($conn->query($sql) === TRUE) {
        
       

    } else {
        echo "Error al agregar el producto: " . $conn->error;
    }
}
$conn->close();
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
</head>

<body>
    <div class="d-flex">

        <div class="black-container">

            <div id="sidebar-container">
                <div class="logo">
                    <img src="logo.jpg" alt="Logotipo TECNOSERVICE">
                </div>

                <div class="menu-container" id="menu-container">
                    <div class="menu">
                        <a href="index.html" class="my-custom-block"><i class="ion-md-apps"></i>Overview</a>
                        <a href="Summary1.html" class="my-custom-block" id="Summary-button"><i
                                class="ion-md-funnel"></i>Summary</a>
                        <a href="#" class="my-custom-block" id="custom-view-button"><i
                                class="ion-md-arrow-dropdown"></i>Custom view</a>
                        <div id="hidden-buttons-container">
                            <a href="#" class="my-custom-block" id="hidden-button-1"><i
                                    class="ion-md-mail"></i>Messages</a>
                            <a href="Productos.php" class="my-custom-block" id="hidden-button-2"><i
                                    class="ion-md-cart"></i>Products</a>
                            <a href="formorders.html" class="my-custom-block" id="hidden-button-3"><i
                                    class="ion-md-book"></i>Orders</a>
                            <a href="#" class="my-custom-block" id="hidden-button-4"><i
                                    class="ion-md-person"></i>Customers</a>
                        </div>
                        <hr style="width: 186px; height: 1px; background-color: grey; border: none; margin: 10px 0;">
                        <a href="#" class="my-custom-block" id="settings-button"><i class="ion-md-cog"></i>Settings</a>
                        <a href="#" class="my-custom-block" id="Help-button">Help</a>
                        <a href="#" class="my-custom-block" id="Contact-button">Contact us</a>
                        <a href="#" class="my-custom-block" id="Log-button"><i class="ion-md-open"></i>Log out</a>
                    </div>
                </div>


                <div class="horizontal-container" style="display: flex; align-items: center;">

                    <div class="left-column">
                        <div style="display: flex; flex-direction: column; margin-left: 50px !important;">
                            <b>Products</b>
                        </div>
                    </div>

                    <ul class="navbar-nav ml-auto">
                        <li class="navbar-nav dropdown">
                            <div class="position-relative">
                                <a href="#" class="my-custom-block" id="perfil-button"
                                    style="color:black !important; text-decoration: none !important; font-family: 'Source Sans 3', sans-serif !important; font-size: 16px !important; background-color: transparent !important;font-weight: normal !important;">
                                    <img src="perfil.png" class="img-fluid rounded-circle avatar mr-2 small-avatar">
                                    David Cordoba
                                    <i class="ion-md-arrow-dropdown"></i>
                                </a>
                                <div id="hidden-buttons-container5" class="position-absolute"
                                    style="top: 100%; left: 0; display: none;">

                                    <a href="#" class="my-custom-block" id="hidden-button-5"
                                        style="color: black !important; text-decoration: none !important; font-family: 'Source Sans 3', sans-serif !important; font-size: 14px !important; background-color: transparent !important;font-weight: normal !important;">Cerrar
                                        sesión</a>
                                </div>
                                </a>
                        </li>
                    </ul>
                </div>

            </div>


        </div>

        <div class="additional-container" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: flex-start; width: 100%; height: 100vh;">
    <section style="flex: 1; display: flex; justify-content: center; align-items: center;">
           <div class="card-header2 bg-light" style="flex: 1; margin-right: 10px; margin-top: 20px;">
           
                <div id="tablaproductos">
                <div class="title-container1">
            <a href="productosadd.html" class="my-custom-block" class="product-add"
               style="font-family: 'Source Sans 3', sans-serif; margin-top: 10px;background-color: #202123;text-decoration: none; color: #ffffff;">Add Products</a> 
            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Descriptión</th>
                            <th>Price</th>
                            <th>Type of license</th>
                            <th>Version</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "19994710";
                        $dbname = "crmtecnoservice";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Error de conexión: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM productos";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["ID_Productos"] . "</td>";
                                echo "<td>" . $row["Nombre"] . "</td>";
                                echo "<td>" . $row["Descripcion"] . "</td>";
                                echo "<td>" . $row["Precio"] . "</td>";
                                echo "<td>" . $row["Tipo_De_Licencia"] . "</td>";
                                echo "<td>" . $row["Version"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No se encontraron registros</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            
        </div>
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
                e.preventDefault(); // Previene el comportamiento predeterminado del enlace
                $("#hidden-buttons-container5").toggle(); // Muestra u oculta el botón "Cerrar sesión" al hacer clic en "perfil-button"
            });
        });
    </script>
    <!-- para hacer que el botón custom-view se despliegue -->
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
