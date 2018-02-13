<?php

	include('php_classes/controller/ControladorClickPublicidad.php');
	include('php_utilities/sesion.php');
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$controlador_click_publicidad = new ControladorClickPublicidad();
	$id_publicidad = $_GET['id_publicidad'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$url = $_GET['url'];
	
	$controlador_click_publicidad->insertarClick($id_publicidad, $ip);
	
	header('Location: '.$url);
	die();
?>