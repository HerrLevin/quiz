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

        let textCounter = $("#counter");
        let check = true;


        setInterval(function () {
            if (check) {
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost:8000/api/gamestatus?code=EnBW',
                    dataType: "json",

                    success: function (data) {

                        //nimmt den Wert aus der API und setzt den auf die Variable status
                        let status = data['quiz']['status'];
                        let correctAnswerId = data['question']['correct_answer'];

                        console.log(status);

                        switch (status) {
                            //no Questions
                            case '0':
                                console.log("case 0");
                                $(frage1).addClass("display-none");
                                $(frage2).addClass("display-none");
                                $(frage3).addClass("display-none");
                                $(frage4).addClass("display-none");
                                break;
                            //Antworten werden angezeigt
                            case '1':
                                console.log("case 1");
                                $(frage1).removeClass("display-none").addClass("display-block");
                                $(frage2).removeClass("display-none").addClass("display-block");
                                $(frage3).removeClass("display-none").addClass("display-block");
                                $(frage4).removeClass("display-none").addClass("display-block");
                                break;
                            //Timer für 30 Sekunden
                            case '2':
                                check = false;
                                setTimeout(function () {
                                    console.log("ausgeführt");
                                    check = true;
                                }, 30000);
                                console.log("case 2");
                                $(antwort1).attr("disabled", false);
                                $(antwort2).attr("disabled", false);
                                $(antwort3).attr("disabled", false);
                                $(antwort4).attr("disabled", false);


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
                                break;
                            //Nutzer bekommt die richtige anwort angezeigt
                            case'3':
                                console.log("case 3");
                                console.log(correctAnswerId);

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
