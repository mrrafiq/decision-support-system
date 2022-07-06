@extends('layout.main')
@section('main')
<div>
    <p class="text-4xl">Weighting</p>
    <p class="text-base text-gray-500 mt-4">Masukkan kriteria prioritas mulai dari yang tertinggi hingga terendah</p>
</div>
@if (Session::has('error'))
    <div class="basis-1/2 border-2 mt-6 rounded-2xl border-red-200 text-red-900 py-2 px-3 bg-red-100"
        role="alert">
        {{ Session::get('error') }}
    </div>
@endif
<div>
    <form action="{{route('process')}}" method="POST">
        @csrf
        @for ($j = 0; $j < count($decision_maker); $j++) 
            @php
                $k =0;
            @endphp
            <div class="mt-8">
                <input id="decision_maker_id_{{$j}}" class=" pl-2 w-full outline-none border-none bg-transparent"
                    type="hidden" name="decision_maker_id_{{$j}}" required value="{{$decision_maker[$j]->id}}" />
                <p class="text-lg">{{$decision_maker[$j]->name}}</p>
                {{$k}}
            </div>
            <div class="mt-4">
                <ol class="list-decimal">
                    @for ($i = 0; $i < count($user_categories); $i++) 
                        @if ($j==count($decision_maker)-1) 
                            @php
                                $k=$k+1;
                            @endphp 
                            <li class="mb-4">
                                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                                    <select name="category_id_{{$k}}" id="category_id_{{$k}}"
                                        class="pl-2 w-full outline-none border-none bg-transparent" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($user_categories as $key)
                                        <option value="{{$key->category_id}}">
                                            @if ($key->category_id == 1)
                                            Jarak

                                            @elseif ($key->category_id == 3)
                                            Visi dan Misi
                                            @else
                                            {{ucwords(str_replace('_',' ',$key->category->name))}}
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{$k}}
                            </li>
                        @elseif($j < count($decision_maker)-1 && $j != 0)
                            @php
                                $k = count($user_categories)+$i;
                            @endphp
                            <li class="mb-4">
                                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                                    <select name="category_id_{{$k}}" id="category_id_{{$k}}"
                                        class="pl-2 w-full outline-none border-none bg-transparent" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($user_categories as $key)
                                        <option value="{{$key->category_id}}">
                                            @if ($key->category_id == 1)
                                            Jarak

                                            @elseif ($key->category_id == 3)
                                            Visi dan Misi
                                            @else
                                            {{ucwords(str_replace('_',' ',$key->category->name))}}
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                        @elseif($j == 0)
                            <li class="mb-4">
                                <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                                    <select name="category_id_{{$i}}" id="category_id_{{$i}}"
                                        class="pl-2 w-full outline-none border-none bg-transparent">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($user_categories as $key)
                                        <option value="{{$key->category_id}}">
                                            @if ($key->category_id == 1)
                                            Jarak

                                            @elseif ($key->category_id == 3)
                                            Visi dan Misi
                                            @else
                                            {{ucwords(str_replace('_',' ',$key->category->name))}}
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                        @endif
                    @endfor
                </ol>
            </div>
        @endfor
        <div class="flex items-center justify-between mb-8">
            <div>
            </div>
            <button type="submit"
                class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-indigo-500 focus:outline-none focus:ring">
                Submit
            </button>
        </div>
    </form>
</div>
@endsection