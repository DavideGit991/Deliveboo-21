<header>
    <div>
        <a id="logo" href="{{ url('/') }}">Deliveboo</a>
    </div>

    {{-- Search --}}
    <div v-show='showName' id="search">
        <i class="fas fa-search"></i>
        <input type="text"  v-model='inputName' @@keyup.enter='searchRestaurantName()' placeholder="Nome del ristorante">
    </div>

    {{-- Login Register --}}
        
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
