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
        Schema::create('tbl_horario_atencion', function (Blueprint $table) {
            $table->id();
            $table->string("dias");
            $table->time("horaInicio");
            $table->time("horaCierre");
            $table->string("otrosDias");
            $table->time("horaInicioOtro");
            $table->time("horaCierreOtro");
            $table->string("estadoMediodia");
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
        Schema::dropIfExists('tbl_horario_atencion');
    }
};
