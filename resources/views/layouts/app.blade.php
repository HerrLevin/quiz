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
jQuery(document).ready(function($) {

    //fragen als Element auf der DOM bekommen
    let frage1 = $("#frage1");
    let frage2 = $("#frage2");
    let frage3 = $("#frage3");
    let frage4 = $("#frage4");

    $.ajax({
        type: 'GET',
        url: 'http://localhost:8000/api/gamestatus?code=EnBW',
        dataType: "json",

        success: function (data) {

            console.log(data);
            //nimmt den Wert aus der API und setzt den auf die Variable status
            let status = data['quiz']['status'];

            switch (status){
                case '1':
                    $(frage1).attr('style', 'display: block !important');
                    $(frage2).attr('style', 'display: block !important');
                    $(frage3).attr('style', 'display: block !important');
                    $(frage4).attr('style', 'display: block !important');
                    break;
            }

        },
        error: function (request, status, error) {

            alert(error);
        }
    });
});
</script>
</html>
