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
    
    $ID = $_POST["ID"];
    $Name = $_POST["Name"];
    $last_Name= $_POST["last_Name"];
    $Nombre_compañia = $_POST["Nombre_compañia"];
    $Celular= $_POST["Celular"];
    $Email = $_POST["Email"];

    
    
    $check_sql = "SELECT ID FROM contacto WHERE ID = '$ID'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $mensaje = "The ID already exists, it cannot be repeated.";
    } else {
       
        $sql = "INSERT INTO  contacto (ID, Name, last_Name,  Nombre_compañia, Celular, Email) VALUES ('$ID', '$Name', '$last_Name', '$Nombre_compañia', '$Celular', '$Email')";
    
        if ($conn->query($sql) === TRUE) {
            $mensaje = "contact sent successfully, We will be in contact with you soon";
        } else {
            $mensaje = "Error sending contact: " . $conn->error;
        }
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
    
    <div id="mensaje" style="font-family: 'Source Sans 3', sans-serif; display: none; color: #000000; background-color: #ffff; text-align: center;padding: 50px; border-radius: 5px"><?php echo $mensaje; ?> 

<a href="contacto.html" id="hidden-button-2"><iclass="ion-md-cart"><br></i>Back</a>

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