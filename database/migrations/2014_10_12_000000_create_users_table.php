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
            $table->uuid('uuid')->unique();
            $table->string('username', '40')->unique();
            $table->string('descripcion', '100')->unique();
            $table->string('email', '100')->unique();
            $table->string('password');
            $table->enum('role', ['administrador', 'usuario'])->default('usuario');
            $table->boolean('enabled')->default(true);
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        DB::table('users')->insert(
            array('uuid' => Str::uuid()->toString(),
                'username' => 'admin',
                'descripcion' => 'Administrador Sistema',
                'email' => 'jadc.100890@gmail.com',
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
