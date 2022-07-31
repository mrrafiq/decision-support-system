@extends('layout/main')
@section('main')
    <div>
        <p class="text-4xl">Edit Decision Maker Session</p>
    </div>
    <div class="mt-12">
        <form action="{{ url('decision-session/update-dm/'.$data->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                <select name="session_id" id="session_id" class="pl-2 w-full outline-none border-none bg-transparent" required>
                    @foreach ($session as $item)
                        <option value="{{$item->id}}" {{$data->session_id == $item->id ? "selected" : ""}}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center justify-between max-w-full">
                <div></div>
                <button type="submit"
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-indigo-500 focus:outline-none focus:ring">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
