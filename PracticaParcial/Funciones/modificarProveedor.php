<?php  
include_once "./Clases/proveedores.php";
include_once "./Funciones/agregarFoto.php";

$id = isset($_POST["id"])?$_POST["id"]:null;
$nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
$email = isset($_POST["email"])?$_POST["email"]:null;
$foto = isset($_FILES["imagen"]);

if($id != null)
{
    $arrayProveedores = Proveedores::leerArchivo();

    foreach($arrayProveedores as $value)
    {
        if($value["id"] == $id)
        {
            if($nombre != null)
                $arrayProveedores[$value] = $nombre;
            if($email != null)
                $arrayProveedores[$value] = $email;
            if($foto == true)
                $arrayProveedores[$value] = guardarFoto($_FILE, null, $value["email"], $value["nombre"]);
            
            break;
        }
    }
    Proveedores::guardarArray($arrayProveedores);
}   
?>