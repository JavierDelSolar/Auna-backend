<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_contactos', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish2_ci';

            $table->id();
            $table->foreignId('id_proveedor')->constrained('proveedors');
            $table->string('nombre', '100');
            $table->string('correo', '50');
            $table->string('numero', '15');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor_contactos');
    }
}
