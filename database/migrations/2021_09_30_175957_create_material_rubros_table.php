<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialRubrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_rubros', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish2_ci';
            
            $table->id();
            $table->string('rubro','50')->unique();
            $table->boolean('enabled')->default(true);
        });

        DB::table('material_rubros')->insert(array('rubro' => 'Farmacos No Oncologicos'));
        DB::table('material_rubros')->insert(array('rubro' => 'Farmacos Oncologicos'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_rubros');
    }
}
