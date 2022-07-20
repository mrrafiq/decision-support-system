@extends('layout.main')
@section('main')
    <div class="mb-8">
        <p class="text-4xl capitalize">{{$school->name}}</p>
        <p class="mt-8 text-gray-400 text-sm">Notes:</p>
        <p class="text-sm text-gray-400"><span class="text-sm text-green-400">Green</span> means benefit, greater are better and less is bad.</p>
        <p class="text-sm text-gray-400"><span class="text-sm text-red-400">Red</span> means cost, less are better and greater are bad.</p>
    </div>
    <div class="mb-8 bg-gray-100 rounded-[20px] py-10 px-10 w-4/5">
        <form action="{{url('calculate/store/'. $school->id)}}" method="POST">
            @csrf
            @for ($i = 0; $i < count($user_categories); $i++)
                <div class="flex mb-4 justify-between w-4/5">
                    <div>
                        <p class="first-letter:uppercase text-lg {{$user_categories[$i]->category->type == 0 ? 'text-red-500' : 'text-green-500'}}">
                            @if ($user_categories[$i]->category->id == 1)
                                Jarak
                            @elseif ($user_categories[$i]->category->id == 3)
                                Visi dan Misi
                            @else
                                {{ucwords(str_replace('_',' ',$user_categories[$i]->category->name))}}
                            @endif
                        </p>
                    </div>
                    <input type="text" class="hidden" name="decision_maker_id" id="decision_maker_id" value="{{$decision_maker->decision_maker_id}}">
                    <input type="text" class="hidden" name="school_id" id="school_id" value="{{$school->id}}">
                    <input type="text" class="hidden" name="category_id_{{$i}}" id="category_id_{{$i}}" value="{{$user_categories[$i]->category->id}}">
                    <div class=" ml-4 flex items-center border-2 py-2 px-3 rounded-2xl">
                        <input class="border-none bg-transparent" required type="number" name="value_{{$i}}" id="value_{{$i}}" min="1" max="10">
                    </div>
                </div>
            @endfor
            <div class="flex items-center justify-between w-4/5">
                <div></div>
                <button type="submit" class="mt-4 px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                    Submit
                </button>
            </div>
        </form>
    </div>

@endsection
