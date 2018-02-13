<?php
/* Clase que modela las secciones del menú del periódico*/
class ModelSubseccion {
	private $id_seccion;
	private $id_subseccion;
	private $nombre;
	
	public function __construct($id_seccion, $id_subseccion, $nombre)
	{
		$this->id_seccion = $id_seccion;
		$this->id_subseccion = $id_subseccion;
		$this->nombre = $nombre;
	}
	
	public function getIdSeccion(){
		return $this->id_seccion;
	}
	
	public function getId(){
		return $this->id_subseccion;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
}
?>