<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Quizzes;
use App\Answers;
use Illuminate\Database\Eloquent;
use PhpParser\Node\Expr\Cast\Object_;

class QuizController extends Controller
{
    public function getGameStatus(Request $request) {
        $response = array();
        $quiz = Quizzes::where('code', $request->code)->first();
        if ($quiz === null) {
            return ('<h1>No quiz found!</h1>');
        }
        $response['quiz']['name'] = $quiz->name;
        $response['quiz']['id'] = $quiz->id;
        $response['quiz']['code'] = $quiz->code;

        /*
         * Status-codes
         * 0 -> inactive (no questions)
         * 1 -> question (no answer-possibility. Messages could fade in)
         * 2 -> question with answer (limited to 30 s)
         * 3 -> answers locked. Show user-answers on screen
         * 4 -> highlight correct answer
         *
         */

        $response['quiz']['status'] = $quiz->active;
        $response['quiz']['question'] = $quiz->question;
        $question = Question::where('quiz_id', $quiz->id)->where('question_number', $quiz->question)->first();
        $response['question'] = array();
        if ($question != null) {
            $response['question']['id'] = $question->id;
            $response['question']['question'] = $question->question;
            $response['question']['type'] = $question->type; //guessing a number will be type 1 and a multiple choice is type 0
            $response['question']['answer1'] = $question->a1;
            $response['question']['answer2'] = $question->a2;
            $response['question']['answer3'] = $question->a3;
            $response['question']['answer4'] = $question->a4;
            $response['question']['correct_answer'] = $question->answer; //when guessing a number, the aboslute number will be in this field

            $response['answers'] = [];
            $answers = Answers::where('question_id', $question->id)->get();
            foreach($answers as $answer) {
                $answer_array = array();
                $answer_array['username'] = $answer->username;
                $answer_array['answer'] = $answer->answer;

                array_push($response['answers'], $answer_array);
            }

        }

        return response()->json($response);
    }

    public function makeAnswer(Request $request) {

        $answered = Answers::where('question_id', $request['question'])->where('username', $request['username'])->first();

        if ($answered != null) {
            return response()->json(['error' => 'Your user already voted'])->setStatusCode(408);
        }

        $answer = New Answers();
        $answer->username = $request['username'];
        $answer->question_id = $request['question'];
        $answer->answer = $request['answer'];
        $answer->save();

        return response()->json(['done'])->setStatusCode(200);

    }


}
