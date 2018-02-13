<?php
function fechaHoraToDateTime($fecha, $hora, $formato_fecha = 'd-m-Y', $formato_hora = 'H:i:s') {
	$fecha_hora = DateTime::createFromFormat($formato_fecha.' '.$formato_hora, $fecha.' '.$hora);
	return $fecha_hora;
}
?>