@extends('layout/main')
@section('main')
    <div>
        <p class="text-4xl">Add Categories</p>
    </div>
    <div class="mt-12">
        <div class="w-full bg-neutral-100 px-10 py-10 rounded-lg">
            <form action="{{ route('store-categories') }}" method="POST">
                {{ csrf_field() }}
                @for ($i = 0; $i < count($categories); $i++)
                @if ($categories[$i]->type !== null)
                    <div class="flex items-center mb-4">
                        <input type="checkbox"
                            class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                            id="{{$categories[$i]->name}}" name="{{$categories[$i]->name}}" value="{{$categories[$i]->id}}">
                        <label for="visi_misi" class="ml-2 font-medium">
                            @if ($categories[$i]->id == 1)
                                Jarak
                            @elseif ($categories[$i]->id == 3)
                                Visi dan Misi
                            @else
                                {{ucwords(str_replace("_", " ",$categories[$i]->name))}}
                            @endif
                        </label>
                    </div>
                @endif
                @endfor
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
