<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\SurveyResponse;
use App\Models\QuestionAnswer;

class QuestionAnswerInt extends QuestionAnswer
{
    use HasFactory;
    public $timestamps = false;

}
