<?php
include('Controlador.php');
include ('php_classes/view/VistaPortada.php');

/* Clase encargada de recuperar un array de noticias y publicidades del Modelo para la portada y
de crear la Vista pasándole este array*/
class ControladorPortada extends Controlador {
	
	private $vista_portada, $numero_noticias;
	
	public function __construct($numero_noticias = 50, $numero_publicidades = 5, $tiene_publicidad = true, $tiene_menu = true){
		parent::__construct($tiene_publicidad, $tiene_menu);
		$this->numero_noticias = $numero_noticias;
		$this->numero_publicidades = $numero_publicidades;
		
	}
	
	public function mostrarPortada(){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$noticias = $this->obtenerNoticias($this->numero_noticias);
			$publicidades = $this->obtenerPublicidades($this->numero_publicidades);
			$secciones = $this->obtenerSecciones();
		$this->contenedor->cerrarConexion();
		
		$this->vista_portada = new VistaPortada($noticias, $publicidades, $secciones);
		$this->vista_portada->mostrarPagina();
	}
}
?>