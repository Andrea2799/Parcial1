<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Citas</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Tabla de Citas</h2>

<table>
    <tr>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Hora</th>
    </tr>

    <?php
   $servername = "localhost";
   $username = "root";
   $password = "19994710";
   $dbname = "modlogin_registerdb";

    // Crear conexión
    $conexion = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Consultar la tabla de citas con solo las columnas necesarias
    $consulta = "SELECT nombre, fecha, hora FROM citas";
    $resultado = $conexion->query($consulta);

    // Mostrar los datos en la tabla
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['fecha']}</td>
                    <td>{$fila['hora']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No hay citas disponibles.</td></tr>";
    }

    // Cerrar la conexión
    $conexion->close();
    ?>

</table>

</body>
</html>
