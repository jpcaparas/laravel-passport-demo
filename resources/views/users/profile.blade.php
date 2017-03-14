<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
</head>
<body>
<div style="padding: 20px;">
    <div id="results">Hello there</div>
    <p>
        <button type="button" id="fetch">Fetch data from the API</button>
    </p>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>