@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Menù di: {{$restaurantId-> name}}</h1>
                    
                </div>

                <form action="{{route('dishes-create')}}" method="post">
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
                    <br><br>
                    <input type="submit" value="SALVA">
                
                </form>
                <div class="col-md-8">
                    @foreach ($dishes as $dish)
                        
                        <div class="card my-5">
                            <div><span>NAME:</span> {{$dish-> name}}</div>
                            <div><span>DESCRIPTION:</span> {{$dish-> description}}</div>
                            <div><span>PRICE:</span> {{$dish-> price}} €</div>
                        </div>
                            
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection