@extends('layouts.main-layout')

@section('content')

<div id="dashboard" class="login-register">

    
            <div>
                <div class="card-header">
                    Dashboard di <b>{{Auth::user()->name}}</b>
                </div>

                <div class="card-body">
                    @if (!$restaurant)
                        <h3>
                            Non esiste nessun ristorante associato
                        </h3>
                        <a href="{{route('restaurant-create')}}">
                            Aggiungi ristorante
                        </a>
                    @else

                        <div>
                            <h3>
                                {{$restaurant->name}}
                                <i id='icon' class="fas fa-sort-down" onclick="show()"></i>
                            </h3>
                        </div>

                        <div  id="box-det" class="hide">
                            <div>
                                <h4>
                                    Via:
                                </h4>
                                <span>{{$restaurant->address}}</span>
                            </div>
                            <div>
                                <h4>
                                    Città:
                                </h4>
                                <span>{{$restaurant->city}}</span>
                            </div>
                            <div>

                                <h4>
                                    Piva:
                                </h4>
                                <span>{{$restaurant->piva}}</span>
                            </div>
                            <div>
                                <h4>
                                    Phone:
                                </h4>
                                <span>{{$restaurant->phone}}</span>

                            </div>

                        </div>


                        <div class="button my-3 d-flex justify-content-around">
                            <a
                                href="{{route('restaurant-edit', $restaurant->id)}}" class="button" >
                                Edit
                            </a>
                            <a
                                href="{{route('dishes-index', $restaurant->id)}}" class="button" >
                                Menu
                            </a>
                            <a
                                href="{{route('restaurant-destroy', $restaurant->id)}}" class="button" >
                                Delete
                            </a>

                            <a href="" class="button">
                                Stats
                            </a>
                        </div>

                    @endif
                </div>
            </div>
   
</div>

<script>
    function show() {
        const element = document.getElementById("box-det");
        const icon = document.getElementById('icon');
        element.classList.toggle("hide");
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
