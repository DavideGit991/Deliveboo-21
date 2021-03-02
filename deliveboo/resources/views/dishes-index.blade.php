@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Menù di: {{$restaurantId-> name}}</h1>
                    
                </div>

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
                    <input type="text" name="availability">
                    <br>
                    <label for="img">Img: </label>
                    <input type="text" name="img">

                    <input type="text" hidden name="restaurant_id" value="{{$restaurantId-> id}}">

                    <br><br>
                    <input type="submit" value="SALVA">
                
                </form>
                <div class="col-md-8">
                    @foreach ($dishes as $dish)
                        
                        <div class="card my-5">
                            <div><span>NAME:</span> {{$dish-> name}}</div>
                            <div><span>DESCRIPTION:</span> {{$dish-> description}}</div>
                            <div><span>PRICE:</span> {{$dish-> price}} €</div>
                            <a href="{{route('dish-edit', $dish-> id)}}">EDIT</a>
                            <a href="{{route('dish-delete', $dish-> id)}}">delete</a>
                        </div>
                            
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection