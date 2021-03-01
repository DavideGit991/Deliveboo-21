<header>
    <div>LOGO</div>
    {{-- Search --}}
    <div id="search">
        <div>
            <i class="fas fa-search"></i>
        </div>
        <form action="">
            <input type="text" placeholder="Piatti, Ristoranti o tipi di cucina">
        </form>
    </div>

    {{-- Login Register --}}
        @if (Route::has('login'))
            <div id="links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrati</a>
                    @endif
                @endauth
            </div>
        @endif
</header>