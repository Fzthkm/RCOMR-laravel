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
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('workplace');
            $table->unsignedBigInteger('specialization_id')->nullable();
            $table->unsignedBigInteger('specialization_name')->nullable();
            $table->string('academic_degree')->nullable();
            $table->string('additional_info')->nullable();
            $table->timestamps();

            $table->index('specialization_id', 'specialist_specialization_idx');
            $table->foreign('specialization_id', 'specialist_specialization_idx')->on('specializations')->references('id');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialists');
    }
};
