@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Menù di: {{$restaurant-> name}}</h1>
                    <br>
                    <h2>Crete new dish</h2>
                    <a href="{{route('dish-create', $restaurant-> id)}}"><button class="btn btn-primary">CREATE</button></a>
                    
                </div>

               
                <div class="col-md-8">
                    @foreach ($dishes as $dish)

                        @if ($dish-> availability==0)
                            <div class="card my-5">
                                <div><span>NAME:</span> {{$dish-> name}}</div>
                                <span>non disponibile</span>
                                <a href="{{route('dish-edit', $dish-> id)}}"> <button class="btn btn-primary">EDIT</button> </a>
                            </div>
                        @else
                            <div class="card my-5">
                                <div><span>NAME:</span> {{$dish-> name}}</div>
                                <div><span>DESCRIPTION:</span> {{$dish-> description}}</div>
                                <div><span>PRICE:</span> {{$dish-> price}} €</div>
                                <a href="{{route('dish-edit', $dish-> id)}}"><button class="btn btn-primary">EDITs</button></a>
                                <a href="{{route('dish-delete', $dish-> id)}}"><button class="btn btn-danger">DELETE</button></a>
                            </div>
                        @endif
                        
                            
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection