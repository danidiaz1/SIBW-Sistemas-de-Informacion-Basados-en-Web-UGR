<?php
include('Controlador.php');

/* Clase encargada de recuperar  publicidades para la posterior
visualización/manipulación de las mismas*/
class ControladorClickPublicidad extends Controlador {
	
	public function __construct($tiene_publicidad = true, $tiene_menu = true){
		parent::__construct($tiene_publicidad, $tiene_menu);
	}
	
	public function insertarClick($id_publicidad, $ip){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorPublicidad->insertarClick($id_publicidad, $ip);
		$this->contenedor->cerrarConexion();
	}
}
?>