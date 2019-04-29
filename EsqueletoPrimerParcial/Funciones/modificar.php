<?php
include_once "./Clases/miClase.php";
include_once "./Funciones/agregarFoto.php";
include_once "./Funciones/agregarMarcaAgua.php";

if(isset($_POST["id"]))
{
    $id = isset($_POST["id"])?$_POST["id"]:null;
    $nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
    $edad = isset($_POST["edad"])?$_POST["edad"]:null;
    $foto = isset($_FILES["foto"])?true:null;


    $arrayMiClase = miClase::leerArchivo("./Archivos/datos.txt");
    $i = 0;
    foreach($arrayMiClase as $value)
    {
      
        if($value["id"] == $id)
        {
            if($nombre == null)
                $nombre = $value["nombre"];
            if($edad == null)
                $edad = $value["edad"];
            if($foto == true)
            {
                $foto = guardarFoto($_FILES, $_POST, $nombre, $edad);
            } 
            else
            {
                $foto = $value["foto"];
            }
            
            $newClass = new miClase();
            $newClass -> miConstructor($id, $nombre, $edad, $foto);
            $arrayMiClase[$i] = $newClass;
            break;
        }
        $i++;
    }
    miClase::guardarArray($arrayMiClase, "./Archivos/datos.txt");
}


?>