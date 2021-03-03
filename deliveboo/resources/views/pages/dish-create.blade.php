@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{route('dish-store')}}" method="post">
                    <h2>Add new dish</h2>
                    @method('post')
                    @csrf


                    <label for="name">Name: </label>
                    <input type="text" name="name">
                    <br>
                    <label for="description">Description: </label>
                    <input type="text" name="description">
                    <br>
                    <label for="price">Price: </label>
                    <input type="text" name="price">
                    <br>
                    <label for="availability">Availability: </label>
                    <select name="availability">
                        <option value="1">Disponibile</option>
                        <option value="0">Non disponibile</option>
                    </select>
                    <br>
                    <label for="img">Img: </label>
                    <input type="text" name="img">

                    <input type="text" hidden name="restaurant_id" value="{{$restaurant-> id}}">

                    <br><br>
                    <input type="submit" value="SALVA">
                
                </form>
               
            </div>
        </div>
    </div>
</div>
@endsection