<?php

	$pagina_anterior = 'index.php';
	
	if(!isset($_SESSION)){
		session_start();
		$pagina_anterior = $_SESSION['pagina_anterior'];
		session_destroy();
	}
	
	header('Location: '.$pagina_anterior);
	exit();
?>