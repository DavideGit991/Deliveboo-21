@extends('layouts.main-layout')

@section('content')

<div class="container p-2">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard di <b>{{Auth::user()->name}}</b>
                </div>

                <div class="m-3 d-flex flex-column " >
                    @if (!$restaurant)
                        <h4 class="mt-2 pb-2 border-bottom border-danger">
                            non esiste nessun ristorante associato
                        </h4>
                        <a href="{{route('restaurant-create')}}" class="mt-2 w-50 btn btn-primary" >
                            create
                        </a>
                    @else

                        <div class="w-40 border-bottom border-danger d-flex align-items-center">
                            <h4 class="mr-3 m-0">
                                {{$restaurant->name}}
                            </h4>
                            <i id='icon' class="fas fa-sort-down" onclick="show()"></i>
                        </div>

                        <div  id="box-det" class=" my-2 p-3 border border-success rounded d-none flex-column justify-content-center">
                            <div class="m-1 d-flex align-items-center ">
                                <h4 class="m-0 mr-2">
                                    Via:
                                </h4>
                                <span>{{$restaurant->address}}</span>
                            </div>
                            <div class="m-1 d-flex align-items-center ">
                                <h4 class="m-0 mr-2">
                                    Città:
                                </h4>
                                <span>{{$restaurant->city}}</span>
                            </div>
                            <div class="m-1 d-flex align-items-center ">

                                <h4 class="m-0 mr-2">
                                    Piva:
                                </h4>
                                <span>{{$restaurant->piva}}</span>
                            </div>
                            <div class="m-1 d-flex align-items-center">
                                <h4 class="m-0 mr-2">
                                    Phone:
                                </h4>
                                <span>{{$restaurant->phone}}</span>

                            </div>

                        </div>


                        <div class="button my-3 d-flex justify-content-around">
                            <a
                                href="{{route('restaurant-edit', $restaurant->id)}}" class="btn btn-primary m-1" >
                                Edit
                            </a>
                            <a
                                href="{{route('dishes-index', $restaurant->id)}}" class="btn btn-primary m-1" >
                                Menu
                            </a>
                            <a
                                href="{{route('restaurant-destroy', $restaurant->id)}}" class="btn btn-danger m-1" >
                                Delete
                            </a>

                            <a href="" class=" btn btn-primary m-1">
                                Stats
                            </a>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function show() {
        const element = document.getElementById("box-det");
        const icon = document.getElementById('icon');
        element.classList.toggle("d-flex");
        if (icon.classList.contains('fa-sort-down')) {
            icon.classList.remove('fa-sort-down');
            icon.classList.add('fa-sort-up');
        } else {
            icon.classList.remove('fa-sort-up');
            icon.classList.add('fa-sort-down');
        }

}


</script>

@endsection
