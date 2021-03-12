@extends('layouts.main-layout')

@section('content')

    <div class="login-register create">

        <div class="card">
            <div class="card-header">
                Nuovo Piatto
            </div>

            <div class="card-body">
                <form action="{{route('dish-store')}}" method="post">
                    @method('post')
                    @csrf

                    <div>
                        <label for="name">Nome Piatto: </label>
                        <input type="text" name="name" required>
                    </div>
                    <div>
                        <label for="description">Descrizione: </label>
                        <input type="text" name="description" minlength="5" required >
                    </div>
                    <div>
                        <label for="price">Prezzo: </label>
                        <input type="number" name="price" required>
                    </div>

                    <div class="select">
                        <label for="availability">Disponibilità: </label>
                        <select name="availability">
                            <option value="1">Disponibile</option>
                            <option value="0">Non Disponibile</option>
                        </select>
                    </div>

                    <input type="text" hidden name="restaurant_id" value="{{$restaurant-> id}}">

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
