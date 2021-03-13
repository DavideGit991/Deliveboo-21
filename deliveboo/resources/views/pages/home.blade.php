
@extends('layouts.main-layout')

@section('content')
<section>

    <div id="dashboard" class="login-register">
        <div class="card">
            <div class="card-header">
                Dashboard di <b>{{Auth::user()->name}}</b>
            </div>

            {{-- <div>

                @if ($restaurant->logo)
                    <img class='rounded ' src="{{asset('storage/avatar/'.$restaurant->logo)}}" height='50'>
                @else
                    <img class='rounded' src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.A-Iz4F74iibUzjTjBpKljQHaE7%26pid%3DApi&f=1" height='50'>
                @endif
            </div> --}}

            <div class="card-body">
                @if (!$restaurant)

                <div class="resto-name">
                    <h3>
                        Non esiste nessun ristorante associato
                    </h3>
                    <a href="{{route('restaurant-create')}}">
                        <button>
                            Aggiungi ristorante
                        </button>
                    </a>
                </div>
                @else
                <div class="resto-name">
                    <h3>
                        {{$restaurant->name}}
                        <i id='icon' class="fas fa-sort-down" @@click="showDetails()"></i>
                    </h3>
                </div>
                <div  id="box-det" v-show="showDetail">
                    <div>
                        <h4>
                            Via:
                        </h4>
                        <span>{{$restaurant->address}}</span>
                    </div>
                    <div>
                        <h4>
                            Città:
                        </h4>
                        <span>{{$restaurant->city}}</span>
                    </div>

                    <div>
                        <h4>
                            Phone:
                        </h4>
                        <span>{{$restaurant->phone}}</span>
                    </div>

                    <div>
                        <h4>Immagine Ristorante:</h4>
                        {{-- upload img ristorante --}}
                        <div class="img-avatar-container">
                            <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div>
                                    <input name='iconUser' type="file" >
                                </div>

                                <button type="submit" value="Invia">Invia</button>
                            </form>

                            {{-- delete img --}}
                                <div>
                                    <a href="{{route('delete-avatar')}}">
                                        <button class="alert">
                                            Resetta Immagine
                                        </button>
                                    </a>
                                </div>

                        </div>
                    </div>
                </div>

                <div id="dashboard-buttons">
                    <a href="{{route('restaurant-edit', $restaurant->id)}}">
                        <button>
                            Modifica
                        </button>
                    </a>
                    <a href="{{route('dishes-index', $restaurant->id)}}">
                        <button>
                            Menu
                        </button>
                    </a>
                    <a  @@click="alert()">
                        <button class="alert">
                            Delete
                        </button>
                    </a>
                    <a href=" {{route('stats',$restaurant->id)}}">
                        <button>
                            Stats
                        </button>
                    </a>
                </div>

            </div>
        </div>

            {{-- componente ordine --}}
            <div class="card">

                <orders-component
                    :id="{{$restaurant->id}}"
                >
                </orders-component>

            </div>

            {{-- alert --}}
            <div class="description-overlay" v-show='showAlert' >
              <div id="card-warning">
                <div class="card-header">
                    <h4>Sei sicuro di voler eliminare il ristorante?</h4>
                </div>
                <div class="card-body">
                    <a href="{{route('restaurant-destroy', $restaurant->id)}}"><button class="alert">Conferma</button></a>
                    <a @@click="showAlert = false"><button>Annulla</button></a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
