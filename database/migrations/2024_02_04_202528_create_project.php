<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->id('id_project');
            $table->unsignedBigInteger('id_user');
            $table->string('project_title', 255)->nullable();
            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('dp')->nullable();
            $table->string('project_type', 255)->nullable();
            $table->string('project_status', 255)->nullable();
            $table->string('document_status', 255)->nullable();
            $table->text('project_note')->nullable();
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
        Schema::dropIfExists('project');
    }
}
