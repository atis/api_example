#!/bin/bash

#curl -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey_answer_text/2 -d '{"question_id":"2","answer_text":"Blah","answer_id":3}'
#curl -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/1/response/2/text/3 -d '{"question_id":"2","answer_text":"Blah","answer_id":3}'

#curl -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/1/response -d '{}'

_responses() {
    SURVEY=1
    RESPONSE=$1
    if [ "$1" == "" ]; then
        RESPONSE=`curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response | jq -r ".data"`
    fi
    V1=$(( ( RANDOM % 4 ) ))
    V2=$(( ( RANDOM % 4 ) ))
    V3=$(( ( RANDOM % 4 ) ))
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/1/int -d '{"value":"'$V1'"}'
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/2/int -d '{"value":"'$V2'"}'
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/3/int -d '{"value":"'$V3'"}'
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/4/int -d '{"value":"'$V3'"}'
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/5/int -d '{"value":"'$V2'"}'
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/6/int -d '{"value":"'$V1'"}'
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/7/int -d '{"value":"2"}'
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/8/int -d '{"value":"3"}'
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/9/int -d '{"value":"4"}'
    
    curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/10/text -d '{"value":"Blahahahahahsasd"}'
    echo
}


_responses
_responses
_responses
_responses
_responses
_responses
_responses
_responses

_responses 1
