<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorDistribuidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_distribuidors', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish2_ci';

            $table->id();
            $table->foreignId('id_proveedor')->constrained('proveedors');
            $table->foreignId('id_distribuidor')->constrained('proveedors');

            $table->unique('id_proveedor', 'id_distribuidor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor_distribuidors');
    }
}
