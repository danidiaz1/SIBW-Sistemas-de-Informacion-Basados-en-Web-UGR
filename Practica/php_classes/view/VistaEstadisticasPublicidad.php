<?php
include('VistaPagina.php');

/* Clase encarga de crear la Vista de la página de las estadísticas
de un anuncio publicitario mediante el paso de una noticia al constructor.
Actualmente muestra una tabla con la información de los clicks (ip, fecha y hora)
y el número de clicks totales al anuncio.*/
class VistaEstadisticasPublicidad extends VistaPagina{
	
	private $publicidad;
	public function __construct($publicidad){
		parent::__construct();
		$this->publicidad = $publicidad;
		$this->titulo = 'Estadísticas de publicidad';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_estadisticas_publicidad.css">';
	}
	
	protected function mostrarContenido(){
		echo '<h1> Viendo estadísticas de la publicidad "'.$this->publicidad->getTitulo().'".</h1>';
		echo '<p>Clicks totales: '.count($this->publicidad->getClicks()).'</p>';
		$this->mostrarTablaClicks();
	}
	
	private function mostrarTablaClicks(){
		$clicks = $this->publicidad->getClicks();
		echo '<table>
				<caption>Información sobre los clicks</caption>
				<tbody>
					<tr>
						<th>Número</th>
						<th>IP</th>
						<th>Fecha</th> 
						<th>Hora</th>
					  </tr>';

		$contador_clicks = 1;
		foreach ($clicks as $click){
			echo '<tr>
					<td>'.$contador_clicks.'
					<td>'.$click->getIp().'</td>
					<td>'.$click->getFecha().'</td> 
					<td>'.$click->getHora().'</td>
				  </tr>';
			$contador_clicks++;
		}
		echo '</tbody>
		</table>';
	}
	
	protected function mostrarSideBar(){}
	
	public function mostrarPagina(){
		$this->mostrarInicioHTML();
		
		$this->mostrarContenido();
		
		$this->mostrarFinalHTML();
	}
}
?>