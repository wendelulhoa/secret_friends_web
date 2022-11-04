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
        Schema::create('groupsfriends', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('observation')->nullable()->comment('Observações.');
            $table->bigInteger('user_id')->unsigned()->comment('Ligação com o user escolhido.');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('groupsfriends');
    }
};
