<?php
// Realiza la conexión a la base de datos (reemplaza los valores con los tuyos)
$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'nombre_base_de_datos');

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Suponiendo que recibes el ID desde el formulario
    $nuevo_nombre = $_POST['nombre'];
    $nuevo_email = $_POST['email'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Verificar si las contraseñas coinciden
    if ($nueva_contrasena === $confirmar_contrasena) {
        // Has verificaciones adicionales si es necesario (longitud, seguridad, etc.)

        // Actualizar la información en la base de datos
        $sql = "UPDATE nombre_de_la_tabla SET nombre='$nuevo_nombre', email='$nuevo_email', new_password='$nueva_contrasena' WHERE id = '$id'";

        if ($conexion->query($sql) === TRUE) {
            echo "Perfil actualizado exitosamente";
        } else {
            echo "Error al actualizar el perfil: " . $conexion->error;
        }
    } else {
        echo "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
    }

    // Cierra la conexión
    $conexion->close();
}
?>
