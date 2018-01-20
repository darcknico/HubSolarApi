<?php
namespace App\Controladores;

use App\Controladores\Controlador;
use App\Modelos\Registro;
use Phaza\LaravelPostgis\Geometries\Point;
use Carbon\Carbon;

class RegistroControlador extends Controlador
{
    public function get($request,$response){
        $todos = Registro::all();
        return $response->withJson($todos);
    }

    public function post($request,$response){
		try{
            $input = $request->getParsedBody();
            $todo = new Registro();
            $todo->reg_ubicacion = new Point($input['latitud'],$input['longitud']);
            $todo->reg_humedad = $input['humedad'];
            $todo->reg_temperatura = $input['temperatura'];
            $todo->reg_indice_calor = $input['indice_calor'];
            $todo->reg_radiacion_solar = $input['radiacion_solar'];
            $todo->reg_voltaje = $input['voltaje'];
            $todo->reg_potencia = $input['potencia'];
            $todo->reg_intensidad_corriente = $input['intensidad_corriente'];
            $todo->reg_uuid = $input['uuid'];
            $todo->reg_fecha_sync = Carbon::createFromFormat('d/m/Y H:i:s', $input['fecha_sync']);
            $todo->reg_fecha = Carbon::createFromFormat('d/m/Y H:i:s', $input['fecha']);
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