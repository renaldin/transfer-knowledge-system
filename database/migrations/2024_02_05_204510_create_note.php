<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note', function (Blueprint $table) {
            $table->id('id_note');
            $table->string('note_title', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->string('location', 255)->nullable();
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note');
    }
}
