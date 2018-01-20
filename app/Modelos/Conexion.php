<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

use Carbon\Carbon;
/**
 * @SWG\Definition(required={"menu", "contraseña","nombre"}, type="object", @SWG\Xml(name="Usuario"))
 */
class Conexion extends Model {

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

    protected $table = 'tbl_conexion';
    protected $primaryKey = 'con_id';

    public function getLatitudAttribute(){
        return $this->attributes['con_ubicacion']->getLat();
    }

    public function getLongitudAttribute(){
        return $this->attributes['con_ubicacion']->getLng();
    }

    protected $appends  = [
        'id',
        'cantidad',
        'fecha',
        'latitud',
        'longitud',
    ];
    protected $hidden = [
        'con_id',
        'con_cantidad',
        'con_ubicacion',
        'con_uuid',
        'con_fecha',
        'con_fecha_sync',
    ];
	protected $fillable = [
        'con_cantidad',
        'con_uuid',
        'con_fecha',
        'con_fecha_sync',
    ];
    protected $postgisFields = [
        'con_ubicacion',
    ];

    protected $dates = [
        'creado',
        'con_fecha',
        'con_fecha_sync',
    ];

    protected $dateFormat = 'Y-m-d H:i:sO';

    public function getIdAttribute($value){
        return $this->attributes['con_id'];
    }

    public function getCantidadAttribute($value){
        return $this->attributes['con_cantidad'];
    }

    public function getFechaAttribute($value){
        $date = $this->attributes['con_fecha'];
        return Carbon::createFromFormat('Y-m-d H:i:sO', $date)->format('d/m/Y H:i:s');
    }

}