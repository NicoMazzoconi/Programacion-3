<?php
namespace Clases;
require_once './src/app/models/Pedido.php';
require_once 'IApiUsable.php';

class PedidoApi extends PedidoORM implements IApiUsable
{
    public function TraerUno($request, $response, $args) {
        $pedido = new \App\Models\Pedido();
        $id=$args['id'];
        $respuesta= $pedido->where('id', '=', $id);
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
       return $NuevaRespuesta;
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