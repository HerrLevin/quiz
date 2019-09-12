<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Quizzes;

class QuizController extends Controller
{
    public function getGameStatus(Request $request) {
        $quiz = Quizzes::where('code', $request->code)->first();
        $question = Question::where('quiz_id', $quiz->id)->where('question_number', $quiz->question)->first();

        return view('quizboard', compact('quiz', 'question'));
    }
}
