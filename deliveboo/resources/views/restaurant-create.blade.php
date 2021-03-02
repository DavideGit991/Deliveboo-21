@extends('layouts.app')



@section('content')

        <form action="{{route('restaurant-store')}}" method="post">
            @csrf
            @method('post')
            <div class="container d-flex flex-column">

                <div class="row m-2">
                    <div class="col">
                        <input type="text" class="form-control" name="name" placeholder="nome ristorante "required maxlength="40" >
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="piva" placeholder="partita IVA"required minlength="10" maxlength="13">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="url" placeholder="sito internet example: www.exacasample.it">
                    </div>

                </div>

                <div class="row m-2" >
                    <div class="col">
                        <input type="text" class="form-control" name="address" placeholder="indirizzo"required >
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="city" placeholder="città"required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="phone" placeholder="numero di telefono"required >
                    </div>

                </div >

                <input type="text" hidden name="user_id" value="{{Auth::user()->id}}">

                <div class='row ml-4'>
                    <button type="submit" class="btn btn-primary">
                        save
                    </button>
                </div>
            </div>
        </form>
@endsection






