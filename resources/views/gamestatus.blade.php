@extends('layouts.app')

@section('content')
Game: {{ $code }}
<h1 class="display-1">Frage frage blah blah blah</h1>
<div class="alert alert-success" role="alert">
    <h1 class="alert-heading">Antwort 1</h1>
</div>
<div class="alert alert-danger" role="alert">
    <h1 class="alert-heading">Antwort 2</h1>
</div>
<div class="alert alert-warning" role="alert">
    <h1 class="alert-heading">Antwort 3</h1>
</div>
<div class="alert alert-info" role="alert">
    <h1 class="alert-heading">Antwort 4</h1>
</div>
@endsection
