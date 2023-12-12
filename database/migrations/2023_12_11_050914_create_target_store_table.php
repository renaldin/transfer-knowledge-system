<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_store', function (Blueprint $table) {
            $table->id('id_target_store');
            $table->unsignedBigInteger('id_site');
            $table->unsignedBigInteger('id_user');
            $table->string('target_store_name', 255)->nullable();
            $table->string('target_store_owner', 255)->nullable();
            $table->string('target_store_mobile', 255)->nullable();
            $table->text('target_store_address')->nullable();
            $table->timestamp('reschedule_date')->nullable();
            $table->text('target_store_pict')->nullable();
            $table->text('description')->nullable();
            $table->enum('target_store_status', ['Toko Baru', 'Kunjungan Kembali', 'Tidak Potensial', 'Closing'])->nullable();
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
        Schema::dropIfExists('target_store');
    }
}
