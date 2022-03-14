<?php
include_once('cabecera.php');
include_once('control/conexion.php');

$idJugador = "";
$nombre = "";
$dinero = "";
$accion = "crear";

if (isset($_POST['idJugador'])) {
	$idJugador = mysqli_real_escape_string($conexion, $_POST['idJugador']);
	$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
	$dinero = mysqli_real_escape_string($conexion, $_POST['dinero']);
	$accion = mysqli_real_escape_string($conexion, $_POST['accion']);
}
?>

<body>
	<h1 class="text-center">Formulario Jugadores</h1><br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title text-center">Llene el formulario con los datos del jugador</h3>
				</div>

				<div class="card-body">

					<div class="register-box">
						<a href="jugadores.php">Ir atrás</a>
						<div class="card">
							<div class="card-body register-card-body">
								<p class="login-box-msg">
									<?php
									if ($accion == 'editar') {
										echo "Modificando jugador: " . $nombre;
									} else {
										echo "Crear nuevo jugador";
									}
									?>
								</p>

								<form action="control/c_jugadores.php" method="post" enctype="multipart/form-data">
									<div class="form-group has-feedback">
										<input type="text" class="form-control" placeholder="Id del jugador" name="idJugador" readonly required value="<?php echo $idJugador ?>">
										<span class="form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<input type="text" class="form-control" placeholder="Nombre" name="nombre" required value="<?php echo $nombre ?>">
										<span class="form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<input type="text" class="form-control" placeholder="Dinero: $10000" name="dinero" <?php if ($accion == 'crear') {echo 'readonly';} ?> required value="<?php echo $dinero ?>">
										<span class="form-control-feedback"></span>
									</div>

									<div class="d-grid gap-2 d-md-flex justify-content-md-end">
										<input type="hidden" name="accion" value="<?php if ($accion == 'crear') {echo 'crear';} else {echo 'editar';} ?>">
										<button type="submit" class="btn btn-primary btn-block btn-flat"> <?php if ($accion == 'crear') {echo 'Crear';} else {echo 'Modificar';} ?> </button>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<?php
					if ($accion == 'editar') {
						echo "Pulse Modificar para guardar los cambios";
					} else {
						echo "Pulse Crear para guardar el nuevo jugador";
					}
					?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>