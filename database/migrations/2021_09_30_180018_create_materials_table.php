<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish2_ci';
            
            $table->id();
            $table->string('codigo', '10');
            $table->string('descripcion', '100');
            $table->foreignId('id_rubro')->constrained('material_rubros');
            $table->foreignId('id_dci')->constrained('material_dcis');
            $table->string('presentacion', '20');
            $table->enum('estado', ['activo', 'agotado', 'descontinuado'])->default('activo');
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
        Schema::dropIfExists('materials');
    }
}
