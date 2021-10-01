<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_lineas', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish2_ci';

            $table->id();
            $table->foreignId('id_proveedor')->constrained('proveedors');
            $table->string('linea','30');

            $table->unique('id_proveedor', 'linea');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor_lineas');
    }
}
