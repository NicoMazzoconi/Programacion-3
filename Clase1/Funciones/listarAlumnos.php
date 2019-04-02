<?php 
include_once "/../Clases/alumno.php";
$listaAlumnos = new alumno();

$nombre;
$edad;
$dni;
$legajo;
if($listaAlumnos -> leerAlumno() != NULL)
{
	foreach ($listaAlumnos -> leerAlumno() as $value) {
		foreach ($value as $key => $valor) {
			switch($key)
			{
				case "nombre":
				$nombre = $valor;
				break;
				case "dni":
				$dni = $valor;
				break;
				case "legajo":
				$legajo = $valor;
				break;
				case "edad":
				$edad = $valor;
				break;
			}
		}
		echo "Nombre: ".$nombre.", DNI: ".$dni.", Legajo: ".$legajo.", Edad: ".$edad."<br>";
	}
}
 ?>