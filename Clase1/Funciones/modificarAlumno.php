<?php 
include_once "./Clases/alumno.php";
/* Los datos de PUT vienen en el flujo de entrada estándar */
$datosPUT = fopen("php://input", "r");

/* Abrir un fichero para escritura */
$fp = fopen("mificheroput.ext", "w");

/* Leer 1 KB de datos cada vez
   y escribir en el fichero */
while ($datos = fread($datosPUT, 1024))
  fwrite($fp, $datos);

/* Cerrar los flujos */
fclose($fp);
fclose($datosPUT);
/*if(isset($_PUT["legajoMod"]))
{
	if(Alumno::buscarAlumnoLegajo($_GET["legajoMod"]))
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
}*/
?>