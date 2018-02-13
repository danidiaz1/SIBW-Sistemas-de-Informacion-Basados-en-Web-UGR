<?php

	include('php_classes/controller/ControladorLoginRegistro.php');
	include('php_utilities/testInput.php');
	include('php_utilities/sesion.php');
	
	abrirSesion();
		
	$controlador_login_registro = new ControladorLoginRegistro();

	$mensaje = '';
	$color = '';
	
	if (isset($_POST['login'])){
		$email = testInput($_POST['email']);
		$password = testInput($_POST['pass']);
		$hashedpass = hash('sha512',$password);
		
		$controlador_login_registro->identificarUsuario($email,$hashedpass);
	}
	else if (isset($_POST['registro'])) {
		$nickname = testInput($_POST['nombre']);
		$password = testInput($_POST['pass']);
		$hashedpass = hash('sha512',$password);
		$email = testInput($_POST['email']);
		
		$controlador_login_registro->registrarUsuario($email,$nickname,$hashedpass);
	}
	
	$controlador_login_registro->mostrarPagina();
	
	guardarPaginaAnterior();
?>