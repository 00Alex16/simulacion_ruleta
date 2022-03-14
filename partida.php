<?php
include_once("cabecera.php");
include_once('admin/control/conexion.php');

$actualizar = "";
$ronda = 0;
if (isset($_GET['actualizar'])) {
    $actualizar=$_GET['actualizar'];
}
if (isset($_GET['ronda'])){
    $ronda = $_GET['ronda'];
}
?>

<body>
    <h1 class="text-center">Participantes | Ronda #<?php echo $ronda ?></h1><br>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="row gap-2 container-fluid mx-auto">
                <?php
                if ($actualizar == 'apuestas'){
                    $sql = "SELECT MAX(idRonda) FROM ronda";
                    $resultado = mysqli_query($conexion, $sql);
                    $idRonda = mysqli_fetch_array($resultado)[0];
                    $sql = "SELECT jugador.idJugador, jugador.nombre, jugador_ronda.apuesta, color_ruleta.color FROM jugador INNER JOIN jugador_ronda ON jugador.idJugador = jugador_ronda.idJugador INNER JOIN color_ruleta ON jugador_ronda.idColor = color_ruleta.idColor WHERE jugador_ronda.idRonda = $idRonda";
                } else {
                    $sql = "SELECT * FROM jugador WHERE dinero > 0 ORDER BY nombre";
                }
                
                $resultado = mysqli_query($conexion, $sql);
                while ($consulta = mysqli_fetch_array($resultado)) {
                ?>
                    <div class="btn-group" role="group" aria-label="Participantes">

                        <button type="button" class="btn btn-outline-dark btn-lg col-sm-8" data-bs-toggle="modal" data-bs-target="#<?php echo $consulta["nombre"] . $consulta["idJugador"]; ?>">
                            <?php echo $consulta["nombre"]; ?>
                        </button>
                    </div>

                    <?php
                    if ($actualizar == 'apuestas'){
                    ?>

                    <div class="modal fade" id="<?php echo $consulta["nombre"] . $consulta["idJugador"]; ?>" tabindex="-1" aria-labelledby="Participante" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Participante">Jugador # <?php echo $consulta["idJugador"]; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nombre:</strong> <?php echo $consulta["nombre"]; ?></p>
                                    <p><strong>Apuesta:</strong> $<?php echo $consulta["apuesta"]; ?></p>
                                    <p><strong>Color:</strong> <?php echo $consulta["color"]; ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
            
            <?php
            if ($actualizar == 'resultados') {
                $sql = "SELECT MAX(idRonda) FROM ronda";
                $resultado = mysqli_query($conexion, $sql);
                // Se le debe restar uno porque se carga la nueva ronda que empieza
                $idRonda = mysqli_fetch_array($resultado)[0] - 1;

                $sql = "SELECT idColorGanador FROM ronda WHERE idRonda = '$idRonda'";
                $resultado = mysqli_query($conexion, $sql);
                $idColorGanador = mysqli_fetch_array($resultado)[0];

                $sql = "SELECT color FROM color_ruleta WHERE idColor = '$idColorGanador'";
                $resultado = mysqli_query($conexion, $sql);
                $colorGanador = mysqli_fetch_array($resultado)[0];
            ?>

                <div class="modal fade" id="modalResultados" tabindex="-1" aria-labelledby="Resultados" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Resultado">El color ganador es: <?php echo $colorGanador; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Balance de los participantes</strong></p>
                                <?php
                                $sql = "SELECT * FROM jugador ORDER BY nombre";
                                $resultado = mysqli_query($conexion, $sql);
                                while ($consulta = mysqli_fetch_array($resultado)) {
                                ?>
                                <p><?php echo $consulta["nombre"]; ?>-> $<?php echo $consulta["dinero"]; ?></p>
                                <?php } ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    var modalRes = new bootstrap.Modal(document.getElementById("modalResultados"));
                    modalRes.show();
                </script>
                <?php } ?>
            <br/>
            <?php
            if ($actualizar == 'resultados' or $actualizar == ''){
            ?>
                <form action="admin/control/c_partida.php?ronda=<?php echo $ronda?>" method="POST">
                    <input type="hidden" name="accion" value="apuestasJugadores">
                    <div class="d-grid col-10 mx-auto">
                        <button type="submit" title="Apuestas" class="btn btn-primary">Hacer apuestas</button>
                    </div>
                </form>
            <?php } else { ?>
                <form action="admin/control/c_partida.php?ronda=<?php echo $ronda?>" method="POST">
                    <input type="hidden" name="accion" value="resultados">
                    <div class="d-grid col-10 mx-auto">
                        <button type="submit" title="Resultados" class="btn btn-secondary">Resultados de la ruleta</button>
                    </div>
                </form>
            <?php } ?>
            <br/>
            <hr/>
            <div class="d-grid col-10 mx-auto">
                <button onclick="location.href='index.php'" title="Terminar juego" class="btn btn-danger">Terminar juego</button>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</body>

</html>