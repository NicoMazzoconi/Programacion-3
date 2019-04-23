<?php

class Proveedores
{
    public $id;
    public $nombre;
    public $email;
    public $foto;

    public function __construct($nombre = null, $email = null, $foto = null, $id = null)
    {
        $this -> nombre = $nombre;
        $this -> email = $email;
        $this -> foto = $foto;
        $this -> id = $id;
    } 

    public function retornarJSon()
    {
        return json_encode($this);
    }

    public function guardarArchivo()
    {
        $archivo = "./Archivos/proveedores.txt";
        $actual = $this -> retornarJSon();
        
        if(file_exists($archivo))
		{
			$archivo = fopen("./Archivos/proveedores.txt", "a");		 
		}else
		{
			$archivo = fopen("./Archivos/proveedores.txt", "w");	 
        }
        
        $renglon = $actual.="\r\n";
        
		fwrite($archivo, $renglon); 		 
		fclose($archivo);
    }

    public static function leerArchivo()
    {
        $archivo = "./Archivos/proveedores.txt";
		if(file_exists($archivo))
		{
			$gestor = @fopen($archivo, "r");
			$arrayProveedores = array();
			$i = 0;
			while (($bufer = fgets($gestor, 4096)) !== false)
        	{
        		$arrayProveedores[$i] = json_decode($bufer, true);
        		$i++;
           	}
           	
           	if (!feof($gestor)) 
    		{
       	 		echo "Error: fallo inesperado de fgets()\n";
            }		
            	
    		fclose($gestor);
    		return $arrayProveedores;
		}   	
    }

    public static function guardarArray($array)
    {
        $archivo=fopen("./Archivos/proveedores.txt", "w"); 	
		foreach ($array as $value) 
		{
            $dato= json_encode($value);
	 		$dato.="\r\n";
			fwrite($archivo, $dato);
		}
		fclose($archivo);
    }
}

?>