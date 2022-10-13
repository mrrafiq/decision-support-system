@extends('layout/main')
@section('main')
    <div>
        <p class="text-4xl">Edit Kriteria</p>
    </div>
    @if (Session::has('error'))
        <div class="basis-1/2 border-2 mt-6 mb-6 rounded-2xl border-red-200 text-red-900 py-2 px-3 bg-red-100"
            role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="mt-12">
        <div class="w-full bg-neutral-100 px-10 py-10 rounded-lg">
            <form action="{{ url('user-categories/update/'. $decision_maker->id) }}" method="POST">
                {{ csrf_field() }}
                @for ($i = 0; $i < count($categories); $i++)
                    @if ($categories[$i]->type !== null)
                        <div class="flex items-center mb-4">
                            <input type="checkbox"
                                class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                                id="{{$categories[$i]->name}}" name="{{$categories[$i]->name}}" value="{{$categories[$i]->id}}" {{(in_array($categories[$i]->id, $data)) ? 'checked' : ''}}>
                            <label for="visi_misi" class="ml-2 font-medium {{($categories[$i]->type == 0) ? 'text-red-600' : 'text-green-600'}}">
                                @if ($categories[$i]->id == 1)
                                    Jarak
                                @elseif ($categories[$i]->id == 3)
                                    Visi dan Misi
                                @else
                                    {{ucwords(str_replace("_", " ",$categories[$i]->name))}}
                                @endif
                                - ({{($categories[$i]->type == 0) ? 'Cost' : 'Benefit'}})
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
