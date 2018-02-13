<?php
include('Controlador.php');
include('php_classes/view/VistaEstadisticasPublicidad.php');

/* Clase que se recupera información de los anuncios publicitarios del Modelo
y se lo envía a la vista correspondiente */
class ControladorEstadisticasPublicidad extends Controlador {
	
	private $vistaEstadisticasPublicidad, $fecha_clicks, $hora_clicks;
	
	public function __construct($fecha_clicks = null, $hora_clicks = null, $tiene_publicidad = true, $tiene_menu = false){
		parent::__construct($tiene_publicidad, $tiene_menu);
		
		$this->fecha_clicks = $fecha_clicks;
		$this->hora_clicks = $hora_clicks;
	}
	
	public function mostrarPagina($id_publicidad){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$publicidad = $this->obtenerPublicidad($id_publicidad, true, $this->fecha_clicks, $this->hora_clicks);
		$this->contenedor->cerrarConexion();
		
		$this->vistaEstadisticasPublicidad = new VistaEstadisticasPublicidad($publicidad);
		$this->vistaEstadisticasPublicidad->mostrarPagina();
	}
}
?>