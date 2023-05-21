<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\SurveyResponse;

class SurveyResponseTest extends TestCase
{
    /**
     * Test initializing survey response
     */
    public function test_creating_survey_response(): void
    {
        $response = $this->putJson('/api/survey/1/response/',[]);
        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('code','200')
                ->whereType('data','integer')
                ->has('message')
                ->etc()
        );
        ;
        
        $sr = SurveyResponse::where('id',$response->getData()->data)->get()->first();
        $this->assertGreaterThan(2000,$sr->value('created_at')->year);
    }
}
