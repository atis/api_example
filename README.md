
## Deployment

Set up .env and run 

```bash
docker-compose
```

## Client API


### Creating Survey Response
<details>
<summary><code>PUT</code> <code><b>/api/survey/{survey}/response/</b></code><code>(creates response for survey {survey})</code></summary>

#### Parameters
None

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

> | name   |  type      | data type      | description                                          |
> |--------|------------|----------------|------------------------------------------------------|
> | `value`|  required  | string         | Text value of the answer for {question}              |


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

> | name   |  type      | data type      | description                                          |
> |--------|------------|----------------|------------------------------------------------------|
> | `value`|  required  | integer        | Integer value of the answer for {question}           |

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
