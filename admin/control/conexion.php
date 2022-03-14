<?php
    $ambienteLocal = True;

    if ($ambienteLocal == True){
        $servername = "127.0.0.1";
        $database = "bd_ruleta";
        $username = "root";
        $password = "";
    } else {
        $servername = "localhost";
        $database = "simulacion_ruleta";
        $username = "root";
        $password = "";
    }
    
    $conexion = mysqli_connect($servername, $username, $password, $database);

    if ($conexion->connect_errno){
        die("Falló la conexión: " . $conexion->connect_error);
    }
    
    //mysqli_close($conexion);
?>