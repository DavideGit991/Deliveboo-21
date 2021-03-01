<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="{{ asset('/js/app.js') }}"></script>

    <title>Document</title>
</head>
<body>

    <div class="container">

        @include('components.header')
        @yield('content')
        @include('components.footer')

    </div>
    
</body>
</html>