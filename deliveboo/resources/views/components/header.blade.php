<header>
    <div id="logo">
        <a href="{{ url('/') }}">Deliveb<i class="fas fa-cookie-bite"></i>o</a>
    </div>

    {{-- Search --}}
  
        @if (Route::currentRouteName()  === 'main')
            <div v-show='showName' id="search">
                <i class="fas fa-search"></i>
                <input type="text"  v-model='inputName' @@keyup.enter='searchRestaurantName()' placeholder="Nome del ristorante">
            </div>    
        @endif

    {{-- Login Register --}}
        
    <div>
        <div id="burger-links">
            <i class="fas fa-hamburger" v-show="openMenu" @@click="shMenu"></i>
            <i class="fas fa-times" v-show="menu" @@click="shMenu"></i>
        </div>
        <div id="links">
            @guest
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Registrati</a>
                @endif
                @else
                    <a href="{{ route('home') }}">
                        Dashboard
                    </a>
    
                    <a id="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
        
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>     
            @endguest
        </div>
    </div>
    {{-- Burger menu --}}
    <div class="burger-menu" v-show="menu">
        @guest
        <a href="{{ route('login') }}">{{ __('Login') }}</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}">Registrati</a>
        @endif
        @else
            <a href="{{ route('home') }}">
                Dashboard
            </a>
        
            <a id="log-out" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            
            <form id="logout-f" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>     
        @endguest
    </div>
</header>
