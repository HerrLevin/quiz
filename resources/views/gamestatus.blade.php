@extends('layouts.app')

@section('content')
Game: {{ $code }}
<h1 class="display-1">Frage</h1>
<div class="alert alert-success d-none" role="alert" id="frage1">
    <h1 class="alert-heading">Antwort 1</h1>
</div>
<div class="alert alert-danger d-none" role="alert" id="frage2">
    <h1 class="alert-heading">Antwort 2</h1>
</div>
<div class="alert alert-warning d-none" role="alert" id="frage3">
    <h1 class="alert-heading">Antwort 3</h1>
</div>
<div class="alert alert-info d-none" role="alert" id="frage4">
    <h1 class="alert-heading">Antwort 4</h1>
</div>
@endsection
