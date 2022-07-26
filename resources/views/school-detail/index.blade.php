@extends('layout.main')
@section('main')
    <div>
        <p class="text-4xl">{{ $name == null ? $message : $name }}</p>
        @role('administrator')
        @if ($name == null)
            <button
                class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring mt-5">
                <a href="{{ url('school/create-detail/' . $data->id) }}">Add</a>
            </button>
        @else
        <button
            class=" px-3 py-2 text-sm font-medium text-white transition bg-yellow-500 rounded hover:scale-110 hover:shadow-xl active:bg-yellow-500 focus:outline-none focus:ring mt-5">
            <a href="{{ url('school/edit-detail/' . $data->id) }}">Edit</a>
        </button>
        @endif
        @endrole
    </div>
    @if ($name != null)
    <div class="mt-8 mb-12">
        <p class="text-xl font-semibold">{{ $categories == null ? '' : strtoupper($categories[0]) }}</p>
        <p class="text-base">{{ $values == null ? '' : $values[0] }}</p>
        <div class="flex justify-center items-center mt-8">
            <img class="w-fit h-fit" src="{{ $values == null ? '' : url('/' . $values[1]) }}" alt="">
        </div>
        <p class="text-xl font-semibold mt-8">{{ $categories == null ? '' : strtoupper(str_replace('_',' ',$categories[2])) }}</p>
        <p class="text-base">{{ $values == null ? '' : $values[2] }}</p>
        <p class="text-xl font-semibold mt-8">{{ $categories == null ? '' : strtoupper(str_replace('_',' ',$categories[3])) }}</p>
        <p class="text-base">{{ $values == null ? '' : $values[3] }}</p>
        <p class="text-xl font-semibold mt-8">{{ $categories == null ? '' : strtoupper(str_replace('_',' ',$categories[4])) }}</p>
        <p class="text-base">{{ $values == null ? '' : ucwords($values[4]) }}</p>
        <p class="text-xl font-semibold mt-8">{{ $categories == null ? '' : strtoupper(str_replace('_',' ',$categories[5])) }}</p>
        <p class="text-base">Rp.{{ $values == null ? '' : number_format((float)($values[5]), 2, ",", ".") }}</p>
        <p class="text-xl font-semibold mt-8">{{ $categories == null ? '' : strtoupper(str_replace('_',' ',$categories[6])) }}</p>
        <p class="text-base">Rp.{{ $values == null ? '' :  number_format((float)($values[6]), 2, ",", ".") }}</p>
        <p class="text-xl font-semibold mt-8">{{ $categories == null ? '' : strtoupper(str_replace('_',' ',$categories[7])) }}</p>
        <p class="text-base">{{ $values == null ? '' : $values[8] }}</p>
        <p class="text-xl font-semibold mt-8">{{ $categories == null ? '' : strtoupper(str_replace('_',' ',$categories[8])) }}</p>
        <p class="text-base">{{ $values == null ? '' : $values[9] }}</p>
        <p class="text-xl font-semibold mt-8">{{ $categories == null ? '' : strtoupper(str_replace('_',' ',$categories[9])) }}</p>
        <p class="text-base">{{ $values == null ? '' : $values[9] }}</p>
    </div>
    @endif
@endsection
