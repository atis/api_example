<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    private static $order = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order' => (++self::$order*1000),
            'question_text' => 'Question '.self::$order,
            'question_type' => 'TEXT',
            'answer_text_rule' => '',
            'answer_int_min' => '0',
            'answer_int_max' => '4',
        ];
    }
}
