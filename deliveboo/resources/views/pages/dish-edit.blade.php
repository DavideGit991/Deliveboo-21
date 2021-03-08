@extends('layouts.main-layout')
@section('content')
    <div class="login-register edit">
        <div class="card">
            <div class="card-header">
                Modifica le informazioni del piatto  
            </div>

            <div class="card-body">
                <form action="{{route('dish-update', $dish-> id)}}" method="post">
                    @method('post')
                    @csrf
                    <div>
                        <label for="name">Nome: </label>
                        <input type="text" name="name" value="{{$dish-> name}}" required>
                    </div>
                    <div>
                        <label for="description">Descrizione: </label>
                        <input type="text" name="description" value="{{$dish-> description}}" required minlength="5">
                    </div>
                    <div>
                        <label for="price">Prezzo: </label>
                        <input type="text" name="price" value="{{$dish-> price}}" required>
                    </div>
                    <div>
                        <label for="img">Immagine: </label>
                        <input type="text" name="img" value="{{$dish-> img}}">

                    </div>
                    <div class="select">
                        <label for="availability">Disponibilità: </label>
                        <select name="availability">
                            @if ($dish-> availability==1)
                                <option selected value="1">Disponibile</option>
                                <option value="0">Non Disponibile</option>
                            @else
                                <option value="1">Disponibile</option>
                                <option selected value="0">Non Disponibile</option>
                            @endif
                        </select>
                    </div>
                    {{-- <input type="text" name="availability" value="{{$dish-> availability}}"> --}}
                    
                    <input type="text" hidden name="restaurant_id" value="{{$dish-> restaurant_id}}">
                    <div>
                        <button type="submit">
                            Salva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection