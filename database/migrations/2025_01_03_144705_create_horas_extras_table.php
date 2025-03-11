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
        Schema::create('horas_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->string('dia')->nullable();
            $table->string('numeroHoras')->nullable();
            $table->string('inicioHora')->nullable();
            $table->string('finHora')->nullable();
            $table->string('proyecto')->nullable();
            $table->string('codigoEmpleado')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('firmaEmpleado')->nullable();
            $table->string('firmaAutorizado')->nullable();
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
        Schema::dropIfExists('horas_extras');
    }
};
