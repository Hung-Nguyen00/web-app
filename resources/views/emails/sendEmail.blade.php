<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sending Email</title>
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h5>{{ $details['title'] }}</h5>
                <p>{{ $details['body']  }}</p>
                <p>Thank you</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>



