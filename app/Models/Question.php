<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Survey;

class Question extends Model
{
    use HasFactory;

    /**
     * Get Survey from Question
     */
    public function survey(): \Illuminate\Database\Eloquent\Relations\HasOne {
        return $this->hasOne(Survey::class);
    }

    /**
     * Get QuestionChoices from Question
     */
    public function question_choices(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(QuestionChoice::class);
    }

}
