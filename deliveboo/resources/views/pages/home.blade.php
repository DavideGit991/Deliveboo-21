
@extends('layouts.main-layout')

@section('content')

    <div id="dashboard" class="login-register">
        <div>
            <div class="card-header">
                Dashboard di <b>{{Auth::user()->name}}</b>
            </div>

            <div class="card-body">
                @if (!$restaurant)
                <h3>
                    Non esiste nessun ristorante associato
                </h3>
                <a href="{{route('restaurant-create')}}">
                    Aggiungi ristorante
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



                <div class="">
                    <a href="{{route('restaurant-edit', $restaurant->id)}}" class="button" >
                        Edit
                    </a>
                    <a href="{{route('dishes-index', $restaurant->id)}}" class="button" >
                        Menu
                    </a>
                    <a  @@click="alert()" class="button">
                        Delete
                    </a>
                    <a href="" class="button">
                        Stats
                    </a>
                </div>

                <div class="description-overlay" v-show='showAlert' >
                  <div class="description-full-screen">

                    <div class="description-wrapper">

                      Sei sicuro di voler eliminare il ristorante?

                      <br>

                      <a href="{{route('restaurant-destroy', $restaurant->id)}}" class="button">conferma</a>
                      <a @@click="showAlert = false"> Annulla</a>

                    </div>
                  </div>
                </div>

                @endif
            </div>
        </div>
    </div>

@endsection
