<?php

function guardarFoto($file, $post = null, $nombre = null, $edad = null)
{
	$dic = "./Fotos/";
	$dicBackup = "./FotosBackUp/";
    $nameImagen = $file["foto"]["name"];
    
	if(isset($post["edad"]) && isset($post["nombre"]))
	{
		$datoImagen = $post["edad"]."-".$post["nombre"];
	}	
	elseif($nombre != null && $edad != null)
	{
		$datoImagen = $edad."-".$nombre;
    }
    else{
        $datoImagen = "sinDatos";
    }
    
	$explode = explode(".", $nameImagen);
	$tamaño = count($explode);

	$dic .= $datoImagen;
	$dic .= ".";
	$dic .= $explode[$tamaño - 1];

	$hoy = date("m.d.y");
    $dicBackup .= $post["id"];
	$dicBackup .= "-".$hoy;
	$dicBackup .= ".";
	$dicBackup .= $explode[$tamaño - 1];

	if(!file_exists($dic))
	{
        
        // move_uploaded_file($_FILES["foto"]["tmp_name"], $dic);	
        agregarMarca($_FILES["foto"]["tmp_name"], $dic);	
	}
	else
	{
        copy($dic, $dicBackup);
        agregarMarca($_FILES["foto"]["tmp_name"], $dic);
		//move_uploaded_file($_FILES["foto"]["tmp_name"], $dic);
	}
    
    return $dic;
}


?>