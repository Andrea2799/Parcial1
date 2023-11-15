<?php
session_start();

// Verifica si hay un correo almacenado en la sesión
if (!isset($_SESSION['reset_email'])) {
    echo "Error: No email found. Please go back to the recovery page and try again.";
    exit;
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['reset_email'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar que la contraseña y la confirmación coincidan
    if ($new_password !== $confirm_password) {
        $error_message = "Error: The password and confirmation password do not match.";
    } else {
        // Verificar que la contraseña cumple con los requisitos
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/', $new_password)) {
            $error_message = "Error: The password must be at least 8 characters long, contain at least one uppercase letter, and include at least one special character.";
        } else {
            
            require_once 'procesar_cambio_contrasena.php';
            
            header("Location: procesar_cambio_contrasena.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Source Sans 3', sans-serif;
        }

        .container {
            text-align: center;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            font-family: 'Source Sans 3', sans-serif;
        }

        .container label,
        .container input,
        .container button {
            margin-bottom: 10px;
        }

        .container p {
            color: red;
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Change Password</h2>

    <?php if (!empty($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php elseif (!empty($success_message)): ?>
        <p class="success-message"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="email">Email:</label><br>
        <input type="text" name="reset_email" id="email" value="<?php echo isset($_SESSION['reset_email']) ? $_SESSION['reset_email'] : ''; ?>" readonly><br><p>
        <label for="password">New Password:</label><br>
        <input type="password" name="password" id="password" required><br><p>
        <!-- confirmar contraseña-->
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" name="confirm_password" id="confirm_password" required><br><p>
        <button type="submit">Change Password</button>
    </form>
</div>
</body>
</html>
