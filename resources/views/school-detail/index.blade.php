@extends('layout.main')
@section('main')
    <div>
        <p class="text-4xl">{{$name == null ? "Data is empty" : $name}}</p>
    </div>
    <div class="mt-12">
        <div class="flex flex-inline place-content-center">
            <img src="{{asset('storage/group.png')}}" alt="">
        </div>
        <p class="text-xl font-semibold">{{$categories[0]}}</p>
        <p class="text-base">{{$values[0]}}</p>
    </div>
@endsection
