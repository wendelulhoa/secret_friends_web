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
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('Ligação com o user.');
            $table->foreign('user_id')->references('id')->on('users');
            $table->json('categories')->comment('Categorias.');
            $table->json('links')->nullable()->comment('links.');
            $table->text('observation')->nullable()->comment('Observações.');
            $table->bigInteger('group_id')->unsigned()->comment('Ligação com o grupo de amigos.');
            $table->foreign('group_id')->references('id')->on('groupsfriends');
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
        Schema::dropIfExists('suggestions');
    }
};
