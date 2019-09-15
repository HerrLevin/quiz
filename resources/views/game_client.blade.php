@extends('layouts.app')

@section('content')
Gamecode: {{ $code }}
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Frage 1</h1>
            <button id="antwort1" type="button" class="btn btn-success btn-lg display-none" disabled>Antwort 1</button>
            <button id="antwort2" type="button" class="btn btn-danger btn-lg display-none" disabled>Antwort 2</button>
            <button id="antwort3" type="button" class="btn btn-warning btn-lg display-none" disabled>Antwort 3</button>
            <button id="antwort4" type="button" class="btn btn-info btn-lg display-none" disabled>Antwort 4</button>
            <form>
                <input id="zahl" type="number" class="form-control display-none mt-5" disabled></input>
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
