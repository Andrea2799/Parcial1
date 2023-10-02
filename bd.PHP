<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "crmtecnoservice";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ID_Productos = $_POST["ID_Productos"];
    $Nombre = $_POST["Nombre"];
    $Descripcion = $_POST["Descripcion"];
    $Precio = $_POST["Precio"];
    $Tipo_De_Licencia= $_POST["Tipo_De_Licencia"];
    $Version = $_POST["Version"];

    
    $sql = "INSERT INTO productos (ID_Productos, Nombre, Descripcion, Precio, Tipo_De_Licencia, Version) VALUES ('$ID_Productos', '$Nombre', '$Descripcion', '$Precio', '$Tipo_De_Licencia', '$Version')";
    
    if ($conn->query($sql) === TRUE) {
        $mensaje = "";
    } else {
        $mensaje = "Error al agregar el producto: " . $conn->error;
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
    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #000;
        }

        #mensaje-container {
            background-color: #000; 
            color: #0f0; 
            text-align: center;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    
    <div id="mensaje" style="font-family: 'Source Sans 3', sans-serif; display: none; color: #000000; background-color: #ffff; text-align: center;padding: 50px; border-radius: 5px"><?php echo $mensaje; ?> 
The form was added successfully. <br>
<a href="Productos.php" id="hidden-button-2"><iclass="ion-md-cart"></i>see</a>

</div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mensaje = document.getElementById("mensaje");
            if (mensaje.textContent !== "") {
                mensaje.style.display = "block";
            }
        });
    </script>
</body>
</html>