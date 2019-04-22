<?php 
include_once "./Clases/alumno.php";
/* Los datos de PUT vienen en el flujo de entrada estándar */
$datosPUT = fopen("php://input", "r");

/* Leer 1 KB de datos cada vez */
$datos = fread($datosPUT, 1024);
$alumno = json_decode($datosPUT);
$legajo = $alumno -> legajo;
Alumno::BorrarAlumnoPorLegajo($legajo);

/* Cerrar los flujos */
fclose($datosPUT);
?>