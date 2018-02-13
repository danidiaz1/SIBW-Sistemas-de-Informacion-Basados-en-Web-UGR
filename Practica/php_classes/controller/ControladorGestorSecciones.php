<?php
include('Controlador.php');
include ('php_classes/view/VistaGestorSecciones.php');

/* Clase encargada de recuperar  secciones para la posterior
visualización/manipulación de las mismas*/
class ControladorGestorSecciones extends Controlador {
	
	private $vista_gestor_secciones;
	
	public function __construct($tiene_publicidad = false, $tiene_menu = true){
		parent::__construct($tiene_publicidad, $tiene_menu);
		$this->usuarioBD = $this->datos['redactor_jefe']['user'];
		$this->pass = $this->datos['redactor_jefe']['password'];
	}
	
	public function mostrarPagina(){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$secciones = $this->obtenerSecciones();
		$this->contenedor->cerrarConexion();
		
		$this->vista_gestor_secciones = new VistaGestorSecciones($secciones);
		$this->vista_gestor_secciones->mostrarPagina();
	}

	public function eliminarSecciones($ids_secciones){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorSecciones->eliminarSecciones($ids_secciones);
		$this->contenedor->cerrarConexion();
	}
	
	public function insertarSeccion($nombre){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorSecciones->insertarSeccion($nombre);
		$this->contenedor->cerrarConexion();
	}
	
	public function modificarSeccion($id_seccion, $nombre){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorSecciones->modificarSeccion($id_seccion, $nombre);
		$this->contenedor->cerrarConexion();
	}
}
?>