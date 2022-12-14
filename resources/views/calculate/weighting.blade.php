@extends('layout.main')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div>
    <p class="text-4xl">Pembobotan Kriteria</p>
    <p class="text-base text-gray-500 mt-4 mb-12">Masukkan perbandingan kriteria</p>
</div>
@if (Session::has('error'))
    <div class="basis-1/2 border-2 mt-6 mb-6 rounded-2xl border-red-200 text-red-900 py-2 px-3 bg-red-100"
        role="alert">
        {{ Session::get('error') }}
    </div>
@endif
<div>
    <form action="{{url('calculate/process/'. $decision_maker->id)}}" method="POST">
        @csrf
        <hr>
        <div class="mt-4 mb-4 flex grid grid-cols-3 gap-x-12 font-bold">
            <p>Kriteria Pertama</p>
            <p>Perbandingan</p>
            <p>Kriteria Kedua</p>
        </div>
        @for ($i = 0; $i < count($user_categories)-1; $i++)
            <div class="flex grid grid-cols-3 gap-x-12 mt-2">
                <div>
                    @for ($j = $i+1; $j < count($user_categories); $j++)
                    <p>
                        @if ($user_categories[$i]->category_id == 1)
                            Jarak
                        @elseif ($user_categories[$i]->category_id == 3)
                            Visi dan Misi
                        @else
                            {{ucwords(str_replace('_',' ',$user_categories[$i]->category->name))}}
                        @endif
                    </p><br>
                    @endfor
                </div>
                <div>
                    @for ($j = $i+1; $j < count($user_categories); $j++)
                        <select class="flex item-center border px-2" name="{{$user_categories[$i]->category->name}}_{{$j}}" id="{{$user_categories[$i]->category->name}}_{{$j}}" required>
                            @foreach ($scale as $item)
                                <option value="{{$item->point}}" {{($item->point== 1) ? 'selected' : ''}}>{{$item->point}} - {{$item->status}}</option>
                            @endforeach
                        </select><br>
                    @endfor
                </div>
                <div>
                    @for ($j = $i+1; $j < count($user_categories); $j++)
                    <p>
                        @if ($user_categories[$j]->category_id == 3)
                            Visi dan Misi
                        @else
                            {{ucwords(str_replace('_', ' ',$user_categories[$j]->category->name))}}
                        @endif
                    </p>
                    <br>
                    @endfor
                </div>
            </div>
            <hr>
        @endfor

        <div class="mt-4 flex items-center justify-between mb-8">
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


