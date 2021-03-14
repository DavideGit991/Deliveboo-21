@extends('layouts.main-layout')

@section('content')

    <div class="login-register create">

        <div class="card">
            <div class="card-header">
                Nuovo Piatto
            </div>

            <div class="card-body">
                <form action="{{route('dish-store')}}" method="post" enctype="multipart/form-data">
                    @method('post')
                    @csrf

                    <div>
                        <label for="name">Nome Piatto: </label>
                        <input class="form-control form" type="text" name="name" minlength="5" maxlength="60">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="description">Descrizione: </label>
                        <input class="form-control form" type="text" name="description" minlength="5" >
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="price">Prezzo: </label>
                        <input class="form-control form" type="number" step="0.01" name="price">
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="image">Immagine: </label>
                        <input class="form-control form image" type="file" name='iconUser'  >
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
