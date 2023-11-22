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
</body>

</html>