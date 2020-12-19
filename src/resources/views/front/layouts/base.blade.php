<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
@include('front.layouts.header')

<!-- side bar -->
<div class="row">
  <div class="col-2 bd-sidebar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav flex-column">
          @foreach ($categories as $category)
            <li class="nav-item">{{ $category->name }}</li>
          @endforeach
        </ul>
      </div>
    </nav>
  </div>

  @yield('content')
</div>

@include('front.layouts.footer')
</div
</html>
