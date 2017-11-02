<header>

    <nav>
       <div class="container">
         <div class="nav-wrapper blue">
            <a href="{{route('/')}}" class="brand-logo">Logo</a>
            <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">Shop</a></li>
              <li class="{{ set_active('wishlist') }}"><a href="{{ url('/wishlist') }}" class=""><i class="small material-icons left" style="margin-right:0px;">favorite</i><span class="badge white-text" data-badge-caption="items">({{ Cart::instance('wishlist')->count(false) }})</span></a></li>
              <li class="{{ set_active('cart') }}"><a href="{{ url('/cart') }}" class=""><i class="small material-icons left" style="margin-right:0px;">shopping_cart</i><span class="badge white-text" data-badge-caption="items">({{ Cart::instance('default')->count(false) }})</span></a></li>
               <!-- Dropdown Trigger -->
              <li><a class="dropdown-button" href="#!" data-activates="dropdown-web-menu">
                {{Auth::check() ? Auth::user()->firstName : 'My Account' }}<i class="material-icons right">arrow_drop_down</i></a>
              </li>
            </ul>
            <ul class="side-nav" id="mobile-menu">
              <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">Shop</a></li>
              <li class="{{ set_active('wishlist') }}"><a href="{{ url('/wishlist') }}" class="">Wishlist ({{ Cart::instance('wishlist')->count(false) }})</a></li>
              <li class="{{ set_active('cart') }}"><a href="{{ url('/cart') }}" class="">Cart ({{ Cart::instance('default')->count(false) }})</a></li>

               <!-- Dropdown Trigger -->
              <li><a class="dropdown-button" href="#!" data-activates="dropdown-mobile-menu">
                {{Auth::check() ? Auth::user()->firstName : 'My Account' }}<i class="material-icons right">arrow_drop_down</i></a>
              </li>
            </ul>
          </div>
      </div>
  </nav>
  <!-- Dropdown Structure -->
  <ul id="dropdown-web-menu" class="dropdown-content">
     @guest
     <li class="{{ set_active('login') }}">
       <a href="{{ route('login') }}" class="">Login</a>
     </li>
     <li class="{{ set_active('register') }}">
       <a href="{{ route('register') }}" class="">Register</a>
     </li>
     @else
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
     <!-- Dropdown Structure -->
   <ul id="dropdown-mobile-menu" class="dropdown-content">
     <li><a href="#!">one</a></li>
     <li><a href="#!">two</a></li>
     <li class="divider"></li>
     <li><a href="#!">three</a></li>
   </ul>
</header>
