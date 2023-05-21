
## Deployment

Configure <code>DB_</code> and <code>APP_KEY</code> in .env and run:

```bash
docker-compose
```


## Client API


### Creating Survey Response
<details>
<summary><code>PUT</code> <code><b>/api/survey/{survey}/response/</b></code><code>(creates response for survey {survey})</code></summary>

#### Parameters
> | name    |  type      | data type      | description                                          |
> |---------|------------|----------------|------------------------------------------------------|
> | {survey}|  required  | integer        | Survey ID                                            |


#### Response

> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`                | `{"code":"200","message":"Survey response created"}`                |
> | `400`         | `application/json`                | `{"code":"400","message":"Survey not found"}`                       |

##### Example cURL
```bash
curl -s -X PUT --header "Content-Type: application/json" "http://127.0.0.1:8000/api/survey/$SURVEY/response"
```

</details>

### Posting text answer

<details>
<summary><code>PUT</code> <code><b>/api/survey/{survey}/response/{response}/question/{question}/text/{id?}</b></code><code>(adds or edits text response for response {response} and question {question})</code></summary>

#### Parameters

> | name        |  type      | data type      | description                                          |
> |-------------|------------|----------------|------------------------------------------------------|
> | `value`     |  required  | string         | Text value of the answer for {question}              |
> | `{survey}`  |  required  | integer        | Survey ID                                            |
> | `{response}`|  required  | integer        | Response ID                                          |
> | `{question}`|  required  | integer        | Question ID                                          |


#### Response

> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`                | `{"code":"200","message":"Answer updated"}`                         |
> | `400`         | `application/json`                | `{"code":"400","message":"Validation error"}`                       |

##### Example cURL
```bash
curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/10/text -d '{"value":"Hello world"}'
```

</details>

### Posting integer answer

<details>
<summary><code>PUT</code> <code><b>/api/survey/{survey}/response/{response}/question/{question}/int/{id?}</b></code><code>(adds or edits integer response for response {response} and question {question})</code></summary>

#### Parameters

> | name        |  type      | data type      | description                                          |
> |-------------|------------|----------------|------------------------------------------------------|
> | `value`     |  required  | string         | Text value of the answer for {question}              |
> | `{survey}`  |  required  | integer        | Survey ID                                            |
> | `{response}`|  required  | integer        | Response ID                                          |
> | `{question}`|  required  | integer        | Question ID                                          |

#### Response

> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`                | `{"code":"200","message":"Answer updated"}`                         |
> | `400`         | `application/json`                | `{"code":"400","message":"Validation error"}`                       |


##### Example cURL
```bash
curl -s -X PUT --header "Content-Type: application/json" http://127.0.0.1:8000/api/survey/$SURVEY/response/$RESPONSE/question/1/int -d '{"value":"2"}'
```
</details>

## Statistics API

### Question answer average

<details>
<summary><code>GET</code> <code><b>/api/stats/question/average/{survey?}</b></code><code>(returns question average score, base 1)</code></summary>

#### Parameters

> | name       |  type      | data type      | description                                          |
> |------------|------------|----------------|------------------------------------------------------|
> | `{survey}` |  optional  | integer        | Survey ID to limit statistics                        |

#### Response

> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`                | `{"code":"200","data":"..."}`                                       |


##### Example cURL
```bash
curl -s --header "Content-Type: application/json" "http://127.0.0.1:8000/api/stats/question/average/1"
```
</details>

### Question answer count

<details>
<summary><code>GET</code> <code><b>/api/stats/question/count/{survey?}</b></code><code>(returns question answer count)</code></summary>

#### Parameters

> | name       |  type      | data type      | description                                          |
> |------------|------------|----------------|------------------------------------------------------|
> | `{survey}` |  optional  | integer        | Survey ID to limit statistics                        |

#### Response

> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`                | `{"code":"200","data":"..."}`                                       |


##### Example cURL
```bash
curl -s --header "Content-Type: application/json" "http://127.0.0.1:8000/api/stats/question/count/1"
```
</details>

### Option answer count

<details>
<summary><code>GET</code> <code><b>/api/stats/option/count/{survey?}</b></code><code>(returns option answer count)</code></summary>

#### Parameters

> | name       |  type      | data type      | description                                          |
> |------------|------------|----------------|------------------------------------------------------|
> | `{survey}` |  optional  | integer        | Survey ID to limit statistics                        |

#### Response

> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`                | `{"code":"200","data":"..."}`                                       |


##### Example cURL
```bash
curl -s --header "Content-Type: application/json" "http://127.0.0.1:8000/api/stats/option/count/1"
```
</details>

## Notes

Client API is currently unathenticated and session-less.
It would be desired to add sessions and store question/response data within each session
Session data can then be used to speed up access checks, which are out of scope for this project

## Suggestions

Answer option numeric values should be inverted, and changed to base 1.
For example:

> | Value   |  Title       |
> |---------|--------------|
> | 0       | <Unselected> |
> | 1       | Never        |
> | 2       | Rarely       |
> | 3       | Sometimes    |
> | 4       | Quite often  |
> | 5       | Very often   |

