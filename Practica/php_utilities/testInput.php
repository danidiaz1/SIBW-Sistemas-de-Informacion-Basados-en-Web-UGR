<?php
	function testInput($datos) {
		$datos = trim($datos); // Elimina caracteres no necesarios (espacios extra, tabuladores, caracteres de nueva l�nea)
		$datos = stripslashes($datos); // Elimina el caracter "\", para evitar que se introduzcan p�ginas web
		$datos = htmlspecialchars($datos); // Cambia caracteres HTML por caracteres v�lidos (%lt; %gt; ,etc)
		return $datos;
	}
?>