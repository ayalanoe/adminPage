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
        Schema::create('tbl_pensums', function (Blueprint $table) {
            $table->id();
            $table->string("carrera", 350);
            $table->string("codigoCarrera", 150);
            $table->string("tipoCarrera", 100);
            $table->text("departamento");
            $table->text("rutaArchivo");
            $table->boolean("estadoArchivo");
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
        Schema::dropIfExists('tbl_pensums');
    }
};
