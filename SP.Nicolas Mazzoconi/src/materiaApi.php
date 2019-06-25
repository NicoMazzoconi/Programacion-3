<?php
require_once "../src/app/models/materia.php";
require_once "../src/app/models/usuario.php";
require_once "../src/IApiUsable.php";
require_once "../src/AutentificadorJWT.php";
use App\Models;
use App\Models\materia;
use App\Models\usuario;

class materiaApi implements IApiUsable
{
    public function TraerUno($request, $response, $args)
    {

    }
    public function TraerTodos($request, $response, $args)
    {
        
       
    }
    public function CargarUno($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();

        $nombre= $ArrayDeParametros['nombre'];
        $cuatrimestre= $ArrayDeParametros['cuatrimestre'];
        $cupo = $ArrayDeParametros['cupo'];

        $miMateria = new materia();
        $miMateria->nombre=$nombre;
        $miMateria->cuatrimestre=$cuatrimestre;
        $miMateria->cupos=$cupo;
        $miMateria->save();
        
        $objDelaRespuesta->respuesta="Se cargo correctamente";   
        return $response->withJson($objDelaRespuesta, 200);
    }
    public function BorrarUno($request, $response, $args)
    {

    }
    public function ModificarUno($request, $response, $args)
    {

    }
}

?>