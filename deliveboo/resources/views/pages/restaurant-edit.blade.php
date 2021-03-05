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
                                <input type="text" class="form-control" name="name" value="{{$restaurant->name}}" required>
                            </div>
                            
                            <div class="col">
                                <label for="name">Sito internet</label>
                                <input type="text" class="form-control" name="url" value="{{$restaurant->url}}">
                            </div>
                            
                        </div >
                        <div class="row d-flex m-2">
                            <div class="col">
                                <label for="name">Indirizzo*</label>
                                <input type="text" class="form-control" name="address" value="{{$restaurant->address}}" required>
                            </div>
                            <div class="col">
                                <label for="name">Città*</label>
                                <input type="text" class="form-control" name="city" value="{{$restaurant->city}}" required>
                            </div>
                            <div class="col">
                                <label for="name">Numero di telefono*</label>
                                <input type="text" class="form-control" name="phone" value="{{$restaurant->phone}}" required>
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
        
            
            
        