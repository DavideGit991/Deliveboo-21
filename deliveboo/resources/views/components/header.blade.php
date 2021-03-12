<header>
    <div id="logo">
        <a href="{{ url('/') }}">Deliveb<i class="fas fa-cookie-bite"></i>o</a>
    </div>

    {{-- Search --}}
  
        @if (Route::currentRouteName()  === 'main')
        <div class="search-bar">
            <div v-show='showName' id="search">
                <i class="fas fa-search"></i>
                <input type="text"  v-model='inputName' @@keyup='searchRestaurantName()' placeholder="Nome del ristorante">
            </div>    
            {{-- Risultato ricerca --}}
            <div class="search-results" v-show="showSearchResult">
                <div v-if="searchResults.length===0" class="noRes">
                    <p>Nessun risultato per '@{{ inputName }}'</p>
                </div>
                <div v-for="element in searchResults" @@click='GoToMenu(element.id)'>
                    <div class="results-name">
                        <h4>@{{element.name}}</h4>
                        <p class="stars"><i class="fas fa-star" v-for="star in element.vote "></i><i class="far fa-star" v-for="star in 5 - (element.vote)"></i></p>
                    </div>
                </div>
            </div>
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
