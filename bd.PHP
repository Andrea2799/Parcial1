<?php
$servername = "localhost";
$username = "root";
$password = "19994710";
$dbname = "crmtecnoservice";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
    
    
}
else {
    echo "Conexión establecida correctamente";
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
        echo "Producto agregado con éxito.";
    } else {
        echo "Error al agregar el producto: " . $conn->error;
    }
}


$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

// Mostrar los datos en la tabla HTML
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


