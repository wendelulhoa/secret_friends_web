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
        Schema::create('usersnotification', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->text('user_token')->comment('Guarda o token do usuário');
            $table->json('authorized_stores')->comment('Lojas permitidas, por padrão só cadastra a atual de acesso.');
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
        Schema::dropIfExists('usersnotification');
    }
};
