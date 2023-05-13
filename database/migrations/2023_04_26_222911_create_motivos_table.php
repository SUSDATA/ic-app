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
        Schema::create('motivos', function (Blueprint $table) {
            $table->id();
			$table->string('nombre',100)->unique(); 
            $table->string('nombre_a_mostrar',100);
			$table->string('descripcion',400)->nullable();
			$table->string('usuario_creacion', 80)->nullable();
            $table->string('usuario_modificacion', 80)->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motivos');
    }
};
