<?php
include("conexion.php");
include("funciones.php");

if (isset($_POST['accion'])) {
    $accion = mysqli_real_escape_string($conexion, $_POST['accion']);
}
if (isset($_GET['ronda'])){
    $ronda = $_GET['ronda'];
}

if ($accion == 'iniciar'){
    $sql = "INSERT INTO ronda () VALUES ()";
    mysqli_query($conexion, $sql); //ejecuta la consulta
    $filas = mysqli_affected_rows($conexion); //devuelve el numero de filas afectadas en la ultima consulta
    if ($filas > 0) { //si la consulta se ejecuto correctamente
        echo "<script type='text/javascript'>alert('Inicio de partida exitoso');
				window.location.href='../../partida.php?ronda=1';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error, no se puedo crear la partida');
				history.go(-1);</script>";
    }
} elseif ($accion == 'apuestasJugadores'){
    // Determinar la ronda actual
    $sql = "SELECT MAX(idRonda) FROM ronda";
    $resultado = mysqli_query($conexion, $sql);
    $idRonda = mysqli_fetch_array($resultado)[0];

    $sql = "SELECT * FROM jugador WHERE dinero > 0";
    $resultado = mysqli_query($conexion, $sql);
    while ($consulta = mysqli_fetch_array($resultado)) {
        $apuesta = establecerApuesta($consulta['dinero']);
        $colorApostar = escogerColor();
        $idJugador = $consulta['idJugador'];

        // Por cada participante en la ronda se crea una tabla de jugador_ronda
        $sql = "INSERT INTO jugador_ronda (idJugador, idRonda, idColor, apuesta) VALUES ('$idJugador', '$idRonda', '$colorApostar', '$apuesta')";
        mysqli_query($conexion, $sql); //ejecuta la consulta
    }

    $filas = mysqli_affected_rows($conexion); //devuelve el numero de filas afectadas en la ultima consulta
    if ($filas > 0) { //si la consulta se ejecuto correctamente
        echo "<script type='text/javascript'>alert('Apuestas realizadas con éxito');
				window.location.href='../../partida.php?ronda=$ronda&actualizar=apuestas';</script>";            // Se envia por GET 'actualizar'
    } else {
        echo "<script type='text/javascript'>alert('Error, no se pudieron realizar las apuestas');
				history.go(-1);</script>";
    }

} elseif ($accion == 'resultados'){
    // Determinar la ronda actual
    $sql = "SELECT MAX(idRonda) FROM ronda";
    $resultado = mysqli_query($conexion, $sql);
    $idRonda = mysqli_fetch_array($resultado)[0];
    $colorApostar = escogerColor();

    $sql = "UPDATE ronda SET idColorGanador = '$colorApostar' WHERE idRonda = '$idRonda'";
    mysqli_query($conexion, $sql); //ejecuta la consulta

    $sql = "SELECT jugador.idJugador, jugador.dinero, jugador_ronda.apuesta, jugador_ronda.idColor, ronda.idColorGanador, color_ruleta.multiplicador FROM jugador INNER JOIN jugador_ronda ON jugador.idJugador = jugador_ronda.idJugador INNER JOIN ronda ON ronda.idRonda = jugador_ronda.idRonda INNER JOIN color_ruleta ON color_ruleta.idColor = jugador_ronda.idColor WHERE jugador_ronda.idRonda = '$idRonda'";
    $resultado = mysqli_query($conexion, $sql);
    while ($consulta = mysqli_fetch_array($resultado)) {
        $idJugador = $consulta['idJugador'];
        $dinero = $consulta['dinero'];
        $apuesta = $consulta['apuesta'];
        $multiplicador = $consulta['multiplicador'];
        if ($consulta['idColor'] == $consulta['idColorGanador']){
            $sql = "UPDATE jugador SET dinero = ('$dinero' + ('$apuesta' * '$multiplicador')) WHERE idJugador = '$idJugador'";
            mysqli_query($conexion, $sql); //ejecuta la consulta
        }
        // Obtener cantidad de dinero actualizada
        $sql = "SELECT dinero FROM jugador WHERE idJugador=$idJugador";
        $res = mysqli_query($conexion, $sql);
        $dinero = mysqli_fetch_array($res)[0];
        // Se resta el dinero de la apuesta
        $sql = "UPDATE jugador SET dinero = '$dinero' - '$apuesta' WHERE idJugador = '$idJugador'";
        mysqli_query($conexion, $sql); //ejecuta la consulta
    }

    // Se crea una nueva ronda
    $sql = "INSERT INTO ronda () VALUES ()";
    mysqli_query($conexion, $sql); //ejecuta la consulta

    $filas = mysqli_affected_rows($conexion); //devuelve el numero de filas afectadas en la ultima consulta
    if ($filas > 0) { //si la consulta se ejecuto correctamente
        $ronda++;
        echo "<script type='text/javascript'>alert('Resultados generados con éxito');
				window.location.href='../../partida.php?ronda=$ronda&actualizar=resultados';</script>";             // Se envia por GET 'actualizar'
    } else {
        echo "<script type='text/javascript'>alert('Error, no se pudieron generar los resultados');
				history.go(-1);</script>";
    }
}
?>