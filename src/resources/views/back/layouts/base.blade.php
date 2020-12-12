<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <style>body { background-color: #efefef; }</style>
</head>
<body>
@include('back.layouts.header')

@yield('content')

@include('back.layouts.footer')
</body>
</html>
