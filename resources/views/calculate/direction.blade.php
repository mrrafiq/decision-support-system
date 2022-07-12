@extends('layout.main')
@section('main')
    <div class="flex justify-between">
        <div></div>
        <div class="place-content-center mt-60 text-4xl">Are you {{$data->name}}?</div>
        <div></div>
    </div>
    <div class="flex justify between place-content-center">
        <div class="mr-4">
            <form action="{{url('calculate/set-decision-maker/'. $data->id)}}" method="POST">
                @csrf
                <button
                    value="0" name="decision_maker_id" class="mt-4 px-3 py-2 text-sm font-medium text-gray-600 transition bg-gray-100 rounded hover:scale-110 hover:shadow-xl active:bg-sky-50 focus:outline-none focus:ring">
                No
                </button>
            </form>
        </div>
        <div>
            <form action="{{url('calculate/set-decision-maker/'. $data->id)}}" method="POST">
                @csrf
                <button
                    value="{{$data->id}}" name="decision_maker_id" class="mt-4 px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                    Yes
                </button>
            </form>
        </div>
    </div>
@endsection
