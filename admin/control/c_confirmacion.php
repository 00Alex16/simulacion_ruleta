<?php
include('conexion.php');
$accion = mysqli_real_escape_string($conexion, $_POST['accion']);
$idJugador = mysqli_real_escape_string($conexion, $_POST['idJugador']);

if ($accion == 'eliminar') {
    $mensaje = "¿Esta seguro de eliminar al jugador #$idJugador?";

    echo "<script type='text/javascript'> if(confirm('$mensaje')){
				window.location.href='c_jugadores.php?accion=$accion&idJugador=$idJugador';
			}else{
				history.go(-1);
			}</script>";
}
