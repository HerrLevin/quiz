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
    <style>
        body {
            background: rgb(248, 250, 252);
        }
        .product-icon {
            width: 1em;
            height: 1em;
        }

        ul.timeline {
            list-style-type: none;
            position: relative;
        }
        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline:last-child {
            background: transparent !important;
        }
        ul.timeline > li {
            margin: 20px 0;
            padding-left: 20px;
        }
        ul.timeline > li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid rgb(192, 57, 43);
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }

        ul.timeline > li:last-child {
            line-height: 1;
        }

        p.status-body:before,
        p.train-status:before {
            font-family: FontAwesome;
            display: inline-block;
            padding-right: 6px;
            vertical-align: middle;
        }

        .connection {
            background: #f5f5f5;
        }
        .text-trwl {
            color: rgb(199, 39, 48) !important;;
        }
        .bg-trwl {
            background-color: #c72730 !important;
        }

        .navbar-dark .navbar-brand {
            font-weight: bold !important;
        }

        .dropdown-menu {
            z-index: 2000;
        }
    </style>
</head>
<body>
    <div id="app">

        <main class="py-4">
                @yield('content')
        </main>

    </div>
    <script>

    </script>
</body>
</html>
