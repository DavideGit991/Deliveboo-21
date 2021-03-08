
@extends('layouts.main-layout')

@section('content')

    <div id="dashboard" class="login-register">
        <div class="card">
            <div class="card-header">
                Dashboard di <b>{{Auth::user()->name}}</b>
            </div>

            <div class="card-body">
                @if (!$restaurant)
                <h3>
                    Non esiste nessun ristorante associato
                </h3>
                <a href="{{route('restaurant-create')}}">
                    <button>
                        Aggiungi ristorante 
                    </button>
                </a>
                @else
                <div>
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
                            Piva:
                        </h4>
                        <span>{{$restaurant->piva}}</span>
                    </div>
                    <div>
                        <h4>
                            Phone:
                        </h4>
                        <span>{{$restaurant->phone}}</span>
                    </div>
                </div>



                <div id="dashboard-buttons">
                    <a href="{{route('restaurant-edit', $restaurant->id)}}">
                        <button>
                            Edit  
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
                    <a href="">
                        <button>
                            Stats  
                        </button>
                    </a>
                </div>

                <div class="description-overlay" v-show='showAlert' >
                  <div class="description-full-screen">

                    <div class="description-wrapper">

                      Sei sicuro di voler eliminare il ristorante?

                      <br>

                      <a href="{{route('restaurant-destroy', $restaurant->id)}}" class="button alert">conferma</a>
                      <a @@click="showAlert = false" class="button"> Annulla</a>

                    </div>
                  </div>
                </div>

                @endif
            </div>
        </div>
    </div>

@endsection
