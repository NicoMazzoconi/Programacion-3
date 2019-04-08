<?php 
include_once "./Clases/alumno.php";

if(isset($_GET["legajoMod"]))
{
	$alumnoTest = new Alumno();
	if($alumnoTest -> buscarAlumnoLegajo($_GET["legajoMod"]))
	{
		echo "Existe";
	}
	else
	{
		echo "No existe";
	}
}
else
{
	echo "No entrado $_GET";
}
?>