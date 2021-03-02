@extends('layouts.app')

<div class="container">

    @section('content')

        <form action="{{route('restaurant-store')}}" method="post">
            @csrf
            @method('post')

            <div class="row m-2">
                <div class="col">
                    <input type="text" class="form-control" name="name" placeholder="nome ristorante">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="url" placeholder="sito internet example: www.exacasample.it">
                </div>

            </div>

            <div class="row m-2" >
                <div class="col-6">
                    <input type="text" class="form-control" name="address" placeholder="indirizzo">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="city" placeholder="città">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="phone" placeholder="numero di telefono">
                </div>

            </div >

            <input type="text" hidden name="user_id" value="{{Auth::user()->id}}">

            <div class='row ml-4'>
                <button type="submit" class="btn btn-primary">
                    save
                </button>
            </div>
        </form>
    @endsection
</div>





