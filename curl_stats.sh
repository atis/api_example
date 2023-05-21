#!/bin/bash

FORMAT=0
function _format() {
    if [ "$FORMAT" == "1" ]; then
        jq
    else
        cat
        echo
    fi
}

curl -s --header "Content-Type: application/json" "http://127.0.0.1:8000/api/stats/question/average/" | _format
curl -s --header "Content-Type: application/json" "http://127.0.0.1:8000/api/stats/question/average/1" | _format

curl -s --header "Content-Type: application/json" "http://127.0.0.1:8000/api/stats/question/count/" | _format
curl -s --header "Content-Type: application/json" "http://127.0.0.1:8000/api/stats/question/count/1" | _format

curl -s --header "Content-Type: application/json" "http://127.0.0.1:8000/api/stats/option/count/"  | _format
curl -s --header "Content-Type: application/json" "http://127.0.0.1:8000/api/stats/option/count/1"  | _format

# | jq

