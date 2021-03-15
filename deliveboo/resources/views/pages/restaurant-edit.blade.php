@extends('layouts.main-layout')



@section('content')

    <div class="login-register edit">
        <div class="card">
            <div class="card-header">
                Modifica le informazioni del tuo ristorate
            </div>

            <div class="card-body">

                <form action="{{route('restaurant-update',$restaurant->id)}}" method="post">
                    @csrf
                    @method('post')
                    <div class="container p-2 border d-flex flex-column">
                        <div class="row d-flex m-2">
                            <div class="col">
                                <label for="name">Nome*</label>
                                <input type="text" class="form-control" name="name" value="{{$restaurant->name}}" required maxlength="40" minlength="5">
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div >
                        <div class="row d-flex m-2">
                            <div class="col">
                                <label for="address">Indirizzo*</label>
                                <input type="text" class="form-control" name="address" value="{{$restaurant->address}}" required maxlength="100" minlength="5">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="city">Città*</label>
                                <input type="text" class="form-control" name="city" value="{{$restaurant->city}}" required maxlength="40" minlength="5">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="phone">Numero di telefono*</label>
                                <input type="text" class="form-control" name="phone" value="{{$restaurant->phone}}" required maxlength="15" minlength="10">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div >

                        <input type="text" hidden name="user_id" value="{{Auth::user()->id}}">
                        <div class='row ml-4'>
                            <button type="submit">
                                Salva
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
