<?php
include('Controlador.php');
include('php_classes/view/VistaNoticiaImprimir.php');

/* Clase encargada de obtener una noticia del Modelo para crear
la Vista de la impresión de la noticia */
class ControladorNoticiaImprimir extends Controlador {
	
	private $vista_noticia_imprimir, $tiene_comentarios;
	
	public function __construct($tiene_publicidad = false, $tiene_menu = false, $tiene_comentarios = false){
		parent::__construct($tiene_publicidad, $tiene_menu, $tiene_comentarios);
		
		$this->tiene_comentarios = $tiene_comentarios;
	
	}
	
	public function mostrarNoticia($id_noticia){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$noticia = $this->obtenerNoticia($id_noticia, $this->tiene_comentarios);
		$this->contenedor->cerrarConexion();
		
		$this->vista_noticia_imprimir = new VistaNoticiaImprimir($noticia);
		$this->vista_noticia_imprimir->mostrarPagina();
	}
}
?>