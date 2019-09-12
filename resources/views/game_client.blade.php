@extends('layouts.app')

@section('content')
Gamecode: {{ $code }}
<h1>Frage 1</h1>
<button type="button" class="btn btn-success btn-lg btn-block" disabled>Antwort 1</button>
<button type="button" class="btn btn-danger btn-lg btn-block" disabled>Antwort 2</button>
<button type="button" class="btn btn-warning btn-lg btn-block" disabled>Antwort 3</button>
<button type="button" class="btn btn-info btn-lg btn-block" disabled>Antwort 4</button>
@endsection
