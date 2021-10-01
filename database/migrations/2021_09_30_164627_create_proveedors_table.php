<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish2_ci';

            $table->id();
            $table->string('razon_social', '80')->unique();
            $table->string('ruc', '11')->unique();
            $table->string('direccion', '150');
            $table->string('representante_nombre', '150');
            $table->string('representante_dni', '15');
            $table->string('nro_partida', '20');
            $table->boolean('distribuidor');
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
        Schema::dropIfExists('proveedors');
    }
}
