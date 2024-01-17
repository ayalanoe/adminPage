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
        Schema::create('tbl_calendarioadmincp', function (Blueprint $table) {
            $table->id();
            $table->text('actividad');
            $table->date('fechaInicio');
            $table->date('fechaFinal');
            $table->char('duracion', 50);
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
        Schema::dropIfExists('tbl_calendarioadmincp');
    }
};
