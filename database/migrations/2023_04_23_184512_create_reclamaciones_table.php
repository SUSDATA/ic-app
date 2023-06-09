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
        Schema::create('reclamaciones', function (Blueprint $table) {
            $table->id();
			$table->string('code',100)->unique();
			$table->string('segmento',100); // "Enum Model Attribute Casting" (Empresas Grandes, Empresas Estrategicas, Negocios) needs to be validated and required 
			$table->string('operacion',100); // "Enum Model Attribute Casting" (Fijo, Movil) needs to be validated and required 
			$table->timestamp('fecha')->nullable(); // fecha del requerimiento de la reclamacion
			$table->string('nit_rut',255)->nullable();
			$table->string('razon_social',100)->nullable();
			$table->decimal('valor_a_reclamar', 14, 2)->default(0.00)->nullable(); //Con 14 de precision, se pueden representar montos en billones de unidades
			$table->string('id_venta')->nullable();
			$table->string('ot')->nullable();
			$table->string('ruta_archivo_adjunto',1024)->nullable();
			$table->boolean('aplica_min')->nullable();
			$table->string('min', 20)->nullable();
			$table->string('tipo', 100)->nullable();
			$table->string('mes_reclamacion', 10)->nullable();
			$table->integer('anio_reclamacion')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamaciones');
    }
};
