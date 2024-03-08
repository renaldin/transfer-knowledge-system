<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadreDevelopmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadre_developments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('senior_employee_id');
            $table->unsignedBigInteger('junior_employee_id');
            $table->unsignedBigInteger('admin_corporate_id');
            $table->unsignedBigInteger('manager_id');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('senior_employee_id')->references('id')->on('employees');
            $table->foreign('junior_employee_id')->references('id')->on('employees');
            $table->foreign('admin_corporate_id')->references('id')->on('employees');
            $table->foreign('manager_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadre_developments');
    }
}
