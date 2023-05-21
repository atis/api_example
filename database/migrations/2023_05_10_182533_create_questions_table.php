<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Survey;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            //$table->bigInteger('survey_id')->unsigned();
            $table->foreignIdFor(Survey::class);
            $table->integer('order')->unsigned();
            $table->char('question_type',6);
            $table->string('question_text');
            $table->integer('answer_int_min');
            $table->integer('answer_int_max');
            $table->string('answer_text_rule');
            $table->timestamps();
            $table->softDeletes();
            //$table->foreign('survey_id')->references('id')->on('survey');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
