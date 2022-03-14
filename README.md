# Simulación ruleta

El proyecto se desarrolló con PHP, Bootstrap y MySQL. Se realizó para satisfacer los requisitos propuestos en la siguiente prueba de programación:

## Prueba de Programación

Se debe realizar una simulación, la cual consiste en un grupo dinámico de personas
jugando a la ruleta. El objetivo es crear un sistema para monitorear una mesa de casino.

### Competencias:
● Desarrollar una aplicación en php, .Net, Javascript o RoR.

● Deben existir vistas que permitan ingresar jugadores, a los cuales se les pueden
modificar sus datos, incluyendo cantidad de dinero que poseen, y se deben poder
eliminar del sistema (CRUD).

● Los jugadores parten con una cantidad de $10.000 por defecto.

● En cada ronda los jugadores apuestan entre un 8% y 15% del total de dinero que
poseen. Si tienen $1.000 o menos, van All In. Si no les queda dinero, no apuestan.

● El modo de apuesta es el siguiente, un jugador puede apostar a Verde, Rojo o Negro
con un 2%, 49% y 49% de probabilidad respectivamente.

● Un jugador recupera el doble de lo apostado si acierta su apuesta, cuando ésta sea
Rojo o Negro, y recupera 15 veces lo apostado en caso de acertar Verde. En caso
de perder la apuesta, no recupera nada.

● La ruleta entrega resultados con la misma probabilidad que los jugadores hacen
apuestas, es decir, Verde 2%, Rojo 49% y Negro 49%.

● Cada recarga de la página es una ronda de juego transcurrida, con la apuesta de
cada jugador y el resultado de la ruleta.

● La URL principal de la aplicación debe ser esta vista.

● El diseño no se evaluará.

● Cualquier otra funcionalidad no mencionada se considera en la evaluación, pero no
es obligatoria.

● Cualquier cosa no especificada queda a criterio del desarrollador.

## Consideraciones

● Las rondas de juego no transcurren con cada recarga de la página, sino que se tiene un botón para hacer las apuestas y otro para obtener los resultados de la ruleta.
