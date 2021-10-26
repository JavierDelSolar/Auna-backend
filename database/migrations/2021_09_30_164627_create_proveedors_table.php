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
            $table->string('representante_nombre', '150')->nullable(true);
            $table->string('representante_dni', '15')->nullable(true);
            $table->string('nro_partida', '20')->nullable(true);
            $table->boolean('preferido')->default(false);
            $table->boolean('distribuidor')->default(false);
            $table->boolean('enabled')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
