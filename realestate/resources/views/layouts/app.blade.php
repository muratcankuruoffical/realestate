<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <title>Document</title>
</head>
<body>
<div id="app">

</div>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="application/javascript"></script>
</body>
</html>
