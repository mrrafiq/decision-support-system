@extends('layout.main')
@section('main')
    <div class="mb-8">
        <p class="text-4xl capitalize">{{$school->name}}</p>
        <p class="mt-8 text-gray-400 text-sm">Notes:</p>
        <p class="text-sm text-gray-400"><span class="text-sm text-green-400">Hijau</span> berarti benefit, semakin besar nilai-nya semakin bagus.</p>
        <p class="text-sm text-gray-400"><span class="text-sm text-red-400">Merah</span> berarti cost, semakin kecil nilai-nya semakin bagus</p>
    </div>
    <div class="mb-8 bg-gray-100 rounded-[20px] py-10 px-10 w-4/5">
        <form action="{{url('calculate/store/'. $school->id)}}" method="POST">
            @csrf
            @for ($i = 0; $i < count($user_categories); $i++)
                <div class="flex mb-4 justify-between w-4/5">
                    <div>
                        <p class="first-letter:uppercase text-lg {{$user_categories[$i]->category->type == 0 ? 'text-red-500' : 'text-green-500'}}">
                            @if ($user_categories[$i]->category->id == 1)
                                Berapa jarak rumah anda ke sekolah ini? (Km)
                            @elseif ($user_categories[$i]->category->id == 3)
                                Berapa penilaian anda terhadap Visi dan Misi sekolah ini?
                            @else
                                Berapa penilaian anda terhadap {{ucwords(str_replace('_',' ',$user_categories[$i]->category->name))}} sekolah ini?
                            @endif
                        </p>
                    </div>

                    <div class=" ml-4 flex items-center border-2 py-2 px-3 rounded-2xl">
                        @if ($user_categories[$i]->category->id == 1)
                            <input class="border-none bg-transparent" required type="number" name="category_{{$user_categories[$i]->category->id}}" id="category_{{$user_categories[$i]->category->id}}" min="1" max="200">
                        @else
                            <input class="border-none bg-transparent" required type="number" name="category_{{$user_categories[$i]->category->id}}" id="category_{{$user_categories[$i]->category->id}}" min="1" max="10">
                        @endif
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
