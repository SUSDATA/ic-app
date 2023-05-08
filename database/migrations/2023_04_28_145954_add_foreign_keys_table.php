<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
		Schema::table('reclamaciones', function (Blueprint $table) {
			$table->foreignId('estado_id')->default(1) // estado foreign key
			->constrained('estado_reclamaciones'); 
			$table->foreignId('consultor_id')->default(1) // user foreign key
			->constrained('users');			
			$table->foreignId('resolutor_id')->default(1)  // user foreign key
			->constrained('users');
			$table->foreignId('motivo_id') // motivo foreign key
			->constrained('motivos');
			$table->foreignId('servicio_id')->default(1)  // servicio foreign key
			->constrained('servicios');
			$table->foreignId('red_id')->default(1)  //  red foreign key		
			->constrained('redes');
		});
		
		Schema::table('reclamacion_user', function (Blueprint $table) {            
            $table->foreignId('reclamacion_id')
			->constrained('reclamaciones');
            $table->foreignId('user_id')
			->constrained('users');			           			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
    }
};
