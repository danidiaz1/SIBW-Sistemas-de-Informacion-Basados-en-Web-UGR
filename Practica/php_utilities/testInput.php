<?php
	function testInput($datos) {
		$datos = trim($datos); // Elimina caracteres no necesarios (espacios extra, tabuladores, caracteres de nueva línea)
		$datos = stripslashes($datos); // Elimina el caracter "\", para evitar que se introduzcan páginas web
		$datos = htmlspecialchars($datos); // Cambia caracteres HTML por caracteres válidos (%lt; %gt; ,etc)
		return $datos;
	}
?>