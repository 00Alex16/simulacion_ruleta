<?php
include_once('cabecera.php');
include_once('control/conexion.php');
?>

<body>
    <h1 class="text-center">Jugadores</h1><br>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="row gap-3 container-fluid">

                <?php
                $sql = "SELECT * FROM jugador ORDER BY nombre";
                $resultado = mysqli_query($conexion, $sql);
                while ($consulta = mysqli_fetch_array($resultado)) {
                ?>

                    <div class="btn-group" role="group" aria-label="Lista Jugadores">
                        <!-- Botón para desplegar el modal -->
                        <button type="button" class="btn btn-outline-dark btn-lg col-sm-8" data-bs-toggle="modal" data-bs-target="#<?php echo $consulta["nombre"] . $consulta["idJugador"]; ?>">
                            <?php echo $consulta["nombre"]; ?>
                        </button>
                        <form action="crear_jugadores.php" method="POST">
                            <input type="hidden" name="idJugador" value="<?php echo $consulta["idJugador"]; ?>">
                            <input type="hidden" name="nombre" value="<?php echo $consulta["nombre"]; ?>">
                            <input type="hidden" name="dinero" value="<?php echo $consulta["dinero"]; ?>">
                            <input type="hidden" name="accion" value="editar">
                            <button type="submit" title="Editar" class="btn btn-outline-primary btn-lg"><img src="../imagenes/editar3.png" width="30vw"/></button>
                        </form>
                        <form action="control/c_confirmacion.php" method="POST">
                            <input type="hidden" name="accion" value="eliminar">
                            <button type="submit" title="Eliminar" name="idJugador" value="<?php echo $consulta['idJugador']; ?>" class="btn btn-outline-danger btn-lg"><img src="../imagenes/boton-eliminar.png" width="30vw"/></button>
                        </form>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo $consulta["nombre"] . $consulta["idJugador"]; ?>" tabindex="-1" aria-labelledby="Jugador" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Jugador">Jugador # <?php echo $consulta["idJugador"]; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nombre:</strong> <?php echo $consulta["nombre"]; ?></p>
                                    <p><strong>Dinero:</strong> $<?php echo $consulta["dinero"]; ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <button onclick="location.href='crear_jugadores.php'" title="Jugadores" class="btn btn-dark">Añadir jugador</button>
                <hr/>
                <button onclick="location.href='index.php'" title="Jugadores" class="btn btn-dark">Volver a la página de monitoreo</button>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</body>

</html>