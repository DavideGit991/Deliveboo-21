@extends('layouts.main-layout')

@section('content')



    @foreach ($restaurant->dishes as $dish)

        <menu-component

            :img="'{{$dish->img}}'"
            :id="{{$dish->id}}"
            :name="'{{$dish->name}}'"
            :price="'{{$dish->price}}'"
            :availability="{{$dish->availability}}"

        ></menu-component>


    @endforeach






@endsection
