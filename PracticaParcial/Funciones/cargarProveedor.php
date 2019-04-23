<?php
    echo "POST";

    include_once "./Clases/proveedores.php";
    include_once "./Funciones/agregarFoto.php";
  
    $dic = guardarFoto($_FILES, $_POST);

    $miClase = new Proveedores($_POST["nombre"], $_POST["email"], $dic, $_POST["id"]);

    $miClase -> guardarArchivo();
?>