@extends('layouts.main-layout')
@section('content')
<div id="dishes-index" class="login-register">
    
    <div class="card">
        <div class="card-header">
            Menù di: {{$restaurant-> name}} 
        </div>

        <div>
            <div class="add">
                <a href="{{route('dish-create', $restaurant-> id)}}">Aggiungi un piatto<i class="fas fa-plus"></i></a>
            </div>
            <div class="dish-container">
                @foreach ($dishes as $dish) 
                <div class="dish">
                    @if ($dish-> availability==0)
                        <div class="card-header expired">
                            {{$dish-> name}}
                        </div>
                        <div>
                            <div>
                                <span>Non Disponibile</span> 
                            </div>
                            <a href="{{route('dish-edit', $dish-> id)}}"> <button class="btn btn-primary">Modifica</button> </a>
                        </div>
                    @else
        
                        <div class="card-header">
                            {{$dish-> name}}
                        </div>
                        <div>
                            <div>
                                <span>Descrizione: </span> {{$dish-> description}} 
                            </div>
                            <div>
                                <span>Prezzo: </span> {{$dish-> price}} € 
                            </div>
                            <a href="{{route('dish-edit', $dish-> id)}}"><button>Modifica</button></a>
                            <a href="{{route('dish-delete', $dish-> id)}}"><button class="alert">Elimina</button></a>
                        </div>
                    @endif        
                </div>
                @endforeach
            </div>
        </div>  
    </div>    
</div>
@endsection