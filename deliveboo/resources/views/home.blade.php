@extends('layouts.app')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard di {{Auth::user()->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div class="ml-3 d-flex flex-column justify-content-around align-items-center" >
                    @if (!$restaurant)
                        <h4>
                            non esiste nessun ristorante
                        </h4>
                        <a href="{{route('restaurant-create')}}" class="btn btn-primary" >
                            create
                        </a>
                    @else

                        <div class="w-40 border-bottom border-danger d-flex">
                            <h4 class="mr-3">
                                {{$restaurant->name}}
                            </h4>
                             <i class="fas fa-sort-down h-1" onclick="show()"></i>
                        </div>

                        <div  id="box-det" class=" my-2 p-3 border border-success rounded d-none flex-column justify-content-center">
                            <h2>
                                Via: {{$restaurant->address}}
                            </h2>
                            <h2>

                                Piva: {{$restaurant->piva}}
                            </h2>
                            <h2>

                                Phone: {{$restaurant->phone}}
                            </h2>

                        </div>


                        <div class="button w-50 d-flex justify-content-around">

                            <a
                                href="{{route('restaurant-edit', $restaurant->id)}}" class=" w-30 btn btn-primary m-1" >
                                Edit
                            </a>
                            <a
                                href="{{route('restaurant-destroy', $restaurant->id)}}" class=" w-30 btn btn-danger m-1" >
                                Delete
                            </a>

                            <a href="" class=" w-30 btn btn-primary m-1">
                                Stats
                            </a>
                        </div>

                    @endif






                </div>
            </div>
        </div>
     </div>

<script>
    function show() {
        var element = document.getElementById("box-det");
        element.classList.toggle("d-flex");
}


</script>

@endsection
