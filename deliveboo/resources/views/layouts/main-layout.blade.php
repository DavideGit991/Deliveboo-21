<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    {{-- script --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.js"></script>
    <script src="{{ asset('/js/app.js') }}"></script>

   {{-- link --}}
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    <title>Document</title>
</head>
<body>

    <div id="app" class="container">

        @include('components.header')
        @yield('content')
        @include('components.footer')

    </div>

</body>
</html>
