<?php
include('Controlador.php');
include('php_classes/view/VistaNoticia.php');

/* Clase encargada de extraer información del Modelo de las noticias para realizar operaciones con las mismas */
class ControladorNoticia extends Controlador {
	
	private $vista_noticia;
	private $tiene_comentarios;
	private $tiene_noticias_relacionadas;
	
	public function __construct($tiene_publicidad = true, $tiene_menu = true, $tiene_comentarios = true, $tiene_noticias_relacionadas = true){
		parent::__construct($tiene_publicidad, $tiene_menu);
		
		$this->tiene_comentarios = $tiene_comentarios;
		$this->tiene_noticias_relacionadas = $tiene_noticias_relacionadas;
		
		if ($tiene_comentarios)
			$this->contenedorPalabrasProhibidas = new ModelContenedorPalabrasProhibidas();
	}
	
	public function mostrarNoticia($id_noticia, $numero_publicidades = 3){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$noticia = $this->obtenerNoticia($id_noticia, $this->tiene_comentarios, $this->tiene_noticias_relacionadas);
			$publicidades = $this->obtenerPublicidades($numero_publicidades);
			$secciones = $this->obtenerSecciones();
			$palabras_prohibidas = $this->obtenerPalabrasProhibidas();
		$this->contenedor->cerrarConexion();
		
		$this->vista_noticia = new VistaNoticia($noticia, $publicidades, $palabras_prohibidas, $secciones);
		$this->vista_noticia->mostrarPagina();
	}
	
	public function insertarComentario($id_noticia, $nombre, $correo, $texto, $ip){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$exito = $this->contenedorNoticias->insertarComentario($id_noticia, $nombre, $correo, $texto, $ip);
		$this->contenedor->cerrarConexion();
		
		return $exito;
	}
}
?>