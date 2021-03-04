
@extends('layouts.main-layout')

@section('content')

        {{-- Diagonal border --}}
        <div class='gradient gradient1'>
        <svg viewBox='0 0 100 100' preserveAspectRatio='none' overflow="visible">
            <polygon points="0,0 100,0 0,100" class="main" fill="#00ccbc"/>
        </svg>
        </div>
<div id="dashboard" class="login-register">

        <div class="jumbo">
        <h1>Ristorante a casa tua.</h1>

            <label for="citta">Scegli la tua città</label>
            <select @@change="selectCity($event)" id="citta" name="citta">
                <option disable selected>Seleziona Città</option>
            <option  :key="city.city" :value="city.city" v-for="city in cities" >@{{city.city}}</option>
            </select>

        </div>
        <div class="jumbo">
            <img src="img/sushi.png" alt="">
        </div>
    </div>
    
            <div>
                <div class="card-header">
                    Dashboard di <b>{{Auth::user()->name}}</b>
                </div>

      {{-- Elenco ristoranti primo piano --}}
        <div id="bestRated" v-show='showBest'>
            <h2>I Più Votati</h2>
            <div id="restContainer">
                <div class='d-flex'v-for="element in restaurantsVotes">
                    <img :src="element.logo" alt=""   >
                    <h4>@{{element.name}}</h4>
                    <p>@{{element.vote}}</p>
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
                                <i id='icon' class="fas fa-sort-down" onclick="show()"></i>
                            </h3>
                        </div>

                        <div  id="box-det" class="hide">
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


                        <div class="button my-3 d-flex justify-content-around">
                            <a
                                href="{{route('restaurant-edit', $restaurant->id)}}" class="button" >
                                Edit
                            </a>
                            <a
                                href="{{route('dishes-index', $restaurant->id)}}" class="button" >
                                Menu
                            </a>
                            <a
                                href="{{route('restaurant-destroy', $restaurant->id)}}" class="button" >
                                Delete
                            </a>

                            <a href="" class="button">
                                Stats
                            </a>
                        </div>

                    @endif
                </div>
            </div>
        </div>

        {{-- Elenco tipologia ristoranti --}}
        <div id="typologies" v-show='showTypologies'>
            <div v-for="typology in typologiesCity">
                <button  @@click="selectTypology(typology.name)" :value='typology.name' :key='typology.name' >
                    @{{typology.name}}
                </button>
            </div>
        </div>

        {{-- elenco ristoranti per città --}}
        <div v-show='showRestaurantCity'>
            <div class="">
                <h2>Ristoranti di @{{citta}}</h2>
            </div>
            <div v-for='element in restaurants' class="box-restaurant">
                <h1>@{{element.name}}</h1>
            </div>
        </div>

        {{-- elenco ritoranti per tipologie nella citta selezionata --}}
        <div v-show='showRestaurantSelected'>
            <div>
                <h2>@{{selectedTypology}} a @{{citta}}</h2>
            </div>
            <div v-for='element in restaurantsSelected'>
                <h5>@{{element.name}}</h5>
            </div>
        </div>


   
</div>

<script>
    function show() {
        const element = document.getElementById("box-det");
        const icon = document.getElementById('icon');
        element.classList.toggle("hide");
        if (icon.classList.contains('fa-sort-down')) {
            icon.classList.remove('fa-sort-down');
            icon.classList.add('fa-sort-up');
        } else {
            icon.classList.remove('fa-sort-up');
            icon.classList.add('fa-sort-down');
        }

}


</script>

@endsection
