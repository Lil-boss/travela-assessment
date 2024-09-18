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
        Schema::create('surveyAnswer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surveyQuestionId');
            $table->string('answer');
            $table->timestamps();

            $table->foreign('surveyQuestionId')->references('id')->on('surveyQuestion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveyAnswer');
    }
};
