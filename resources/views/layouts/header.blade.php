<header>
        <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('/')}}">Brand</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">Shop <span class="sr-only">(current)</span></a></li>
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li class="{{ set_active('wishlist') }}"><a href="{{ url('/wishlist') }}" class="">Wishlist ({{ Cart::instance('wishlist')->count(false) }})</a></li>
               <li class="{{ set_active('cart') }}"><a href="{{ url('/cart') }}" class="">Cart ({{ Cart::instance('default')->count(false) }})</a></li>

              @guest
              <li class="{{ set_active('login') }}">
                <a href="{{ route('login') }}" class="">Login</a>
              </li>
              <li class="{{ set_active('register') }}">
                <a href="{{ route('register') }}" class="">Register</a>
              </li>
              @else
                <li>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Auth::user()->firstName }} <span class="caret"></span>
                   </a>

                <ul class="dropdown-menu" role="menu">
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
              </ul>
            </li>
            @endguest
            </ul>
          </div>
        </div>
     </nav>
</header>
