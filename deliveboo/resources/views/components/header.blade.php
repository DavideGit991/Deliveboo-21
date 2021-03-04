<header>
    <div>LOGO</div>

    {{-- Search --}}
    <div v-show='showName'>

        <input type="text"  v-model='inputName' @@keyup.enter='searchRestaurantName()' placeholder="Nome del ristorante">
    </div>

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
</header>
