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
    <h1>Agendar cita</h1>
    <form action="Crearcita.php" method= "POST" class="formulario__citas">
                        <input type="text" placeholder="id_usuario" name="id_usuario">
                        <input type="text" placeholder="id_cita" name="id_cita">
                        <button>submit</button>
        </form>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modlogin_registerdb";

$conexioncita = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if($conexioncita->connect_error){
    die("Conexión fallida: " . $conexioncita->connect_error);
}

//$id_cita = $_POST["id_cita"];
//$id_usuario = $_POST["id_usuario"];

if(isset($_POST["id_cita"])) {
    $id_cita = $_POST["id_cita"];
} else {
    echo "No se proporcionó id_cita.";
}

$sql = "SELECT id_usuario FROM citas WHERE id_cita='$id_cita'";
$result = $conexioncita->query($sql);

if($result->num_rows >= 0) {
    while($row=$result->fetch_assoc()){
        if($row["id_usuario"] != 0){
            echo " La cita no esta disponible";
        }
        else{
            echo "La cita esta disponible";
        }

    }
}

  $conexioncita->close();

?>

</body>
</html>



