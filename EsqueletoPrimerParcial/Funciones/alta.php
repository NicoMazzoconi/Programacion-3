<?php
include_once "./Clases/miClase.php";
include_once "./Funciones/agregarFoto.php";
include_once "./Funciones/agregarMarcaAgua.php";

if(isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["edad"]) && isset($_FILES["foto"]))
{
    $foto = guardarFoto($_FILES, $_POST, $_POST["nombre"], $_POST["edad"]);
    $miClase = new miClase();
    $miClase -> miConstructor($_POST["id"], $_POST["nombre"], $_POST["edad"], $foto);
    $miClase -> guardarArchivo("./Archivos/datos.txt");
}

?>