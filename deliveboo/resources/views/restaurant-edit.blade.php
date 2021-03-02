@extends('layouts.app')

@section('content')
<div class="container">

    @section('content')

        <form action="{{route('restaurant-update',$restaurant->id)}}" method="post">
            @csrf
            @method('post')

            <div class="row m-2">
                <div class="col">
                    <input type="text" class="form-control" name="name" value="{{$restaurant->name}}" >
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="url" value="{{$restaurant->url}}">
                </div>

            </div>

            <div class="row m-2" >
                <div class="col-6">
                    <input type="text" class="form-control" name="address" value="{{$restaurant->address}}">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="city" value="{{$restaurant->city}}">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="phone" value="{{$restaurant->phone}}">
                </div>

            </div >

            <input type="text" hidden name="user_id" value="{{Auth::user()->id}}">

            <div class='row ml-4'>
                <button type="submit" class="btn btn-primary">
                    save
                </button>
            </div>
        </form>
    @endsection

     <div>


</div>
@endsection
