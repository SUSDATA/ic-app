<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Red extends Model
{	
	use HasFactory, SoftDeletes;
	
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
	
	/**
	* The table associated with the model.
	*
	* @var string
	*/
    protected $table = 'redes';    
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'usuario_creacion',
		'usuario_modificacion'
    ];
}
