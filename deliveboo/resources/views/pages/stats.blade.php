@extends('layouts.main-layout')



    @section('content')
        <h1>
            pagina statistiche
        </h1>


        <stats-component
            :stats='{{$stats}}'
        >

        </stats-component>

        @endsection



