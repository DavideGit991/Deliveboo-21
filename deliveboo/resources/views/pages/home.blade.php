  
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
      <form action="">
        <label for="citta">Scegli la tua città</label>
        <select @@change="selectCity($event)" id="citta" name="citta">
          <option  :key="city.city" :value="city.city" v-for="city in cities" >@{{city.city}}</option>
        </select>

      </form>
    </div>
    <div class="jumbo">
      <img src="img/sushi.png" alt="">  
    </div>

  </div>
      {{-- Elenco tipologia ristoranti --}}
      <div id="typologies">
        <div class="" v-for="(typology, i) in typologies" :style="'background-color:' + typology.color">
            <h3>@{{typology.name}}</h3>
        </div>
      </div>
      {{-- Elenco ristoranti primo piano --}}
      <div id="bestRated">
        <h2>I Più Votati</h2>
        <div id="restContainer">
            <div v-for="element in 10">
                <div id="img">
                </div>
                <h4>Nome</h4>
                <p>voto</p>
                <p>Tipo di cucina</p>
    
            </div>
        </div>
      </div>
@endsection