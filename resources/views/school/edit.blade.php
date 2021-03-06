@extends('layout/main')
@section('main')
    <div>
        <p class="text-4xl">Edit School</p>
    </div>
    <div class="mt-12">
        <form action="{{ url('school/update/'.$data->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl w-4/5">
                <input id="name" class=" pl-2 w-full outline-none border-none" type="text" name="name" placeholder="Name"
                    required value="{{$data->name}}" />
            </div>
            <div class="flex items-center justify-between w-4/5">
                <div></div>
                <button type="submit"
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-indigo-500 focus:outline-none focus:ring">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
