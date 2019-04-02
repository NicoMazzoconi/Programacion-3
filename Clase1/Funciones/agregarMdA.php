<?php
function agregarMarcaDeAgua($ruta)
{
	$estampa = imagecreatefrompng("./Fotos/png/marca.png");
	$im = imagecreatefromjpg($ruta);

	$margen_dcho = 10;
	$margen_inf = 10;
	$sx = imagesx($estampa);
	$sy = imagesy($estampa);

	imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));

	header('Content-type: image/png');
	imagepng($im);
	imagedestroy($im);
}
?>
