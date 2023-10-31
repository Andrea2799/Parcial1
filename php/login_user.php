<?php 

    include 'modconn.php';

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $validar_login = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email' and pass = '$pass'");

    if(mysqli_num_rows($validar_login) > 0){
        header("location: ../index.html");
    }else{
        echo '
            <script>
                alert("The user does not exist, please register with us");
                window.location = "../loginmod.html";
            </script>
            ';
            exit();
    }

?>