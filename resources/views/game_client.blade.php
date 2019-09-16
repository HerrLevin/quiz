@extends('layouts.app')

@section('content')
Gamecode: {{ $code }} {{ session('username') }} <a href="{{route('logout')}}">Logout</a>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center" id="question">Frage 1</h1>
            <button id="antwort1" type="button" class="answer-button btn btn-success btn-lg display-none" data-answer="1" data-qid="0" disabled>Antwort 1</button>
            <button id="antwort2" type="button" class="answer-button btn btn-danger btn-lg display-none" data-answer="2" data-qid="0" disabled>Antwort 2</button>
            <button id="antwort3" type="button" class="answer-button btn btn-warning btn-lg display-none" data-answer="3" data-qid="0" disabled>Antwort 3</button>
            <button id="antwort4" type="button" class="answer-button btn btn-info btn-lg display-none" data-answer="4" data-qid="0" disabled>Antwort 4</button>
            <form id="form" data-qid="0">
                <input id="zahl" type="number" class="form-control display-none mt-5" disabled></input>
                <button id="schButton" type="submit" class="btn btn-primary display-none" disabled>Abschicken</button>
            </form>
        </div>
        <div class="col-12 mt-5">
            <div id="timer" class="text-center">
                <h3>verbleibende Zeit:</h3>
                <h1 id="counter">30</h1>
            </div>
        </div>
    </div>

</div>
@endsection
