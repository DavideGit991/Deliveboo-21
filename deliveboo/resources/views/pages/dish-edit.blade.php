@extends('layouts.main-layout')
@section('content')
    <div class="login-register edit">
        <div class="card">
            <div class="card-header">
                Modifica le informazioni del piatto
            </div>

            <div class="card-body">
                <form action="{{route('dish-update', $dish-> id)}}" method="post" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div>
                        <label for="name">Nome: </label>
                        <input type="text" name="name" value="{{$dish-> name}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="description">Descrizione: </label>
                        <input type="text" name="description" value="{{$dish-> description}}">
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="price">Prezzo: </label>
                        <input type="number" step="0.01" name="price" value="{{$dish-> price}}">
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
                            @if ($dish-> availability==1)
                                <option selected value="1">Disponibile</option>
                                <option value="0">Non Disponibile</option>
                            @else
                                <option value="1">Disponibile</option>
                                <option selected value="0">Non Disponibile</option>
                            @endif
                        </select>
                    </div>



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
