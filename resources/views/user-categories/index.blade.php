@extends('layout.main')
@section('main')
    <div>
        <p class="text-4xl">Categories</p>
    </div>
    <div class="mt-12">
        <div class="flex items-center justify-between">
            <div></div>
            @if (count($data) == 0)
                <button
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                    <a href="{{ route('create-categories') }}">Add+</a>
                </button>
            @else
                <button
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-yellow-500 rounded hover:scale-110 hover:shadow-xl active:bg-yellow-500 focus:outline-none focus:ring">
                    <a href="{{ route('edit-categories') }}">Edit</a>
                </button>
            @endif

        </div>
        <table class="w-full text-sm divide-y-2 mt-6 rounded-2xl divide-gray-200 bg-gray-100">
            <thead>
                <tr>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        No
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Category
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Created at
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                <?php $no = 0; ?>
                <?php foreach ($data as $data): $no++?>
                <tr>
                    <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                        {{ $no }}
                    </td>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        @if ($data->category->name == 'deskripsi')
                            Jarak
                        @elseif ($data->category->name == 'visi')
                            Visi dan Misi
                        @else
                            {{ ucwords(str_replace('_',' ',$data->category->name)) }}
                        @endif
                    </td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data->created_at }}</td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
@endsection
