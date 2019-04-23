<?php 
function guardarFoto($file, $post = null, $email = null, $nombre = null)
{
	$dic = "./Fotos/";
	$dicBackup = "./backUpFotos/";
	$nameImagen = $file["imagen"]["name"];
	if($post != null)
	{
		$datoImagen = $post["email"]."-".$post["nombre"];
	}	
	else
	{
		$datoImagen = $email."-".$nombre;
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
		move_uploaded_file($_FILES["imagen"]["tmp_name"], $dic);	
	}
	else
	{
		copy($dic, $dicBackup);
		move_uploaded_file($_FILES["imagen"]["tmp_name"], $dic);
	}
    
    return $dic;
}
 ?>