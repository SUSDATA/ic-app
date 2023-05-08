<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reclamacion extends Model
{
	use HasFactory, SoftDeletes;
	
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
	
	/**
	* The table associated with the model.
	*
	* @var string
	*/
    protected $table = 'reclamaciones';
	
	protected $fillable = [
        'code',
        'segmento',
        'operacion',
        'fecha',
        'nit_rut',
        'razon_social',
        'valor_a_reclamar',
        'id_venta',
        'ot',
        'ruta_archivo_adjunto',
		'aplica_min',
		'min',
		'tipo',
		'mes_reclamacion',
		'anio_reclamacion',
		'estado_id',
		'consultor_id',
		'resolutor_id',
		'motivo_id',
		'servicio_id',
		'red_id'
    ];

	
	/**
	* Usuarios relacionados en una Reclamación.
	*/
    public function users()
    {
        return $this->belongsToMany('App\User','reclamaciones_user', 'reclamacion_id', 'user_id');
    }
	
}