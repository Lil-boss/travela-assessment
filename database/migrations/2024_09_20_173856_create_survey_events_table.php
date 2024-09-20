<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surveyEvent', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surveyId');
            $table->unsignedBigInteger('questionId');
            $table->unsignedBigInteger('answerId');
            $table->timestamps();

            $table->foreign('surveyId')->references('id')->on('survey');
            $table->foreign('questionId')->references('id')->on('surveyQuestion');
            $table->foreign('answerId')->references('id')->on('surveyAnswer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_events');
    }
};
