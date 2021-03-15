@extends('layouts.main-layout')

@section('content')

    <div class="login-register create">
        <div class="card">
            <div class="card-header">
                Nuovo Ristorante
            </div>


            <div class="card-body">

                <form action="{{route('restaurant-store')}}" method="post">
                    @csrf
                    @method('post')

                    <div>
                        <label for="name">Nome Ristorante*</label>
                        <input type="text" class="form-control form" name="name" required maxlength="40" minlength="5">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="address">Indirizzo*</label>
                        <input type="text" class="form-control form" name="address" required maxlength="100" minlength="5">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="city">Città*</label>
                        <input type="text" class="form-control form" name="city" required maxlength="40" minlength="3">
                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="phone">Telefono*</label>
                        <input type="tel" class="form-control form" name="phone" required maxlength="15" minlength="10">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="typologies[]">Tipologie*</label>

                        <div class="check-container">
                            @foreach ($typologies as $typology)
                            <p>
                                <input type="checkbox" class="form-control" name="typologies[]" value="{{$typology->id}}">{{$typology->name}}
                            </p>
                            @endforeach
                            @error('typologies')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input type="text" hidden name="user_id" value="{{Auth::user()->id}}">

                    <div>

                        <button type="submit" class="btn btn-primary">
                            Salva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
