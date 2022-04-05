<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hondje</title>
    <x-favicon icon="🍳"/>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="min-w-full min-h-screen flex justify-center items-center">
    <img src="{{ $img }}"
         class="w-64"
         alt="Hondje"/>
</div>
</body>
</html>
