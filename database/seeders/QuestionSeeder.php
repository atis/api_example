<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Survey;


class QuestionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Question::factory()->count(9)
            ->create([
                'survey_id' => Survey::all()->random()->id,
                'question_type' => 'INT',
                'answer_int_min' => '0',
                'answer_int_max' => '4',
            ])->each(function ($question) {
                \App\Models\QuestionChoice::factory()->create(['question_id' => $question->id,'choice_value' => 0, 'choice_text' => 'Very often']);
                \App\Models\QuestionChoice::factory()->create(['question_id' => $question->id,'choice_value' => 1, 'choice_text' => 'Quite often']);
                \App\Models\QuestionChoice::factory()->create(['question_id' => $question->id,'choice_value' => 2, 'choice_text' => 'Sometimes']);
                \App\Models\QuestionChoice::factory()->create(['question_id' => $question->id,'choice_value' => 3, 'choice_text' => 'Rarely']);
                \App\Models\QuestionChoice::factory()->create(['question_id' => $question->id,'choice_value' => 4, 'choice_text' => 'Never']);
            });

        \App\Models\Question::factory()->create([
            'survey_id' => Survey::all()->random()->id,
            'question_type' => 'TEXT',
            'question_text' => 'Please name two things that you appreciate about your workplace',
        ]);
    }
}
