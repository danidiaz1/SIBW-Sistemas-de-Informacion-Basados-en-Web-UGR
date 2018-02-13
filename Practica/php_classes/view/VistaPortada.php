<?php
include('VistaPagina.php');

/* Clase encarga de crear la Vista de la portada mediante el paso 
de un array de noticias noticias, anuncios y secciones (para el menú) al constructor.*/
class VistaPortada extends VistaPagina{
	
	private $noticias;
	protected $publicidades;
	
	public function __construct($noticias, $publicidades, $secciones){
		parent::__construct($publicidades, $secciones);
		$this->noticias = $noticias;
		$this->titulo = "Daily News";
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_portada.css">';
	}
	
	private function mostrarNoticia($id, $class){
		$noticia=$this->noticias[$id];
		echo '<article class="' . $class . '">
								<figure>
									<a href="'."noticia.php?id=$id".'" title="'.$noticia->getTitular().
									'"><img src="'.array_values($noticia->getImagenes())[0]->getUrl().
									'"></a>
								</figure>
								
								<h1>
									<a href="'."noticia.php?id=$id".'" title="'.$noticia->getTitular().
									'">'.$noticia->getTitular().
									'</a>
								</h1>
								<h2 class="autorFecha"><span class="autor">' .$noticia->getAutor(). 
								'</span> | <span class="fecha">'.date($this->formato_fecha, strtotime($noticia->getFechaPublicacion())).
								', '.$noticia->getHoraPublicacion().'</span></h2>
								
							</article>';
	}
	
	private function mostrarNoticiaPortada($id){
		$noticia=$this->noticias[$id];
		echo '<article id="principal">
							<figure>
								<a href="'."noticia.php?id=$id" . '" title="' . $noticia->getTitular() . '"><img src="' 
								.array_values($noticia->getImagenes())[0]->getUrl(). '" href="'."noticia.php?id=$id".'"></a>
							</figure>
							<h1>
								<a href="' . "noticia.php?id=$id" . '" title="' . $noticia->getTitular() . '">'
									.$noticia->getTitular().
								'</a>
							</h1>
							<p class="autorFecha"><span class="autor">'.$noticia->getAutor().
							'</span> | <span class="fecha">'.date($this->formato_fecha, strtotime($noticia->getFechaPublicacion())).
							', '.$noticia->getHoraPublicacion().'</span></p>
							<p class="entradilla">'.$noticia->getEntradilla().'<p>
						</article>';
	}
	
	private function mostrarNoticiaNoticiario2($id){
		$noticia=$this->noticias[$id];
		echo 	'<article>
					<figure>
						<a href="'."noticia.php?id=$id".'" title="'.$noticia->getTitular().'"><img src="'.array_values($noticia->getImagenes())[0]->getUrl().'" href="'."noticia.php?id=$id".'"></a>
					</figure>
					
					<h1>
						<a href="'."noticia.php?id=$id".'" title="'.$noticia->getTitular().'">'
							.$noticia->getTitular().
						'</a>
					</h1>
					<h2 class="autorFecha"><span class="autor">'.$noticia->getAutor().
					'</span> | <span class="fecha">'.date($this->formato_fecha, strtotime($noticia->getFechaPublicacion())).
					', '.$noticia->getHoraPublicacion().'</span></h2>
					
				</article>';
	}
	
	private function mostrarNoticiario2($id_noticia1, $id_noticia2, $id_noticia3, $id_noticia4, $id_noticia5){
		$noticia3 = $this->noticias[$id_noticia3];
		echo '<div class="noticiario2">
				<div class="columna1">
					<ul>
						<li>';
			
						$this->mostrarNoticiaNoticiario2($id_noticia1);
							
		echo			'</li>
						<li>';
						
						$this->mostrarNoticiaNoticiario2($id_noticia2);
						
		echo			'</li>
					</ul>
				</div>
				<div class="columna2">
					<ul>
						<li>
							<article>
								<figure>
									<a href="noticia.php?id='.$id_noticia3.'" title="'.$noticia3->getTitular().'"><img src="'.array_values($noticia3->getImagenes())[0]->getUrl().
									'" href="noticia.php?id='.$id_noticia3.'"></a>
								</figure>
								
								<h1>
									<a href="noticia.php?id='.$id_noticia3.'" title="'.$noticia3->getTitular().'">'
									.$noticia3->getTitular().
									'</a>
								</h1>
								<h2 class="autorFecha"><span class="autor">'.$noticia3->getAutor().
								'</span> | <span class="fecha">'.date($this->formato_fecha, strtotime($noticia3->getFechaPublicacion())).
								', '.$noticia3->getHoraPublicacion().'</span></h2>
								<p class="entradilla">'
								.$noticia3->getEntradilla().
								'</p>
							</article>
						</li>
					</ul>
				</div>
				
				<div class="columna3">
					<ul>
						<li>';
						
						$this->mostrarNoticiaNoticiario2($id_noticia4);
		
		echo			'</li>
						<li>';
						
						$this->mostrarNoticiaNoticiario2($id_noticia5);
						
		echo			'</li>
					</ul>
				</div>
			</div>';
	}
	
	protected function mostrarContenido(){
		
		echo '<div class="noticiario1">
				<div class="principales">
					<ul class="principales">
						<li>';
		
						$this->mostrarNoticiaPortada(1);
		
		echo			'</li>
						<li>';
						
						$this->mostrarNoticia(2,'principales');
							
		echo			'</li>
						<li>';
							
						$this->mostrarNoticia(3,'principales');
							
		echo			'</li>
					</ul>
				</div>';
		
	}
	
	protected function mostrarSideBar(){
		echo '<div class="secundarias">
					<ul class="secundarias">
						<li>';
						
						$this->mostrarNoticia(4,'secundario');
							
		echo			'</li>
						<li>';
						
						$this->mostrarNoticia(5,'secundario');
							
		echo			'</li>
						<li>';
						
						$this->mostrarNoticia(6,'secundario');
							
		echo			'</li>
					</ul>';
		
		$this->mostrarPublicidad(rand(1,count($this->publicidades)));
		
		echo '	</div>
			</div>';
			
		$this->mostrarNoticiario2(7,8,9,10,11);
	}
}
?>