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
        Schema::create('personal', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaRecepcion')->nullable();
            $table->string('nombreEmpleado')->nullable();
            $table->string('codigoEmpleado')->nullable();
            $table->string('cargoEmpleado')->nullable();
            $table->string('proyectoEmpleado')->nullable();
            $table->string('accion')->nullable();
            $table->date('fechaefectivo')->nullable();
            $table->string('nombreUnidad')->nullable();
            $table->string('centroCosto')->nullable();
            $table->string('puestoActual')->nullable();
            $table->string('salarioActual')->nullable();
            $table->string('nombreUnidadPropuesto')->nullable();
            $table->string('centroCostoPropuesto')->nullable();
            $table->string('puestoPropuesto')->nullable();
            $table->string('nuevoSalario')->nullable();
            $table->date('fechaAumento')->nullable();
            $table->string('infoRequerida')->nullable();
            $table->string('firmaEmpleado')->nullable();
            $table->string('firmaJefe')->nullable();
            $table->string('firmaGerente')->nullable();
            $table->string('firmaDirector')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreignId('users_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal');
    }
};
