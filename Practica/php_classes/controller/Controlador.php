<?php
include ('php_classes/model/ModelContenedorNoticias.php');
include ('php_classes/model/ModelContenedorPublicidad.php');
include ('php_classes/model/ModelContenedorSecciones.php');
include ('php_classes/model/ModelContenedorPalabrasProhibidas.php');
include ('php_classes/model/ModelContenedorUsuarios.php');

// Superclase de los controladores. Se ocupa de instanciar los contenedores para que
// cada controlador específico recupere información de ellos y se lo envíe a sus vistas.
// Como algunas páginas no requieren de ciertos controladores (por ejemplo, hay páginas donde
// no se ven las secciones o no tienen publicidad), se permite en el constructor pasar
// booleanos para no instanciarlos.
// También se encarga de inicializar las variables para la conexión a la BD.
class Controlador {
	
	protected $contenedor;// Variable necesaria para poder crear un objeto "Contenedor"  para inicializar
						  // la variable estática de conexion a la BD, logrando conectarnos solo una vez 
						  // por petición HTTP
	protected $contenedorNoticias;
	protected $contenedorPublicidad;
	protected $contenedorSecciones;
	protected $contenedorUsuarios;
	protected $contenedorPalabrasProhibidas;
	protected $ficheroUserPass;
	protected $usuarioBD, $pass, $BD, $host;
	protected $tiene_menu, $tiene_publicidad;
	protected $datos;
	
	public function __construct($tiene_publicidad, $tiene_menu){
		$ficheroUserPass = '../../../userpass.ini';
		
		$this->datos = parse_ini_file($ficheroUserPass, true);
		$this->usuarioBD = $this->datos['usuario_comun_BD']['user'];
		$this->pass = $this->datos['usuario_comun_BD']['password'];
		$this->BD = 'daily_news';
		$this->host='localhost';
		$this->contenedor = new ModelContenedor();
		$this->tiene_publicidad = $tiene_publicidad;
		$this->tiene_menu = $tiene_menu;
		
		$this->contenedorNoticias = new ModelContenedorNoticias();
		$this->contenedorUsuarios = new ModelContenedorUsuarios();
		
		if ($tiene_publicidad)
			$this->contenedorPublicidad = new ModelContenedorPublicidad();
		
		if ($tiene_menu)
			$this->contenedorSecciones = new ModelContenedorSecciones();
		
	}
	
	
	// Métodos para recuperar información de los contenedores.
	protected function obtenerPublicidades($numero_publicidades = 50){
		return $this->contenedorPublicidad->recuperarPublicidades($numero_publicidades);
	}
	
	protected function obtenerSecciones(){
		return $this->contenedorSecciones->recuperarSecciones();
	}
	
	protected function obtenerNoticias($numero_noticias){
		return $this->contenedorNoticias->recuperarUltimasNoticias($numero_noticias);
	}
	
	protected function obtenerPalabrasProhibidas(){
		return $this->contenedorPalabrasProhibidas->recuperarPalabrasProhibidas();
	}
	
	protected function obtenerNoticia($id_noticia, $tiene_comentarios = false, $tiene_noticias_relacionadas = false){
		return $this->contenedorNoticias->recuperarNoticia($id_noticia, $tiene_comentarios, $tiene_noticias_relacionadas);
	}
	
	protected function obtenerPublicidad($id_publicidad, $con_clicks = false, $fecha = null, $hora = null){
		return $this->contenedorPublicidad->recuperarPublicidad($id_publicidad, $con_clicks, $fecha, $hora);
	}
	
	/*protected function obtenerComentarios($id_noticia){
		return $this->contenedorNoticias->obtenerComentarios($id_noticia);
	}*/
}

?>