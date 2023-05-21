<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Question;
use App\Models\SurveyResponse;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('question_answer_texts', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->foreignIdFor(Question::class);
            $table->foreignIdFor(SurveyResponse::class);
            $table->string('value')->nullable();
            $table->unique(['question_id', 'survey_response_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_answer_texts');
    }
};
