<?php
/* Clase que modela la información de los clicks que se hacen en los anuncios publicitarios*/
class ModelClickPublicidad {
	private $id_click;
	private $id_publicidad;
	private $fecha;
	private $hora;
	private $ip;
	
	public function __construct($id_click, $id_publicidad, $fecha, $hora, $ip)
	{
		$this->id_click = $id_click;
		$this->id_publicidad = $id_publicidad;
		$this->fecha = $fecha;
		$this->hora = $hora;
		$this->ip = $ip;
	}
	
	public function getId(){
		return $this->id_click;
	}
	
	public function getIdPublicidad(){
		return $this->id_publicidad;
	}
	
	public function getFecha(){
		return $this->fecha;
	}
	
	public function getHora(){
		return $this->hora;
	}
	public function getIp(){
		return $this->ip;
	}
}
?>