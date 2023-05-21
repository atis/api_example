<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class QuestionChoice extends Model
{
    use HasFactory;

    /**
     * Get Question from QuestionChoice
     */
    public function question(): \Illuminate\Database\Eloquent\Relations\HasOne {
        return $this->hasOne(Question::class);
    }
}
