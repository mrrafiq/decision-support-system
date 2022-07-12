<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ $title }}</title>
</head>

<body>
    <div class="container overflow-x-auto">
        @include('layout/sidebar')
        <div class="absolute container mx-auto mt-6 md:left-80 left-20 w-3/5">
            @yield('main')
        </div>
    </div>
</body>
</html>
