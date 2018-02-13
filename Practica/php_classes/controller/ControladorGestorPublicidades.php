<?php
include('Controlador.php');
include ('php_classes/view/VistaGestorPublicidades.php');

/* Clase encargada de recuperar  publicidades para la posterior
visualización/manipulación de las mismas*/
class ControladorGestorPublicidades extends Controlador {
	
	public function __construct($tiene_publicidad = true, $tiene_menu = true){
		parent::__construct($tiene_publicidad, $tiene_menu);
		$this->usuarioBD = $this->datos['redactor_jefe']['user'];
		$this->pass = $this->datos['redactor_jefe']['password'];
	}
	
	public function mostrarPagina(){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$secciones = $this->obtenerSecciones();
			$publicidades = $this->obtenerPublicidades();
		$this->contenedor->cerrarConexion();
		
		$this->vista_gestor_publicidades = new VistaGestorPublicidades($publicidades, $secciones);
		$this->vista_gestor_publicidades->mostrarPagina();
	}

	public function eliminarPublicidades($ids_publicidades){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorPublicidad->eliminarPublicidades($ids_publicidades);
		$this->contenedor->cerrarConexion();
	}
	
	public function insertarPublicidad($imagen, $texto, $enlace, $titulo){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorPublicidad->insertarPublicidad($imagen, $texto, $enlace, $titulo);
		$this->contenedor->cerrarConexion();
	}
	
	public function modificarPublicidad($id_publicidad, $imagen, $texto, $enlace, $titulo){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorPublicidad->modificarPublicidad($id_publicidad, $imagen, $texto, $enlace, $titulo);
		$this->contenedor->cerrarConexion();
	}
}
?>