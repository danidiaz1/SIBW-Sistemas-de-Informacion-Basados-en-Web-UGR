<?php
include('Controlador.php');
include('php_classes/view/VistaFacebookPost.php');

/* Controlador de la vista del post de Facebook de una noticia.
Recupera datos de una noticia del Modelo y se lo pasa a la Vista*/
class ControladorFacebookPost extends Controlador {
	
	private $vista_facebook_post, $tiene_comentarios;
	
	public function __construct($tiene_publicidad = false, $tiene_menu = false, $tiene_comentarios = false){
		parent::__construct($tiene_publicidad, $tiene_menu, $tiene_comentarios);
		$this->tiene_comentarios = $tiene_comentarios;
	}
	
	public function mostrarPagina($id_noticia){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$noticia = $this->obtenerNoticia($id_noticia);
		$this->contenedor->cerrarConexion();
		
		$this->vista_facebook_post = new VistaFacebookPost($noticia);
		$this->vista_facebook_post->mostrarPagina();
	}
}
?>