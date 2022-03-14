<?php
include_once('cabecera.php');
?>

<body>
    <div class="row col-6 align-items-center mx-auto vh-100">
        <h1 class="text-center">Monitoreo de la mesa de casino</h1>
        <div class="d-grid gap-2 col-8 mx-auto">
            <button onclick="location.href='jugadores.php'" title="Jugadores" class="btn btn-dark">Jugadores</button>
            <form action="control/c_partida.php" method="POST">
                <input type="hidden" name="accion" value="iniciar">
                <div class="d-grid gap-2">
                    <button type="submit" title="Iniciar" class="btn btn-dark">Iniciar juego nuevo</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>