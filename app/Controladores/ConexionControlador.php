<?php
namespace App\Controladores;

use App\Controladores\Controlador;
use App\Modelos\Conexion;
use Phaza\LaravelPostgis\Geometries\Point;
use Carbon\Carbon;

class ConexionControlador extends Controlador
{
    public function get($request,$response){
        $todos = Conexion::all();
        return $response->withJson($todos);
    }

    public function post($request,$response){
		try{
            $input = $request->getParsedBody();
            $todo = new Conexion();
            $todo->con_ubicacion = new Point($input['latitud'],$input['longitud']);
            $todo->con_cantidad = $input['cantidad'];
            if(isset($input['uuid'])){
                $todo->con_uuid = $input['uuid'];
            }
            if(isset($input['fecha_sync'])){
                $todo->con_fecha_sync = Carbon::createFromFormat('d/m/Y H:i:s', $input['fecha_sync']);
            }
            $todo->con_fecha = Carbon::createFromFormat('d/m/Y H:i:s', $input['fecha']);
            $todo->save();
            
            return $response->withStatus(201)->withJson($todo);
		} catch (\Illuminate\Database\QueryException $e) {
            return $response->withStatus(403)->withJson(
                [
                'mensaje' => "Error en Base de Datos",
                'descripcion' => $e->errorInfo[2],
                ]
            );
		} catch (\Exception $e) {
            $text = $e->getMessage();
            echo $text;
            return $response->withStatus(501)->withJson(
                [
                'mensaje' => "Error en el Servidor",
                'descripcion' => iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text),
                ]
            );
		}
	}

}