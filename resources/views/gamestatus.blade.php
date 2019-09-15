@extends('layouts.app')

@section('content')
    Game: {{ $code }}

    <div class="row">
    <div class="col">
<h1 class="display-1" id="question">Frage</h1>
        <div class="alert alert-primary display-none" id="schaetzen">
            <h1 class="alert-heading">Schätzen!</h1>
        </div>
<div class="alert alert-success" role="alert" id="frage1">
    <h1 class="alert-heading">Antwort 1</h1>
</div>
<div class="alert alert-danger" role="alert" id="frage2">
    <h1 class="alert-heading">Antwort 2</h1>
</div>
<div class="alert alert-warning" role="alert" id="frage3">
    <h1 class="alert-heading">Antwort 3</h1>
</div>
<div class="alert alert-info" role="alert" id="frage4">
    <h1 class="alert-heading">Antwort 4</h1>
</div>
    </div>
    <div id="answersCol" class="col display-none">
        <h1 class="display-1">Antworten</h1>
    <table class="table">
        <tbody id="answers">
            <tr><td class="h1">Gruppe X</td><td class="h1">1</td></tr>
        </tbody>
    </table>
    </div>
</div>
@endsection
