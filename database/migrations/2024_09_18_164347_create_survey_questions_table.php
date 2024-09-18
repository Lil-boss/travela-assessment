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
        Schema::create('surveyQuestion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surveyId');
            $table->string('question');
            $table->timestamps();

            $table->foreign('surveyId')->references('id')->on('survey')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveyQuestion');
    }
};
