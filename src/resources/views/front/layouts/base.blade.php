<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  {{-- TODO: 他に良い読み込み方がありそう --}}
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script></head>
<body>
@include('front.layouts.header')

<!-- side bar -->
<div class="row">
  <div class="col-2 bd-sidebar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav flex-column">
          @foreach ($categories as $category)
            @if (isset($searched_category_id) && $category->id == $searched_category_id)
              <a class="text-success" href="{{ route('top') }}?category_id={{ $category->id }}">
            @else
              <a class="text-dark" href="{{ route('top') }}?category_id={{ $category->id }}">
            @endif
              <li class="nav-item">{{ $category->name }}</li>
            </a>
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
