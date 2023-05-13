<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motivo extends Model
{
	use HasFactory, SoftDeletes;
	
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
	
	/**
	* The table associated with the model.
	*
	* @var string
	*/
    protected $table = 'motivos';
	
	protected $fillable = [
        'nombre',
        'nombre_a_mostrar',
        'descripcion',
        'usuario_creacion',
        'usuario_modificacion'
    ];
}


