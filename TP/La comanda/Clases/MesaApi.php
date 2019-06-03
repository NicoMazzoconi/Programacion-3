<?php
use \App\Models\Mesa as MesaORM;
require_once 'IApiUsable.php';

class MesaApi extends MesaORM implements IApiUsable
{
    public function TraerUno($request, $response, $args) {
        echo "hola";
        return "hola";
        /*
        $mesa = new \App\Models\Mesa();
        $id=$args['id'];
        $respuesta= $mesa->where('id', $id);
        if(!$respuesta)
        {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No encontrado";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        }
        else
        {
            $NuevaRespuesta = $response->withJson($respuesta, 200); 
        }     
       return $NuevaRespuesta;*/
    }

    public function TraerTodos($request, $response, $args) { 
       return $response;
    }

    public function CargarUno($request, $response, $args) {
         
       return $response;
    }

    public function BorrarUno($request, $response, $args) {
        
        return $response;
    }
    
    public function ModificarUno($request, $response, $args) {
        
        return $response;		
    }
}

?>