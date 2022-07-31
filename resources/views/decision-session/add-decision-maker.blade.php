@extends('layout/main')
@section('main')
    <div>
        <p class="text-4xl">Add Decision Maker</p>
    </div>
    <div class="mt-12">
        <div class="w-full bg-neutral-100 px-10 py-10 rounded-lg">
            <form action="{{ url('decision-session/store-dm/'.$session->id) }}" method="POST">
                {{ csrf_field() }}
                @foreach ($data as $data)
                        <div class="flex items-center mb-4">
                            <input type="checkbox"
                                class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                                id="user_{{$data->user_id}}" name="user_{{$data->user_id}}" value="{{$data->user_id}}">
                            <label for="visi_misi" class="ml-2 font-medium">
                                {{$data->user->username}}
                            </label>
                        </div>
                @endforeach
                <div class="flex items-center justify-between max-w-full">
                    <div></div>
                    <button type="submit"
                        class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-indigo-500 focus:outline-none focus:ring">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
