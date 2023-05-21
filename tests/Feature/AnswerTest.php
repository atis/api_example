<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SurveyResponse;
use App\Models\QuestionAnswerInt;
use App\Models\QuestionAnswerText;
use Illuminate\Testing\Fluent\AssertableJson;

class AnswerTest extends TestCase
{
    use WithFaker;
    var $survey_id = 1;
    var $response_id = 0;
    
    public function setUp():void {
        parent::setUp();
        $response = new SurveyResponse();
        if (!$this->response_id) {
            $response->survey_id = $this->survey_id;
            $response->save();
            $this->response_id = $response->id;
        }
    }

    public function tearDown():void {
        if ($this->response_id) {
            //QuestionAnswerInt::where('survey_response_id', $this->response_id)->delete();
            QuestionAnswerText::where('survey_response_id', $this->response_id)->delete();
        }
        parent::tearDown();
    }

    /**
     * Test storing string answer
     */
    public function test_survey_answer_10_text(): void
    {
        $question_id = 10;
        $value = $this->faker->realText($maxNbChars = 200, $indexSize = 2);
        $response = $this->putJson('/api/survey/'.$this->survey_id.'/response/'.$this->response_id.'/question/'.$question_id.'/text/',['value'=>$value]);
        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('code','200')
                ->whereType('data','integer')
                ->has('message')
                ->etc()
        );
        
        $qa = QuestionAnswerText::where('survey_response_id', $this->response_id)->where('question_id', $question_id)->get();
        $this->assertEquals($value, $qa->value('value'));
    }

    /**
     * Test changing text answer
     */
    public function test_survey_answer_10_edit_text(): void
    {
        $value = $this->faker->realText($maxNbChars = 50, $indexSize = 2);
        $question_id = 10;
        $qa = QuestionAnswerText::create(['survey_response_id'=>$this->response_id,'question_id'=>$question_id,'value'=>$value]);
        $id = $qa->id;
        
        $value = $this->faker->realText($maxNbChars = 200, $indexSize = 2);
        $response = $this->putJson('/api/survey/'.$this->survey_id.'/response/'.$this->response_id.'/question/'.$question_id.'/text/'.$id,['value'=>$value]);
        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('code','200')
                ->whereType('data','integer')
                ->has('message')
                ->etc()
        );

        $qa = QuestionAnswerText::where('survey_response_id', $this->response_id)->where('question_id', $question_id)->get();
        $this->assertEquals($id, $qa->value('id'));
        $this->assertEquals($value, $qa->value('value'));
    }

    /**
     * Test storing integer answer
     */
    public function test_survey_answer_2_int(): void
    {
        $question_id = 2;
        $value = rand(0,4);
        $response = $this->putJson('/api/survey/'.$this->survey_id.'/response/'.$this->response_id.'/question/'.$question_id.'/int/',['value'=>$value]);
        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('code','200')
                ->whereType('data','integer')
                ->has('message')
                ->etc()
        );
        
        $qa = QuestionAnswerInt::where('survey_response_id', $this->response_id)->where('question_id', $question_id)->get();
        $this->assertEquals($value, $qa->value('value'));
    }

    /**
     * Test changing integer answer
     */
    public function test_survey_answer_3_edit_int(): void
    {
        $value = rand(5,10);
        $question_id = 3;
        $qa = QuestionAnswerInt::create(['survey_response_id'=>$this->response_id,'question_id'=>$question_id,'value'=>$value]);
        $id = $qa->id;
        
        $value = rand(0,4);
        $response = $this->putJson('/api/survey/'.$this->survey_id.'/response/'.$this->response_id.'/question/'.$question_id.'/int/'.$id,['value'=>$value]);
        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('code','200')
                ->whereType('data','integer')
                ->has('message')
                ->etc()
        );

        $qa = QuestionAnswerInt::where('survey_response_id', $this->response_id)->where('question_id', $question_id)->get();
        $this->assertEquals($id, $qa->value('id'));
        $this->assertEquals($value, $qa->value('value'));
    }


}
