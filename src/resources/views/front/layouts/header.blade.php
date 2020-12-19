<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a href="/" class="navbar-brand text-success">
    Laravel-Ecommerce <i class="material-icons">store</i>
  </a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      @guest
        @if (Route::has('back.operator.register'))
         <li class="nav-item active">
           <a class="nav-link" href="{{ route('register') }}">Register</a>
         </li>
        @endif

        @if (Route::has('login'))
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
        @endif
      @else
        @if (Route::has('logout'))
          <li class="nav-item active">
            <span class="nav-link"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit(); ">Logout</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
            </form>
          </li>
        @endif
      @endguest
    </ul>
  </div>
</nav>
