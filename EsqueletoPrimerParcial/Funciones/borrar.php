<?php

include_once "./Clases/miClase.php";

if(isset($_POST["id"]))
{
    $arrayMiClase = miClase::leerArchivo("./Archivos/datos.txt");
    $i = 0;
    foreach($arrayMiClase as $value)
    {
        if($value["id"] == $_POST["id"])
        {
            unset($arrayMiClase[$i]);
        }
        $i++;
    }
    miClase::guardarArray($arrayMiClase, "./Archivos/datos.txt");
}


/*
$datosPUT = fopen("php://input", "r");

$datos = fread($datosPUT, 1024);

$arrayMiClase = miClase::leerArchivo("./Archivos/datos.txt");

$miClase = new miClase();
$miClase = json_decode($datos);

$i = 0;

foreach($arrayMiClase as $value)
{
    if($value["id"] == $miClase -> id)
    {
        unset($arrayMiClase[$i]);
    }
    $i++;
}

miClase::guardarArray($arrayMiClase, "./Archivos/datos.txt");
fclose($datosPUT);
*/

?>