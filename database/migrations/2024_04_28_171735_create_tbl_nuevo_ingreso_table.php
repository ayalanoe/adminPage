<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_nuevo_ingreso', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('tipoConsulta', 100); //Este campo es para poder agragar un identificador para poder filtrar los procesos de nuevo ingreso 
            $table->string('descripcion')->nullable();
            $table->text('contenido')->nullable();
            $table->date('fechaPublicacion')->nullable();
            $table->text('rutaArchivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_nuevo_ingreso');
    }
};
