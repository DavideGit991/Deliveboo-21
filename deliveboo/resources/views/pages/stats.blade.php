@extends('layouts.main-layout')



    @section('content')
    
        <div class="login-register">
            <h1>
                Statistiche degli ordini anno 2021
            </h1>

            {{-- @dd($stats); --}}
            <stats-component
                :stats='{{$stats}}'
            >

            </stats-component>
        </div>
    @endsection




