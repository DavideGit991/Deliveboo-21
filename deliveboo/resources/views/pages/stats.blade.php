@extends('layouts.main-layout')
@if (Auth::user($id))


    @section('content')
        <h1>
            pagina statistiche
        </h1>


        <stats-component
            :stats='{{$stats}}'
        >

        </stats-component>



    @endsection
@else
    <h1>Non sei nela tua pagina biricchino</h1>
@endif
