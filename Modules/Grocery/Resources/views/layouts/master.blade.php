<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module Grocery</title>

    {{-- Laravel Mix - CSS File --}}
    {{--<link rel="stylesheet" href="{{ mix('css/grocery.css') }}">--}}

    {{--Include Main CSS File--}}

</head>
<body>
{{--Include Main Nav and Sidebar--}}
<div id="grocery-app">
    @yield('content')
    <example></example>
</div>

{{--Include Main JS file--}}

{{-- Laravel Mix - JS File --}}
<script src="{{ mix('js/grocery.js') }}"></script>
</body>
</html>
