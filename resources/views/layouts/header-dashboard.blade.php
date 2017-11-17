<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">Order Tracker</a></li>
          <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">My Orders</a></li>
          <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">Shop now</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i><span class="badge">42</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::check() ? Auth::user()->firstName : 'My Account' }}<span class="caret"></span></a>
          <ul class="dropdown-menu">
            @guest
            <li class="{{ set_active('login') }}">
              <a href="{{ route('login') }}" class="">Login</a>
            </li>
            <li class="{{ set_active('register') }}">
              <a href="{{ route('register') }}" class="">Register</a>
            </li>
            @else
              <li class="divider"></li>
              <li><a href="{{url('dashboard')}}">Profile</a></li>
              <li><a href="#!">Settings</a></li>
              <li class="{{ set_active('logout') }}">
                  <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </li>
            @endguest
           <li class="divider"></li>
           <li><a href="#!">Support</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

 @section('extra-js')
   <script>
    $(document).ready(function(){




        });
   </script>

 @endsection
