@extends('layouts.main-layout')



    @section('content')
        <div class="login-register">
            <h1>
                Statistiche degli ordini
            </h1>
    
    
            <stats-component
                :stats='{{$stats}}'
            >
    
            </stats-component>
        </div>
    @endsection




