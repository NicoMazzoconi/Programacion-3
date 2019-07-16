<?php
require_once "../src/app/models/pedido.php";
require_once "../src/app/models/usuario.php";
require_once "../src/AutentificadorJWT.php";
use App\Models;
use App\Models\pedido;
use App\Models\usuario;

class logs
{
    public static function leerArchivo($path)
    {
        $archivo = $path;
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
    public function OperacionesPorSector($request, $response, $args)
    {
        $arrayPedidos = logs::leerArchivo("../logs/logs.txt");
        $mozos = 0;
        $bartender​ = 0;
        $cerveceros​ = 0;
        $cocineros​ = 0;
        foreach($arrayPedidos as $value)
        {
            if(strcasecmp($value["Tipo"], "mozos") == 0)                
                $mozos++;
            if(strcasecmp($value["Tipo"], "bartender​") == 0)
                $bartender​++;
            if(strcasecmp($value["Tipo"], "cerveceros​") == 0)
                $cerveceros​++;
            if(strcasecmp($value["Tipo"], "cocineros​") == 0)
                $cocineros​++;  
            
        }
        $objRespuesta = new stdClass;
        $objRespuesta->Mozos = $mozos;
        $objRespuesta->Bartender​ = $bartender​;
        $objRespuesta->Cerveceros​ = $cerveceros​;
        $objRespuesta->Cocineros​ = $cocineros​;
        return $response->withJson($objRespuesta, 200);
    }

    public function Ingresos($request, $response, $args)
    {
        return $response->withJson(logs::leerArchivo("../logs/logins.txt"), 200);

    }

    public function OperacionesPorSectorListadas($request, $response, $args)
    {
        return $response->withJson(logs::leerArchivo("../logs/logs.txt"), 200);
    }

    public function OperacionesPorPersona($request, $response, $args)
    {
        
    }
}