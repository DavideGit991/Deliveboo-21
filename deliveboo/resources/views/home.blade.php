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


                </div>
                <div class="ml-3">

                    @if (!$restaurant)
                        <h4>
                            non esiste nessun ristorante
                        </h4>
                        <a href="{{route('restaurant-create')}}" class="btn btn-primary" >
                            create
                        </a>
                    @else
                        <h1>il tuo ristorante e':</h1>
                        <h4 class="ml-2">
                                {{$restaurant->name}}
                        </h4 class="ml-2">
                        <a href="{{route('restaurant-edit', $restaurant->id)}}" class="btn btn-primary m-1" >
                            Edit
                        </a>
                        <a href="{{route('restaurant-destroy', $restaurant->id)}}" class="btn btn-danger m-1" >
                            Delete
                        </a>

                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>




</script>
