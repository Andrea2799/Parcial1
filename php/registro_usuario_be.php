<?php

    include 'modconn.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $query  =   "INSERT INTO usuarios(name, email, user, pass) 
                VALUES('$name', '$email', '$user' ,'$pass')"; 
    
//Verificar que el correo no se repita en la base de datos
    $verificar_email = mysqli_query($conn, "SELECT * FROM usuarios WHERE email='$email'");
    if(mysqli_num_rows($verificar_email) > 0){
        echo '
            <script>
               alert("This email it is already in use");
                window.location="../loginmod.html";
            </script>
        ';
        exit();
    }
    //Verificar que el nombre de usuario no se repita en la base de datos
    $verificar_user = mysqli_query($conn, "SELECT * FROM usuarios WHERE user='$user'");
    if(mysqli_num_rows($verificar_user) > 0){
        echo '
            <script>
                alert("This username it is already token");
                window.location="../loginmod.html";
            </script>
        ';
        exit();
    }

    //Verificar que no sea vacio
    if(empty($user) || empty($name) || empty($email) || empty($pass)){

     

        echo '
            <script>
                alert("Please, fill the required data");
                window.location="../loginmod.html";
            </script>
        ';
        exit();
    }

    $ejecutar = mysqli_query($conn, $query);

    if($ejecutar){
        echo '
            <script>
                alert("User has been sucefully sign up");
                window.location="../loginmod.html";
            </script>
        ';
    }else{
        echo '
        <script>
            alert("Try again.");
            window.location="../loginmod.html";
        </script>
    ';
    }
mysqli_close($conn);
?>