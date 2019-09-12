# Quiz

## Setup
```
composer install
npm install
npm run dev
touch database/database.sqlite
php artisan key:generate
php artisan migrate
```

# Important paths
Gameclient: `http://localhost:8000/game/{GAME_ID}` (view 'game_client.blade.php')
Gameclient: `http://localhost:8000/gamestatus/{GAME_ID}` (view 'gamestatus.blade.php')

Javascript _should_ be placed in 'app.blade.php


# API docs

# Endpoint /api/gamestatus
## Parameters
| Type  | Request  | Description  |
| ------ | ----- | ----- |
| POST/GET  | `code`  | gamecode  |

## Response
``` JSON
{
   "quiz":{
      "name":"SozP\u00e4d",
      "id":1,
      "code":"EnBW",
      "status":"1",
      "question":"1"
   },
   "question":{
      "id":1,
      "question":"Wie hei\u00dft der B\u00fcrgermeister von Wesel?",
      "type":"0",
      "answer1":"Esel",
      "answer2":"Storch",
      "answer3":"Kakadu",
      "answer4":"Flamingo",
      "correct_answer":"1"
   },
   "answers":[
      {
         "username":"Gruppe2",
         "answer":"1"
      },
      {
         "username":"Gruppe3",
         "answer":"1"
      },
      {
         "username":"Gruppe1",
         "answer":"1"
      }
   ]
}
```

# Endpoint /api/answer
## Parameters
| Type  | Request  | Description  |
| ------ | ----- | ----- |
| POST | `username` | Name of user |
| POST | `question` | ID of question. (NOT number!) |
| POST | `answer`   | Number of answer. Can be 1-4 or random integer, depending on question-type|

## Response
If done correctly: (HTTP code 200)
```JSON
[
"done"
]
```

If done incorrectly (HTTP code 408)
```JSON
{
   "error":"Your user already voted"
}
```
