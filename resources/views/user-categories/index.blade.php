@extends('layout.main')
@section('main')
    <div>
        <p class="text-4xl">Categories</p>
    </div>
    <div class="mt-12">
        <div class="flex items-center justify-between w-4/5">
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
        <table class="w-4/5 text-sm divide-y-2 mt-6 rounded-2xl divide-gray-200 bg-gray-100">
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
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        Action
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
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                        <div class="flex flex-inline place-content-center">
                            <form action="{{ url('user-categories/destroy/' . $data->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure to delete this data?')">
                                @method('delete')
                                @csrf
                                <button type="submit" id="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 hover:scale-125"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
@endsection
