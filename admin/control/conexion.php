<?php
    $ambienteLocal = false;

    if ($ambienteLocal == True){
        $servername = "127.0.0.1";
        $database = "bd_ruleta";
        $username = "root";
        $password = "";
    } else {
        $servername = "db4free.net";
        $database = "bd_ruleta";
        $username = "jalex_bd";
        $password = "bd_ruleta_pass";
    }
    
    $conexion = mysqli_connect($servername, $username, $password, $database);

    if ($conexion->connect_errno){
        die("Falló la conexión: " . $conexion->connect_error);
    }
    
    //mysqli_close($conexion);
?>
