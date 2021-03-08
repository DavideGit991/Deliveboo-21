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
                        <input type="text" class="form-control" name="name" required maxlength="40" >
                    </div>
                    <div>
                        <label for="url">Sito internet</label>
                        <input type="text" class="form-control" name="url">
                    </div>
                    <div>
                        <label for="address">Indirizzo*</label>
                        <input type="text" class="form-control" name="address" required >
                    </div>
                    <div>
                        <label for="city">Città*</label>
                        <input type="text" class="form-control" name="city" required>
                    </div>
                    <div>
                        <label for="phone">Telefono*</label>
                        <input type="tel" class="form-control" name="phone" required>
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


        



