<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

use Carbon\Carbon;
/**
 * @SWG\Definition(required={"menu", "contraseña","nombre"}, type="object", @SWG\Xml(name="Usuario"))
 */
class Registro extends Model {

    use PostgisTrait;
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'creado';
    
    public function setUpdatedAt($value){
      return NULL;
    }

    public function getCreadoAttribute(){
        $date = $this->attributes['creado'];
        return Carbon::createFromFormat('Y-m-d H:i:sO', $date)->format('d/m/Y H:i:s');
    }

    protected $table = 'tbl_registros';
    protected $primaryKey = 'reg_id';

    protected $maps = [
        'id' => 'reg_id',
        'temperatura' => 'reg_temperatura',
        'humedad' => 'reg_humedad',
        'indice_calor' => 'reg_indice_calor',
        'radiacion_solar' => 'reg_radiacion_solar',
        'intensidad_corriente' => 'reg_intensidad_corriente',
        'voltaje' => 'reg_voltaje',
        'potencia' => 'reg_potencia',
        'fecha' => 'reg_fecha',
        'latitud' => 'latitud',
        'longitud' => 'longitud',
    ];

    public function getLatitudAttribute(){
        return $this->attributes['reg_ubicacion']->getLat();
    }

    public function getLongitudAttribute(){
        return $this->attributes['reg_ubicacion']->getLng();
    }

    protected $appends  = [
        'id',
        'temperatura',
        'humedad',
        'indice_calor',
        'radiacion_solar',
        'intensidad_corriente',
        'voltaje',
        'potencia',
        'fecha',
        'latitud',
        'longitud',
    ];
    protected $hidden = [
        'reg_id',
        'reg_temperatura',
        'reg_humedad',
        'reg_indice_calor',
        'reg_radiacion_solar',
        'reg_intensidad_corriente',
        'reg_voltaje',
        'reg_potencia',
        'reg_fecha',
        'reg_uuid',
        'reg_fecha_sync',
        'reg_ubicacion',
    ];
	protected $fillable = [
		'reg_temperatura',
		'reg_humedad',
		'reg_indice_calor',
        'reg_radiacion_solar',
        'reg_intensidad_corriente',
		'reg_voltaje',
        'reg_potencia',
        'reg_fecha',
        'reg_uuid',
        'reg_fecha_sync',
    ];
    protected $postgisFields = [
        'reg_ubicacion',
    ];

    protected $dates = [
        'creado',
        'reg_fecha',
        'reg_fecha_sync',
    ];

    protected $dateFormat = 'Y-m-d H:i:sO';

    public function getIdAttribute($value){
        return $this->attributes['reg_id'];
    }

    public function getTemperaturaAttribute($value){
        return $this->attributes['reg_temperatura'];
    }

    public function getHumedadAttribute($value){
        return $this->attributes['reg_humedad'];
    }
    
    public function getIndiceCalorAttribute($value){
        return $this->attributes['reg_indice_calor'];
    }

    public function getRadiacionSolarAttribute($value){
        return $this->attributes['reg_radiacion_solar'];
    }

    public function getIntensidadCorrienteAttribute($value){
        return $this->attributes['reg_intensidad_corriente'];
    }

    public function getVoltajeAttribute($value){
        return $this->attributes['reg_voltaje'];
    }

    public function getPotenciaAttribute($value){
        return $this->attributes['reg_potencia'];
    }

    public function getFechaAttribute($value){
        $date = $this->attributes['reg_fecha'];
        return Carbon::createFromFormat('Y-m-d H:i:sO', $date)->format('d/m/Y H:i:s');
    }

}