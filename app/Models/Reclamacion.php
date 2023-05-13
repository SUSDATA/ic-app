<?php

namespace App\Models;

use App\Enums\ReclamacionSegmento;
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
		'consultor_id',		
		'motivo_id',
		'servicio_id',
		'red_id'
    ];

	
	protected $casts = [
		'segmento' => ReclamacionSegmento::class
	];

	/**
	* Usuarios relacionados en una Reclamación.
	*/
    public function users()
    {
        return $this->belongsToMany('App\User','reclamaciones_user', 'reclamacion_id', 'user_id');
    }
	
}