@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}


                </div>
                <div class="m-3">
                    {{-- @dd($restaurant); --}}
                    @if (!$restaurant)
                        <h4>
                            non esiste nessun ristorante
                        </h4>
                    @else
                        <h1>il tuo ristorante e':</h1>
                        <li>
                            {{$restaurant->name}}
                        </li>
                        <a href="{{route('dishes-index', $restaurant -> id) }}">Menu del ristorante</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
