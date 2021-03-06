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
    <div class="absolute container">
        @include('layout/sidebar')
        <div class="absolute container mx-auto mt-6 md:left-80 left-20 ">
            @yield('main')
        </div>
    </div>
</body>

</html>
