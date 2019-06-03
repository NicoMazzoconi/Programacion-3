<?php
namespace Clases;
require_once './src/app/models/Usuario.php';
require_once 'IApiUsable.php';

class UsuaruiApi extends UsuarioORM implements IApiUsable
{
    public function TraerUno($request, $response, $args) {
        $usuario = new \App\Models\Usuario();
        $id=$args['id'];
        $respuesta= $usuario->where('id', '=', $id);
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