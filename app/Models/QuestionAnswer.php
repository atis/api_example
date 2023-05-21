<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\SurveyResponse;

abstract class QuestionAnswer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['question_id', 'survey_response_id', 'value'];

    /**
     * Get Question from QuestionAnswer
     */
    public function question(): \Illuminate\Database\Eloquent\Relations\HasOne {
        return $this->hasOne(Question::class);
    }

    /**
     * Get SurveyResponse from QuestionAnswer
     */
    public function survey_response(): \Illuminate\Database\Eloquent\Relations\HasOne {
        return $this->hasOne(SurveyResponse::class);
    }

}
