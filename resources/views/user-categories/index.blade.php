@extends('layout.main')
@section('main')
    <div>
        <p class="text-4xl">Session Criteria</p>
    </div>
    @foreach ($data as $item)
    <div class="mt-8 mb-12">
        <p class="text-2xl">Sesi - {{$item['session_name']}}</p>
        <div class="flex items-center justify-between w-3/5">
            <div></div>
            @if (count($item) > 2)
                <button
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-yellow-500 rounded hover:scale-110 hover:shadow-xl active:bg-yellow-500 focus:outline-none focus:ring">
                    <a href="{{ url('user-categories/edit/' . $item['session_id']) }}">Edit</a>
                </button>
            @else
                <button
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                    <a href="{{ url('user-categories/create/'.$item['session_id']) }}">Add+</a>
                </button>
            @endif
        </div>
        <table class="w-3/5 text-sm divide-y-2 mt-6 rounded-2xl divide-gray-200 bg-gray-100">
            <thead>
                <tr>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        No
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Kategori
                    </th>
                </tr>
            </thead>
            @if (count($item) > 2)
            <tbody class="divide-y divide-gray-200">
                <?php $no = 0; ?>
                <?php foreach ($item['category_name'] as $value): $no++?>
                <tr>
                    <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                        {{ $no }}
                    </td>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        @if ($value == 'deskripsi')
                            Jarak
                        @elseif ($value == 'visi')
                            Visi dan Misi
                        @else
                            {{ ucwords(str_replace('_',' ',$value)) }}
                        @endif
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
            @endif
        </table>
    </div>
    @endforeach
@endsection
