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
        Schema::create('tbl_edu_distancia', function (Blueprint $table) {
            $table->id();
            $table->string('carrera',100);
            $table->string('facultad',50);
            $table->text('contenido')->nullable();
            $table->text('rutaBanner')->nullable();
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
        Schema::dropIfExists('tbl_edu_distancia');
    }
};
