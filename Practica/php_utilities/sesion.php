<?php
function guardarPaginaAnterior(){
	if(isset($_SESSION['usuario']))
		$_SESSION['pagina_anterior']=$_SERVER['REQUEST_URI'];
		
}

function abrirSesion(){
	if(!isset($_SESSION['usuario']))
			session_start();
}
?>