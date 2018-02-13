<?php
include('Controlador.php');
include ('php_classes/view/VistaGestorComentarios.php');

/* Clase encargada de recuperar noticias y sus comentarios para la posterior
visualización/manipulación de los mismos*/
class ControladorGestorComentarios extends Controlador {
	
	private $vista_gestor_comentarios, $numero_noticias;
	
	public function __construct($numero_noticias = 50, $tiene_publicidad = false, $tiene_menu = true){
		parent::__construct($tiene_publicidad, $tiene_menu);
		$this->usuarioBD = $this->datos['redactor_jefe']['user'];
		$this->pass = $this->datos['redactor_jefe']['password'];
		$this->numero_noticias = $numero_noticias;	
	}
	
	public function mostrarNoticias(){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$noticias = $this->obtenerNoticias($this->numero_noticias);
			$secciones = $this->obtenerSecciones();
		$this->contenedor->cerrarConexion();
		
		$this->vista_gestor_comentarios = new VistaGestorComentarios($secciones, $noticias, 'viendo_listado_noticias');
		$this->vista_gestor_comentarios->mostrarPagina();
	}
	
	public function mostrarComentarios($id_noticia){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$noticia = $this->obtenerNoticia($id_noticia, true);
			$secciones = $this->obtenerSecciones();
		$this->contenedor->cerrarConexion();
		
		$this->vista_gestor_comentarios = new VistaGestorComentarios($secciones, null, 'viendo_comentarios');
		$this->vista_gestor_comentarios->setNoticia($noticia);
		$this->vista_gestor_comentarios->mostrarPagina();
	}
	
	public function eliminarComentarios($ids_comentario){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorNoticias->eliminarComentarios($ids_comentario);
		$this->contenedor->cerrarConexion();
	}
	
	public function insertarComentario($id_noticia, $nombre, $correo, $texto, $ip, $fecha = '', $hora = ''){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorNoticias->insertarComentario($id_noticia, $nombre, $correo, $texto, $ip, $fecha, $hora);
		$this->contenedor->cerrarConexion();
	}
	
	public function modificarComentario($id_comentario, $nombre, $correo, $texto, $fecha, $hora){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorNoticias->modificarComentario($id_comentario, $nombre, $correo, $texto, $fecha, $hora);
		$this->contenedor->cerrarConexion();
	}
}
?>