<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id('id_store');
            $table->unsignedBigInteger('id_site');
            $table->unsignedBigInteger('id_user');
            $table->string('store_code', 255)->nullable();
            $table->string('store_name', 255)->nullable();
            $table->string('owner_name', 255)->nullable();
            $table->string('store_mobile_phone', 255)->nullable();
            $table->text('store_address')->nullable();
            $table->text('link_gmaps')->nullable();
            $table->string('store_pict', 255)->nullable();
            $table->string('ktp_pict', 255)->nullable();
            $table->string('form_pict', 255)->nullable();
            $table->integer('store_status')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('id_site')->references('id_site')->on('site');
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
        Schema::dropIfExists('store');
    }
}
