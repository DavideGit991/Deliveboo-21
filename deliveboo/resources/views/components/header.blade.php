<header>
    <div>LOGO</div>

    {{-- Search --}}
    <div v-show='showName'>

        <input type="text"  v-model='inputName' @@keyup.enter='searchRestaurantName()' placeholder="Nome del ristorante">
    </div>
    @guest
        <div>
            <a href="{{ url('/') }}">Deliveboo</a>
        </div>
    {{-- Search --}}
        <div id="search">
            <div>
                <i class="fas fa-search"></i>
            </div>
            <form action="">
                <input type="text" placeholder="Piatti, Ristoranti o tipi di cucina">
            </form>
        </div>
    @endguest

    {{-- Login Register --}}
        @if (Route::has('login'))
            <div id="links">
                @auth
                    <a href="{{ url('/home') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrati</a>
                    @endif
                @endauth
            </div>
        @endif
    <div id="links">
        @guest
            
            <a href="{{ route('login') }}">{{ __('Login') }}</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Registrati</a>
            @endif
            @else
                <a id="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
    
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                
        @endguest
    </div>
</header>
