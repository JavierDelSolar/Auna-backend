<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', '30')->unique();
            $table->string('email', '100')->unique();
            $table->string('password');
            $table->enum('role', ['administrador', 'gerente', 'asistente', 'proveedor']);
            $table->boolean('enabled')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array('username' => 'admin',
                'email' => 'jdelsolar@auna.pe',
                'password' => Hash::make('Auna_2022'),
                'role' => 'administrador')
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
