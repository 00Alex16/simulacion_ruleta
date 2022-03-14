<?php
include("conexion.php");

if (isset($_POST['accion'])) {
    $accion = mysqli_real_escape_string($conexion, $_POST['accion']);
} else {
    $accion = mysqli_real_escape_string($conexion, $_GET['accion']);
}

$idJugador = "";
$nombre = "";
$dinero = "";

if ($accion == 'crear') {
    $idJugador = mysqli_real_escape_string($conexion, $_POST['idJugador']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $sql = "INSERT INTO jugador (idJugador, nombre) VALUES ('$idJugador', '$nombre')";
    mysqli_query($conexion, $sql); //ejecuta la consulta
    $filas = mysqli_affected_rows($conexion); //devuelve el numero de filas afectadas en la ultima consulta
    if ($filas > 0) { //si la consulta se ejecuto correctamente
        echo "<script type='text/javascript'>alert('Jugador creado con exito');
				window.location.href='../jugadores.php';</script>"; //si se creo el jugador cargue de nuevo el formulario
    } else {
        echo "<script type='text/javascript'>alert('Error, no se creo el jugador');
				history.go(-1);</script>"; //si no se creo vuelve atras
    }
} elseif ($accion == 'editar') {
    $idJugador = mysqli_real_escape_string($conexion, $_POST['idJugador']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $dinero = mysqli_real_escape_string($conexion, $_POST['dinero']);
    $sql = "UPDATE jugador SET nombre='$nombre', dinero='$dinero' WHERE idJugador='$idJugador'";
    mysqli_query($conexion, $sql);
    $filas = mysqli_affected_rows($conexion); //devuelve el numero de filas afectadas en la ultima consulta
    if ($filas > 0) { //si la consulta se ejecuto correctamente
        echo "<script type='text/javascript'>alert('Jugador modificado con exito');
					window.location.href='../jugadores.php';</script>"; //si se creo el jugador cargue de nuevo el formulario
    } else {
        echo "<script type='text/javascript'>alert('Error, no se modifico el jugador');
					history.go(-1);</script>"; //si no se creo vuelve atras
    }
} elseif ($accion == 'eliminar') {
    $idJugador = mysqli_real_escape_string($conexion, $_GET['idJugador']);
    $sql = "DELETE FROM jugador WHERE idJugador='$idJugador'";
    $resultado = mysqli_query($conexion, $sql); //ejecutamos la consulta sql
    if ($resultado) { //si la consulta se ejecuto correctamente
        echo "<script type='text/javascript'>alert('Jugador eliminado con exito');
			window.location.href='../jugadores.php';</script>"; //si se creo el jugador cargue de nuevo el formulario
    } else {
        echo "<script type='text/javascript'>alert('Error, no se elimino el jugador');
			history.go(-2);</script>"; //si no se creo vuelve atras
    }
}
