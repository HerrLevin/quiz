@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
    Gamecode: {{ $quiz->code }}
    <form method="POST">
    <h1>{{ $quiz->name }} <small>{{ $quiz->question }}</small> <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <input type="submit" class="btn btn-secondary" name="previous_question" autocomplete="off" value="Vorherige Frage">
            <input type="submit" class="btn btn-secondary" name="next_question" autocomplete="off" value="Nächste Frage">
        </div></h1>
        @csrf
    </form>
    </div>
    <div class="col-8">
        Gamestatus: {{ $quiz->active }}
        <h1>Status</h1>
        <nav>
            <form method="POST">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item {{ $quiz->active == '0' ? 'active' : ''}}"><button type="submit" name="status" value="0" class="page-link" href="#">Inaktiv</button></li>
                <li class="page-item {{ $quiz->active == '1' ? 'active' : ''}}"><button type="submit" name="status" value="1" class="page-link" href="#">Fragen anzeigen</button></li>
                <li class="page-item {{ $quiz->active == '2' ? 'active' : ''}}" id="antworten"><button type="submit" name="status" value="2" class="page-link" href="#">Antworten</button></li>
                <li class="page-item {{ $quiz->active == '3' ? 'active' : ''}}"><button type="submit" name="status" value="3" class="page-link" id="fertig">Antworten anzeigen</button></li>
                <li class="page-item {{ $quiz->active == '4' ? 'active' : ''}}"><button type="submit" name="status" value="4" class="page-link" href="#">Auflösen</button></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
                @csrf
            </form>
        </nav>
    </div>
</div>


    @if($question != null)
        <ul class="list-group">
            <li class="list-group-item active"><h4>{{ $question->question }}</h4></li>
            @if($question->type == 0 )
            <li class="list-group-item">1. {{ $question->a1 }}</li>
            <li class="list-group-item">2. {{ $question->a2 }}</li>
            <li class="list-group-item">3. {{ $question->a3 }}</li>
            <li class="list-group-item">4. {{ $question->a4 }}</li>
            @endif
            <li class="list-group-item">{{ $question->answer }}</li>
        </ul>
        <table class="mt-5 table table-sm table-striped table-hover">
            <tr class="bg-primary"><td></td><td><h4 class="text-white">Antworten</h4></td></tr>
        @foreach($answers as $answer)
                <tr><td><b>{{ $answer->username}}:</b></td> <td>{{ $answer->answer }}</td></tr>
        @endforeach
        </table>

    @endif

    <script>
        setTimeout(function() {
            if (document.getElementById('antworten').classList.contains('active')) {
                document.getElementById('fertig').click();
                console.log('asdf');
            }
        }, 4000);

        setTimeout(function() {
            window.location.href = window.location.href
        }, 5000);
    </script>
@endsection
