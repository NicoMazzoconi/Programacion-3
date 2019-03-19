<?php
include_once "persona.php";
class Alumno extends Persona
{
	public $legajo;

	public function __construct($nombre = NULL, $edad = NULL, $dni = NULL, $legajo = NULL)
	{
		parent::__construct($dni, $nombre, $edad);
		$this -> legajo = $legajo;
	}

	public function retornarJSon()
	{
		return json_encode($this);
	}
}
?>