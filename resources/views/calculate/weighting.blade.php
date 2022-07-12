@extends('layout.main')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        <div class="mt-8 mb-4">
            <input id="decision_maker_id" class=" pl-2 w-full outline-none border-none bg-transparent"
                type="hidden" name="decision_maker_id" required value="{{$decision_maker->id}}" />
            <p class="text-lg">Decision Maker: <span class="font-bold">{{$decision_maker->name}}</span></p>
        </div>
        <hr>
        <div class="mt-4">
            <ol class="list-decimal">
                @for ($i = 0; $i < count($user_categories); $i++)
                    <li class="mb-4">
                        <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                            <select name="category_id_{{$i}}" id="category_id_{{$i}}"
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
                @endfor
            </ol>
        </div>
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
<script>
    $(function () {
        $('select').change(function() {
            var used = new Set;
            $('select').each(function () {
            var reset = false;
            $('option', this).each(function () {
                var hide = used.has($(this).text());
                if (hide && $(this).is(':selected')) reset = true;
                $(this).prop('hidden', hide);
            });
            if (reset) $('option:not([hidden]):first', this).prop('selected', true);
            used.add($('option:selected', this).text());
            });
        }).trigger('change'); // run at load
    });
</script>
@endsection


