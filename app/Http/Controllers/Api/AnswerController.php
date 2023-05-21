<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Models\Question;
use App\Models\QuestionAnswerInt;
use App\Models\QuestionAnswerText;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class AnswerController extends Controller {

    /**
     * Initializes survey response. 
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @param  int $survey Survey ID
     * @return Illuminate\Http\JsonResponse
     */
    public function putSurveyResponse(Request $request, int $survey): JsonResponse {
        $survey = Survey::find($survey);
        if (empty($survey)) {
            return response()->json([
                'code' => API_VALIDATIONERROR,
                'message' => 'Survey not found'
            ]);
        }
        $response = new SurveyResponse();
        $response->survey_id = $survey->id;
        $response->save();
        // TODO: add cookie middleware for caching access checks

        if ($response->id > 0) {
            return response()->json([
                'code' => API_SUCCESS,
                'message' => ANSWERUPDATEDMSG,
                'data' => $response->id,
            ]);
        } else {
            // error
            return response()->json([
                'code' => API_VALIDATIONERROR,
                'message' => ANSWERNOTUPDATEDMSG
            ]);
        }
    }


    /**
     * Saves Text format answer of survey question
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @param  int $survey Survey ID
     * @param  int $response Response ID
     * @param  int $queston Question ID
     * @param  int $id Optional - ID of current answer to edit
     * @return Illuminate\Http\JsonResponse
     */
    public function putText(Request $request, int $survey, int $response, int $question, int $id = 0): JsonResponse {
        /* Validate the question ids and value */
        $validator = Validator::make([
            'survey' => $survey, 
            'response' => $response, 
            'question' => $question, 
            'id' => $id,
            'value' => $request->value,
           ],[
            'survey' => 'required|numeric',
            'response' => 'required|numeric',
            'question' => 'required|numeric',
            'id' => 'required|numeric',
            'value' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => API_VALIDATIONERROR,
                'message' => $validator->errors()->get('*')
            ]);
        }

        $ret = QuestionAnswerText::where(['id'=>$id,'question_id'=>$question,'survey_response_id'=>$response])->upsert(
            ['question_id'=>$question,'survey_response_id'=>$response, 'value'=>$request->value],
            ['question_id', 'survey_response_id'], /* On duplicate key */
            ['value'] /* Update value */
        );

        return response()->json([
          'code' => API_SUCCESS,
          'message' => ANSWERUPDATEDMSG,
          'data' => $ret
        ]);
    }

    /**
     * Saves Int format answer of survey question
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @param  int $survey Survey ID
     * @param  int $response Response ID
     * @param  int $queston Question ID
     * @param  int $id Optional - ID of current answer to edit
     * @return Illuminate\Http\JsonResponse
     */
    public function putInt(Request $request, int $survey, int $response, int $question, int $id = 0): JsonResponse {
        /* Validate the question ids and value */
        $validator = Validator::make([
            'survey' => $survey,
            'response' => $response,
            'question' => $question,
            'id' => $id,
            'value' => $request->value,
           ],[
            'survey' => 'required|numeric',
            'response' => 'required|numeric',
            'question' => 'required|numeric',
            'id' => 'required|numeric',
            'value' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => API_VALIDATIONERROR,
                'message' => $validator->errors()->get('*')
            ]);
        }
        
        $ret = QuestionAnswerInt::where(['id'=>$id,'question_id'=>$question,'survey_response_id'=>$response])->upsert(
            ['question_id'=>$question,'survey_response_id'=>$response, 'value'=>$request->value],
            ['question_id', 'survey_response_id'], /* On duplicate key */
            ['value'] /* Update value */
        );
        
        return response()->json([
          'code' => API_SUCCESS,
          'message' => ANSWERUPDATEDMSG,
          'data' => $ret
        ]);
    }

}