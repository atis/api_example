<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Survey;
use App\Models\Question;
use App\Models\QuestionChoice;
use App\Models\QuestionAnswerInt;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller {

    /**
     * Question average (base 1)
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @param  int $survey optional Survey ID
     * @return Illuminate\Http\JsonResponse
     */
    public function getQuestionAverage(Request $request, int $survey = 0): JsonResponse {
        $condition = '1=1';
        if ($survey) {
            $condition = 'question_id IN ('.join(',',Survey::find($survey)->question_ids()).')';
        }

        $result = QuestionAnswerInt::select(DB::raw('question_id, ROUND(AVG(`value`),1)+1 AS average'))
            ->whereRaw($condition)->groupBy('question_id')->orderBy('question_id')->get(); 

        return response()->json([
          'code' => API_SUCCESS,
          'data' => $result,
        ]);
    }


    /**
     * Question answers count
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @param  int $survey optional Survey ID
     * @return Illuminate\Http\JsonResponse
     */
    public function getQuestionCount(Request $request, int $survey = 0): JsonResponse {
        $condition = '1=1';
        if ($survey) {
            $condition = 'question_id IN ('.join(',',Survey::find($survey)->question_ids()).')';
        }

        $result = QuestionAnswerInt::select(DB::raw('question_id, COUNT(*) AS count'))
            ->whereRaw($condition)->groupBy('question_id')->orderBy('question_id')->get(); 

        return response()->json([
          'code' => API_SUCCESS,
          'data' => $result,
        ]);
    }

    /**
     * Answers count per option
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @param  int $survey optional Survey ID
     * @return Illuminate\Http\JsonResponse
     */
    public function getOptionCount(Request $request, int $survey = 0): JsonResponse {
        // SELECT `value`, COUNT(*) FROM `question_answer_ints` GROUP BY `value`;
        $condition = '1=1';
        if ($survey) {
            $condition = 'question_id IN ('.join(',',Survey::find($survey)->question_ids()).')';
        }

        $choices = QuestionChoice::select('choice_value', 'choice_text')->whereRaw($condition)->groupBy('choice_value')->groupBy('choice_text')->orderBy('choice_value','DESC')->get();
        foreach ($choices as $c) {
            $result[$c['choice_value']] = ['text' => $c['choice_text'], 'value' => $c['choice_value']];
        }

        $options = QuestionAnswerInt::select(DB::raw('`value`, COUNT(*) AS count'))
            ->whereRaw($condition)->groupBy('value')->orderBy('value','DESC')->get(); 
        foreach ($options as $o) {
            $result[$o['value']]['count'] = $o['count'];
        }

        return response()->json([
          'code' => API_SUCCESS,
          'data' => $result,
        ]);
        
    }

}