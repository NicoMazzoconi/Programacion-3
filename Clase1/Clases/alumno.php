<?php
include_once "/../Clases/persona.php";
class Alumno extends Persona
{
	public $legajo;
	public $imagen;

	public function __construct($nombre = NULL, $edad = NULL, $dni = NULL, $legajo = NULL, $imagen = NULL)
	{
		parent::__construct($dni, $nombre, $edad);
		$this -> legajo = $legajo;
		$this -> imagen = $imagen;
	}

	public function retornarJSon()
	{
		return json_encode($this);
	}

	public function guardarAlumno()
	{
		$fichero = "./Archivos/alumnos.txt";
		$actual = $this -> retornarJSon();
		if(file_exists($fichero))
		{
			file_put_contents($fichero, $actual.="\r\n", FILE_APPEND);
		}
		else
		{
			file_put_contents($fichero, $actual.="\r\n");
		}
	}

	public function leerAlumno()
	{
		$fichero = "./Archivos/alumnos.txt";
		if(file_exists($fichero))
		{
			$gestor = @fopen($fichero, "r");
			$arrayAlumnos = array();
			$i = 0;
			while (($bufer = fgets($gestor, 4096)) !== false)
        	{
        		$arrayAlumnos[$i] = json_decode($bufer, true);
        		$i++;
           	}
           	return $arrayAlumnos;
           	if (!feof($gestor)) 
    		{
       	 		echo "Error: fallo inesperado de fgets()\n";
    		}			
    		fclose($gestor);
		}   	
	}
}
?>