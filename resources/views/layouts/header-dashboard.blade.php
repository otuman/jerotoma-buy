<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto float-left">
      <li class="nav-item {{ set_active('shop') }}"><a class="nav-link"  href="{{route('shop')}}">Order Tracker</a></li>
      <li class="nav-item {{ set_active('shop') }}"><a class="nav-link"  href="{{route('shop')}}">My Orders</a></li>
      <li class="nav-item {{ set_active('shop') }}"><a class="nav-link"  href="{{route('shop')}}">Shop now</a></li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <ul class="navbar-nav float-right">
      <app-notifications></app-notifications>      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{Auth::check() ? Auth::user()->firstName : 'My Account' }}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
           @guest
              <a class="dropdown-item" href="{{ route('login') }}">Login</a>
              <a class="dropdown-item" href="{{ route('register') }}">Register</a>
            @else
              <a class="dropdown-item" href="{{url('dashboard')}}">Profile</a>
              <a class="dropdown-item" href="{{url('dashboard')}}">Settings</a>
              <a class="dropdown-item" href="{{url('dashboard')}}">Support</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            @endguest
        </div>
      </li>
    </ul>
  </div>
</nav>


 @section('extra-js')
   <script>
    $(document).ready(function(){




        });
   </script>

 @endsection
