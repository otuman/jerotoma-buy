     <nav>
       <div class="container">
         <div class="nav-wrapper">

           <div class="row">
              <div class="col m6">
                   <a href="{{route('/')}}" class="brand-logo">Logo</a>
                   <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
                  <ul id="nav-mobile-left" class="right hide-on-med-and-down">
                    <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">Order Tracker</a></li>
                    <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">My Orders</a></li>
                    <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">Shop now</a></li>
                  </ul>
              </div>
              <div class="col m6">
                 <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href=""><span class="new badge">4</span><i class="small material-icons left" style="margin-right:0px;">notifications</i></a></li>
                    <!-- Dropdown Trigger -->
                   <li><a class="dropdown-button" href="#!" data-beloworigin="true" data-constrainwidth='false' data-activates="dropdown-web-menu">
                     {{Auth::check() ? Auth::user()->firstName : 'My Account' }}<i class="material-icons right">arrow_drop_down</i></a>
                   </li>
                 </ul>
              </div>
           </div>
            <ul class="side-nav" id="mobile-menu">
              <!-- Dropdown Trigger -->
              <li><a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="dropdown-mobile-menu">
                 {{Auth::check() ? Auth::user()->firstName : 'My Account' }}<i class="material-icons right">arrow_drop_down</i></a>
              </li>
              <li class="{{ set_active('shop') }}"><a href="{{route('shop')}}">Shop</a></li>
              <li class="{{ set_active('wishlist') }}"><a href="{{ url('/wishlist') }}" class="">Wishlist ({{ Cart::instance('wishlist')->count(false) }})</a></li>
              <li class="{{ set_active('cart') }}"><a href="{{ url('/cart') }}" class="">Cart ({{ Cart::instance('default')->count(false) }})</a></li>
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
       <li class="divider"></li>
       <li><a href="{{url('dashboard')}}">My Dashboard</a></li>
       <li><a href="#!">Notifications</a></li>
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


 @section('extra-js')
   <script>
    $(document).ready(function(){
           $('.dropdown-button').dropdown();
        });
   </script>

 @endsection
