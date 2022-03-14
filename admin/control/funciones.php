<?php

// Constantes para los intervalos del porcentaje de la apuesta
define("PORC_APUESTA_MIN", 8);
define("PORC_APUESTA_MAX", 15);

function establecerApuesta($dinero){
    if ($dinero > 1000){
        $apuesta = $dinero * rand(PORC_APUESTA_MIN,PORC_APUESTA_MAX)/100;
    } else {
        $apuesta = $dinero;
    }

    return $apuesta;
}

function escogerColor(){
    // Lista en donde se almacenarán tres listas con números aleatorios sin repetir de tamaño 2,49,49 respectivamente
    $porcColores = [[],[],[]];
    $numColor = rand(1, 100);
    $colorApostar = 'Ningún valor';
    $numRestantes = [];
    $numUsados = [];

    // Se llena la lista con todos los valores a usar del 1 al 100
    for ($i = 1; $i <= 100; $i++){
        array_push($numRestantes, $i);
    }

    // En los dos ciclos del for se llenaran las primeras dos listas de tamaño 2,49
    // La tercera lista se asignará directamente a los números restantes, que serán 49
    for ($i = 0; $i < (sizeof($porcColores))-1; $i++){
        if ($i == 0){
            $tam = 2;
        } else {
            $tam = 49;
        }

        // Se agregan los valores sin repetir a las primeras dos listas
        while (count($porcColores[$i]) < $tam){
            $numRandom = rand(1, 100);
            if (in_array($numRandom, $porcColores[0]) or in_array($numRandom, $porcColores[1])){
                continue;
            } else {
                array_push($porcColores[$i], $numRandom);
                array_push($numUsados, $numRandom);
            }
        }
    }

    // La tercera lista contiene los valores que no se usaron en las otras dos listas
    $porcColores[2] = array_diff($numRestantes, $numUsados);

    // Se determina el índice del color que contiene al valor generado aleatoriamente
    for ($i = 0; $i < sizeof($porcColores); $i++){
        if (in_array($numColor, $porcColores[$i])){
            $colorApostar = $i;
            break;
        }
    }

    // 1-> Verde    2-> Rojo    3-> Negro
    return $colorApostar+1;
}

?>