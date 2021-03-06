
@extends('layouts.main-layout')

@section('content')
  {{-- Jumbotron --}}
  <div id="jumbo">

    {{-- Diagonal border --}}
    <div class='gradient gradient1'>
      <svg viewBox='0 0 100 100' preserveAspectRatio='none' overflow="visible">
        <polygon points="0,0 100,0 0,100" class="main" fill="#00ccbc"/>
      </svg>
    </div>

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

  {{-- Elenco tipologia ristoranti --}}
  <div id="typologies" v-show='showTypologies'>
      <div v-for="(typology, i) in typologiesCity" @@click="selectTypology(typology.name)" :value='typology.name' :key='typology.name' :style="'background-color:' + typologyColors[i]">
        @{{typology.name}}
      </div>
  </div>

  {{-- elenco ristoranti per città --}}
  <div v-show='showRestaurantCity' class="bestRated">
    <h2>Ristoranti di @{{citta}}</h2>
      <div class="best">
        <div v-for='element in restaurants'>
          <div>

          </div>
          <div>
            <h4>@{{element.name}}</h4>
          </div>
        </div>
      </div>
  </div>

  {{-- elenco ritoranti per tipologie nella citta selezionata --}}
  <div v-show='showRestaurantSelected' class="bestRated">
    <h2>@{{selectedTypology}} a @{{citta}}</h2>
      <div class="best">
        <div v-for='element in restaurantsSelected'>
          <div>

          </div>
          <div>
            <h4>@{{element.name}}</h4>
          </div>
        </div>
      </div>
  </div>

  {{-- Elenco ristoranti primo piano --}}
  <div class="bestRated" v-show='showBest'>
      <h2>I Più Votati</h2>
      <div class="best">

          <div v-for="element in restaurantsVotes">
            <img :src="element.logo" alt="">
            <div>
              <h4>@{{element.name}}</h4>
              <p>@{{element.vote}}</p>
              <a @@click='GoToMenu(element.id)' >Menu</a>
            </div>
          </div>

        </div>
  </div>

@endsection
