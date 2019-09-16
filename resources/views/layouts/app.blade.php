<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

</div>
<script>

</script>
</body>

<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script>
    jQuery(document).ready(function ($) {
        //fragen als Element auf der DOM bekommen
        let frage1 = $("#frage1");
        let frage2 = $("#frage2");
        let frage3 = $("#frage3");
        let frage4 = $("#frage4");
        //Anwtorten als DOM Element bekommen
        let antwort1 = $("#antwort1");
        let antwort2 = $("#antwort2");
        let antwort3 = $("#antwort3");
        let antwort4 = $("#antwort4");
        //Input feld für schätzfragen
        let inputField = $("#zahl");

        let form = $("#form");
        let button = $("#schButton");

        let schaetzen = $("#schaetzen");
        let hquestion = $("#question");
        var questionId = '';


        let textCounter = $("#counter");
        let check = true;
        let printed = false;

        //Sendet schätzen in DB
        $(form).submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('api_answer') }}",
                data: {
                    username: "{{ session('username') }}", // < note use of 'this' here
                    question: $(this).data("info"),
                    _token: "{{ csrf_token() }}",
                    answer: $(inputField).val()
                },
                success: function(result) {
                    $(inputField).attr("disabled", true);
                    $(button).attr("disabled", true);
                },
                error: function(result) {
                    alert('Ein Fehler trat auf! Eventuell bereits geantwortet?');
                }
            });
        });

        //Sendet Antwort in die DB
        $(".answer-button").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('api_answer') }}",
                data: {
                    username: "{{ session('username') }}", // < note use of 'this' here
                    question: $(this).data("info"),
                    _token: "{{ csrf_token() }}",
                    answer: $(this).data("answer")
                },
                success: function(result) {
                    $(antwort1).attr("disabled", true);
                    $(antwort2).attr("disabled", true);
                    $(antwort3).attr("disabled", true);
                    $(antwort4).attr("disabled", true);
                },
                error: function(result) {
                    alert('Ein Fehler trat auf! Eventuell bereits geantwortet?');
                }
            });
        });


        setInterval(function () {
            if (check) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('api_gamestatus') }}' + '?code=EnBW',
                    dataType: "json",

                    success: function (data) {

                        //nimmt den Wert aus der API und setzt den auf die Variable status
                        let status = data['quiz']['status'];
                        let questiontext = data['question']['question'];
                        let answer1 = data['question']['answer1'];
                        let answer2 = data['question']['answer2'];
                        let answer3 = data['question']['answer3'];
                        let answer4 = data['question']['answer4'];
                        let correctAnswerId = data['question']['correct_answer'];
                        let questionId = data['question']['id'];
                        //Fragentyp entweder 0 = vier Antwortmöglichkeiten oder 1 = schätzfrage
                        let questionType = data['question']['type'];

                        switch (status) {
                            //no Questions
                            case '0':
                                $('#answersCol').addClass('display-none');
                                $(frage1).addClass("display-none").removeClass("correct-answer");
                                $(frage2).addClass("display-none").removeClass("correct-answer");
                                $(frage3).addClass("display-none").removeClass("correct-answer");
                                $(frage4).addClass("display-none").removeClass("correct-answer");
                                break;
                            //Antworten werden angezeigt
                            case '1':
                                $('#answersCol').addClass('display-none');
                                $(hquestion).text(questiontext.toString());
                                if (questionType == 0) {
                                    $(schaetzen).addClass("display-none");
                                    $(frage1).removeClass("display-none").addClass("display-block");
                                    $(frage2).removeClass("display-none").addClass("display-block");
                                    $(frage3).removeClass("display-none").addClass("display-block");
                                    $(frage4).removeClass("display-none").addClass("display-block");

                                    $(frage1).children().text(answer1.toString());
                                    $(frage2).children().text(answer2.toString());
                                    $(frage3).children().text(answer3.toString());
                                    $(frage4).children().text(answer4.toString());
                                }
                                if (questionType == 1) {
                                    $(schaetzen).removeClass("display-none");
                                    $(schaetzen).children().text("Schätzen!");
                                    $(frage1).addClass("display-none").removeClass("display-block");
                                    $(frage2).addClass("display-none").removeClass("display-block");
                                    $(frage3).addClass("display-none").removeClass("display-block");
                                    $(frage4).addClass("display-none").removeClass("display-block");
                                }
                                break;
                            //Timer für 30 Sekunden
                            case '2':
                                check = false;

                                //deaktiviert die sekündliche abrfrage an die API
                                setTimeout(function () {
                                    check = true;
                                }, 30000);

                                if(questionType == 0){
                                    $(antwort1).removeClass("display-none").attr("disabled", false);
                                    $(antwort2).removeClass("display-none").attr("disabled", false);
                                    $(antwort3).removeClass("display-none").attr("disabled", false);
                                    $(antwort4).removeClass("display-none").attr("disabled", false);
                                    $(antwort1).attr('data-info', questionId);
                                    $(antwort2).attr('data-info', questionId);
                                    $(antwort3).attr('data-info', questionId);
                                    $(antwort4).attr('data-info', questionId);
                                    $(frage1).removeClass("display-none");
                                    $(frage2).removeClass("display-none");
                                    $(frage3).removeClass("display-none");
                                    $(frage4).removeClass("display-none");

                                    //macht Form unsichertbar, weil Antwortmöglichketien gegeben sind
                                    $(inputField).addClass("display-none");
                                    $(button).addClass("display-none");


                                    let x = 31;

                                    for (let i = 0; i < x; i++) {
                                        setTimeout(function () {
                                            x--;
                                            $(textCounter).text(x);
                                            if (x == 0) {
                                                $(antwort1).attr("disabled", true);
                                                $(antwort2).attr("disabled", true);
                                                $(antwort3).attr("disabled", true);
                                                $(antwort4).attr("disabled", true);
                                            }
                                        }, 1000 * i);
                                    }
                                }

                                if(questionType == 1){
                                    $(inputField).removeClass("display-none").attr("disabled", false);
                                    $(button).removeClass("display-none").attr("disabled", false);

                                    $(form).attr('data-info', questionId);
                                    $(antwort1).addClass("display-none");
                                    $(antwort2).addClass("display-none");
                                    $(antwort3).addClass("display-none");
                                    $(antwort4).addClass("display-none");

                                    let x = 31;

                                    for (let i = 0; i < x; i++) {
                                        setTimeout(function () {
                                            x--;
                                            $(textCounter).text(x);
                                            if (x == 0) {
                                                $(inputField).attr("disabled", true);
                                                $(button).attr("disabled", true);
                                            }
                                        }, 1000 * i);
                                    }
                                }


                                break;
                            //Nutzer bekommt die richtige anwort angezeigt
                            case'3':
                                $('#answersCol').removeClass('display-none');
                                    let new_tbody = document.createElement('tbody');
                                    let old_tbody = document.getElementById('answers_table').firstChild;

                                    data['answers'].forEach(function(element){
                                        var new_row = new_tbody.insertRow();
                                        var cell1 = new_row.insertCell(0);
                                        var cell2 = new_row.insertCell(1);

                                        cell1.innerHTML = element['username'];
                                        cell1.className += 'display-3';
                                        cell2.innerHTML = element['answer'];
                                        cell2.className +='display-3';
                                    });

                                    old_tbody.parentNode.replaceChild(new_tbody, old_tbody);



                                printed = true;
                                break;
                            case'4':
                                printed = false;

                                if (questionType == 0) {
                                    switch (correctAnswerId) {
                                        case '1':
                                            $(frage1).addClass("correct-answer");
                                            break;
                                        case '2':
                                            $(frage2).addClass("correct-answer");
                                            break;
                                        case '3':
                                            $(frage3).addClass("correct-answer");
                                            break;
                                        case '4':
                                            $(frage4).addClass("correct-answer");
                                            break;
                                    }
                                    ;
                                }
                                if (questionType == 1) {
                                    $(schaetzen).children().text(correctAnswerId.toString());
                                }
                                break;

                        }

                    },
                    error: function (request, status, error) {

                        alert(error);
                    }
                });
            }
        }, 1000);
    });
</script>
</html>
