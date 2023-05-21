<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StatsTest extends TestCase
{
    var $survey_id = 1;

    public function setUp():void {
        parent::setUp();
        //
    }

    public function tearDown():void {
        //
        parent::tearDown();
    }

    /**
     * Test Question average
     */
    public function test_stats_question_average(): void
    {
        $response = $this->getJson('/api/stats/question/average/'.$this->survey_id);

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('code','200')
                ->whereType('data','array')
                ->has('data',9)
                ->has('data.0', fn (AssertableJson $json) =>
                    $json
                        ->where('question_id',1)
                        ->has('average')
                )
                ->etc()
        );
    }

    /**
     * Test Question answer count
     */
    public function test_stats_question_answer_count(): void
    {
        $response = $this->getJson('/api/stats/question/count/'.$this->survey_id);

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('code','200')
                ->whereType('data','array')
                ->has('data',9)
                ->has('data.0', fn (AssertableJson $json) =>
                    $json
                        ->where('question_id',1)
                        ->has('count')
                )
                ->etc()
        );
    }

    /**
     * Test Option answer count
     */
    public function test_stats_option_answer_count(): void
    {
        $response = $this->getJson('/api/stats/option/count/'.$this->survey_id);

        $response->assertStatus(200);
        //$response->dd();
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('code','200')
                ->whereType('data','array')
                ->has('data.0', fn (AssertableJson $json) => $json->where('value',0)->where('text','Very often')->has('count'))
                ->has('data.1', fn (AssertableJson $json) => $json->where('value',1)->where('text','Quite often')->has('count'))
                ->has('data.2', fn (AssertableJson $json) => $json->where('value',2)->where('text','Sometimes')->has('count'))
                ->has('data.3', fn (AssertableJson $json) => $json->where('value',3)->where('text','Rarely')->has('count'))
                ->has('data.4', fn (AssertableJson $json) => $json->where('value',4)->where('text','Never')->has('count'))
                ->etc()
        );
    }
}
