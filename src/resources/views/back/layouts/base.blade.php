<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title', 'LaravelEcommerce')
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <!-- CSS Files -->
  <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="black">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <span class="simple-text logo-normal">管理メニュー</span>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('back.operator.menu') }}">
              <i class="material-icons">person</i>
              <p>担当者管理</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('back.user.menu') }}">
              <i class="material-icons">person</i>
              <p>ユーザー管理</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('back.makers.menu') }}">
              <i class="material-icons">build</i>
              <p>メーカー管理</p>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              @guest
              @else
                @if (Route::has('back.operator.logout'))
                  <li class="nav-item">
                    <a class="nav-link"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                    >Logout</a>
                    <form id="logout-form" action="{{ route('back.operator.logout') }}" method="post">
                      @csrf
                    </form>
                  </li>
                @endif
              @endguest
            </ul>
          </div>
        </div>
      </nav>

      @yield('content')

    </div>
</body>

</html>
