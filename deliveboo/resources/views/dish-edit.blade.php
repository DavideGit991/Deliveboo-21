@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Dish</h1>
                    
                </div>

                <form action="{{route('dish-update', $dish-> id)}}" method="post">
                    @method('post')
                    @csrf

                    

                    <label for="name">Name: </label>
                    <input type="text" name="name" value="{{$dish-> name}}">
                    <br>
                    <label for="description">Description: </label>
                    <input type="text" name="description" value="{{$dish-> description}}">
                    <br>
                    <label for="price">Price: </label>
                    <input type="text" name="price" value="{{$dish-> price}}">
                    <br><br>
                    <label for="availability">Availability: </label>
                    <select name="availability">
                        @if ($dish-> availability==1)
                            <option selected value="1">Disponibile</option>
                            <option value="0">Non disponibile</option>
                        @else
                        <option value="1">Disponibile</option>
                        <option selected value="0">Non disponibile</option>
                        @endif
                        
                    </select>
                    {{-- <input type="text" name="availability" value="{{$dish-> availability}}"> --}}
                    <br><br>
                    <label for="img">Img: </label>
                    <input type="text" name="img" value="{{$dish-> img}}">

                    <input type="text" hidden name="restaurant_id" value="{{$dish-> restaurant_id}}">

                    <br><br>
                    <input type="submit" value="SAVE">
                
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection