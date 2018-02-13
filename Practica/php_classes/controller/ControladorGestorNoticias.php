<?php
include('Controlador.php');
include ('php_classes/view/VistaGestorNoticias.php');
include ('php_classes/view/VistaGestorNoticiasLista.php');
include ('php_classes/view/VistaEdicionNoticia.php');

/* Clase encargada de recuperar  noticias para la posterior
visualización/manipulación de las mismas*/
class ControladorGestorNoticias extends Controlador {
	
	private $vista_gestor_noticias;
	private $vista_gestor_noticias_lista;
	
	public function __construct($tiene_publicidad = false, $tiene_menu = true){
		parent::__construct($tiene_publicidad, $tiene_menu);
		$this->usuarioBD = $this->datos['redactor_jefe']['user'];
		$this->pass = $this->datos['redactor_jefe']['password'];
	}
	
	public function mostrarPagina(){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$secciones = $this->obtenerSecciones();
		$this->contenedor->cerrarConexion();
		
		$this->vista_gestor_noticias = new VistaGestorNoticias($secciones);
		$this->vista_gestor_noticias->mostrarPagina();
	}
	
	public function insertarNoticia($autor, $titular, $subtitulo, $id_seccion, $id_subseccion, $entradilla, $cuerpo, $video, $urls_imagenes, $pies_imagenes){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorNoticias->insertarNoticia($autor, $titular, $subtitulo, $id_seccion, $id_subseccion, $entradilla, $cuerpo, $video, $urls_imagenes, $pies_imagenes);
		$this->contenedor->cerrarConexion();
	}
	
	public function mostrarListadoNoticiasSeccion($id_seccion){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$secciones = $this->obtenerSecciones();
			$noticias = $this->contenedorNoticias->recuperarUltimasNoticiasPorSeccion($id_seccion);
		$this->contenedor->cerrarConexion();
		
		$this->vista_gestor_noticias_lista = new VistaGestorNoticiasLista($noticias, $secciones, 'seccion');
		$this->vista_gestor_noticias_lista->mostrarPagina();

	}
	
	public function mostrarListadoNoticiasSubseccion($id_subseccion){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$secciones = $this->obtenerSecciones();
			$noticias = $this->contenedorNoticias->recuperarUltimasNoticiasPorSubseccion($id_subseccion);
		$this->contenedor->cerrarConexion();
		
		$this->vista_gestor_noticias_lista = new VistaGestorNoticiasLista($noticias, $secciones, 'subseccion');
		$this->vista_gestor_noticias_lista->mostrarPagina();
	}
	
	public function eliminarNoticias($ids_noticia){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorNoticias->eliminarNoticias($ids_noticia);
		$this->contenedor->cerrarConexion();
	}
	
	public function cambiarEstado($ids_noticia,$estado){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorNoticias->cambiarEstado($ids_noticia,$estado);
		$this->contenedor->cerrarConexion();
	}
	
	public function mostrarEdicionNoticia($id_noticia){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$secciones = $this->obtenerSecciones();
			$noticia = $this->contenedorNoticias->recuperarNoticia($id_noticia);
		$this->contenedor->cerrarConexion();
		
		$this->vista_edicion_noticia = new VistaEdicionNoticia($noticia, $secciones);
		$this->vista_edicion_noticia->mostrarPagina();
	}
	
	public function modificarNoticia($id_noticia, $autor, $titular, $subtitulo, $id_seccion, 
		$id_subseccion, $entradilla, $cuerpo, $nuevo_video)
	{
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$this->contenedorNoticias->modificarNoticia($id_noticia, $autor, $titular, $subtitulo, $id_seccion, 
				$id_subseccion, $entradilla, $cuerpo, $nuevo_video);
		$this->contenedor->cerrarConexion();
	}
}
?>