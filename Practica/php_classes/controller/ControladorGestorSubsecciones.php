<?php
include('Controlador.php');
include ('php_classes/view/VistaGestorSubsecciones.php');

/* Clase encargada de recuperar subsecciones para la posterior
visualización/manipulación de las mismas*/
class ControladorGestorSubsecciones extends Controlador {
	
	private $vista_gestor_subsecciones, $id_seccion;
	
	public function __construct($id_seccion, $tiene_publicidad = false, $tiene_menu = true){
		parent::__construct($tiene_publicidad, $tiene_menu);
		$this->usuarioBD = $this->datos['redactor_jefe']['user'];
		$this->pass = $this->datos['redactor_jefe']['password'];
		$this->id_seccion = $id_seccion;
	}
	
	public function mostrarPagina(){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$secciones = $this->obtenerSecciones();
			$seccion = $this->contenedorSecciones->recuperarSeccion($this->id_seccion);
		$this->contenedor->cerrarConexion();
		
		$this->vista_gestor_subsecciones = new VistaGestorSubsecciones($seccion, $secciones);
		$this->vista_gestor_subsecciones->mostrarPagina();
	}

	public function eliminarSubsecciones($ids_subsecciones){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorSecciones->eliminarSubsecciones($ids_subsecciones);
		$this->contenedor->cerrarConexion();
	}
	
	public function insertarSubseccion($id_seccion, $nombre){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorSecciones->insertarSubseccion($id_seccion, $nombre);
		$this->contenedor->cerrarConexion();
	}
	
	public function modificarSubseccion($id_subseccion, $nombre){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorSecciones->modificarSubseccion($id_subseccion, $nombre);
		$this->contenedor->cerrarConexion();
	}
}
?>