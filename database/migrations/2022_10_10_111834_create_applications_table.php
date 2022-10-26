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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->date('creating_date');
            $table->date('consult_date');
            $table->unsignedBigInteger('organisation_id');
            $table->string('patient_name');
            $table->integer('patient_year')->nullable();
            $table->string('diagnosis');
            $table->boolean('covid');
            $table->unsignedBigInteger('specialist_id');
            $table->unsignedBigInteger('specialization_id');
            $table->string('description')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->index('organisation_id', 'application_organisation_idx');
            $table->foreign('organisation_id', 'application_organisation_idx')->on('organisations')->references('id');
            $table->index('specialist_id', 'application_specialist_idx');
            $table->foreign('specialist_id', 'application_specialist_idx')->on('specialists')->references('id');

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
        Schema::dropIfExists('applications');
    }
};
