<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a href="{{ route('back.top') }}" class="navbar-brand">Laravel-Ecommerce[Back]</a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      @guest
        @if (Route::has('back.operator.register'))
         <li class="nav-item active">
           <a class="nav-link" href="{{ route('back.operator.register') }}">Register</a>
         </li>
        @endif

        @if (Route::has('back.operator.login'))
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('back.operator.login') }}">Login</a>
          </li>
        @endif
      @else
        @if (Route::has('back.operator.logout'))
          <li class="nav-item active">
            <span class="nav-link"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit(); ">Logout</span>
            <form id="logout-form" action="{{ route('back.operator.logout') }}" method="POST">
              @csrf
            </form>
          </li>
        @endif
      @endguest
    </ul>
  </div>
</nav>
