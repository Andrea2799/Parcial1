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
    $id_producto = $_POST["id_producto"];

    
    $sql = "DELETE FROM productos WHERE ID_Productos = '$id_producto'";
    $result = $conn->query($sql);

    if ($conn->affected_rows > 0) {
        $mensaje = "The product was successfully removed";
    } else {
        $mensaje = "Sorry the product was not found";
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

    </style>
</head>
<body>
    
    <div id="mensaje" style="font-family: 'Source Sans 3', sans-serif; display: none; color: #000000; background-color: #ffff; text-align: center; padding: 50px; border-radius: 5px"><?php echo $mensaje; ?> 
       <br>
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

