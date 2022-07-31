@extends('layout/main')
@section('main')
    <div>
        <p class="text-4xl">Edit Decision Maker</p>
    </div>
    <div class="mt-12">
        <form action="{{ url('decision-maker/update/'.$user->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                <input id="username" class=" pl-2 w-full outline-none border-none" type="text" name="username" placeholder="Username"
                    required value="{{$user->username}}" />
            </div>
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                <input id="email" class=" pl-2 w-full outline-none border-none" type="email" name="email" placeholder="Email"
                    required value="{{$user->email}}" />
            </div>
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                <input id="password" class=" pl-2 w-full outline-none border-none" type="password" name="password" placeholder="Password"
                     />
            </div>
            <div class="flex items-center justify-between">
                <div></div>
                <button type="submit"
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-indigo-500 focus:outline-none focus:ring">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
