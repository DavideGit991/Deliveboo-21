  
@extends('layouts.main-layout')

@section('content')
  {{-- Jumbotron --}}
  <div id="jumbo">

  </div>
      {{-- Elenco tipologia ristoranti --}}
      <div id="typologies">
        <div class="" v-for="(typology, i) in typologies" >
            <h3></h3>
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