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


# API docs

# Endpoint /api/gamestatus
## Parameters
| POST/GET | `code` | gamecode |

## Response
```
{
quiz: {
name: "SozPäd-Quiz",
id: 1,
code: "EnBW",
status: "0",
question: "2"
},
question: {
type: "0",
question: "Frage2",
answer1: "Blah",
answer2: "blah ",
answer3: "blubb",
answer4: "asdf",
correct_answer: "3"
}
}
```

# Endpoint /api/answer
## Parameters
| POST | `username` | Name of user |
| POST | `question` | ID of question. (NOT number!) |
| POST | `answer`   | Number of answer. Can be 1-4 or random integer, depending on question-type|

## Response
If done correctly: (HTTP code 200)
```
[
"done"
]
```

If done incorrectly (HTTP code 408)
```
{
error: "Your user already voted"
}
```
