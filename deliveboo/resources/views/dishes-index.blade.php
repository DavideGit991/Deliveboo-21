@extends('layouts.app')
@section('content')
    {{-- <post 
        :creator="true"
    ></post> --}}
    @foreach ($dishes as $dish)
    
        
        <dish-component
            :name="'{{$dish-> name}}'"
            :description="'{{$dish-> description}}'"
            :price="{{$dish-> price}}"
            :availability="{{$dish-> availability}}"
            :img="'{{$dish-> img}}'"
            :id="{{$dish-> id}}"
        ></dish-component>
    
    @endforeach

@endsection