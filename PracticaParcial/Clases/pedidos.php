<?php
class Pedidos
{
    public $id;
    public $idProveedor;
    public $producto;
    public $cantidad;

    public function __construct($id = null, $idProveedor = null, $producto = null, $cantidad = null)
    {
        $this -> id = $id;
        $this -> idProveedor = $idProveedor;
        $this -> producto = $producto;
        $this -> cantidad = $cantidad;
    }

    public function retornarJSon()
    {
        return json_encode($this);
    }

    public function guardarArchivo()
    {
        $archivo = "./Archivos/pedidos.txt";
        $actual = $this -> retornarJSon();
        
        if(file_exists($archivo))
		{
			$archivo = fopen("./Archivos/pedidos.txt", "a");		 
		}else
		{
			$archivo = fopen("./Archivos/pedidos.txt", "w");	 
        }
        
        $renglon = $actual.="\r\n";
        
		fwrite($archivo, $renglon); 		 
		fclose($archivo);
    }

    public static function leerArchivo()
    {
        $archivo = "./Archivos/pedidos.txt";
		if(file_exists($archivo))
		{
			$gestor = @fopen($archivo, "r");
			$arrayPedidos = array();
			$i = 0;
			while (($bufer = fgets($gestor, 4096)) !== false)
        	{
        		$arrayPedidos[$i] = json_decode($bufer, true);
        		$i++;
           	}
           	
           	if (!feof($gestor)) 
    		{
       	 		echo "Error: fallo inesperado de fgets()\n";
            }		
            	
    		fclose($gestor);
    		return $arrayPedidos;
		}   	
    }
}
?>