@extends('layout.main')
@section('main')
    <div>
        <p class="text-4xl">Sekolah</p>
    </div>
    <div class="mt-12">
        <div class="flex items-center justify-between">
            <div></div>
            @role('administrator')
            <button
                class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                <a href="{{ route('create-school') }}">Tambah</a>
            </button>
            @endrole
        </div>
        <table class="w-full text-sm divide-y-2 mt-6 rounded-2xl divide-gray-200 bg-gray-100">
            <thead>
                <tr>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        No
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Nama Sekolah
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Dibuat pada
                    </th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        Aksi
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
                        {{ $data->name }}
                    </td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data->created_at }}</td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                        <div class="flex flex-inline place-content-center">
                            <a href="{{url('school/show/' . $data->id)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-500 hover:scale-125 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                            </a>
                            @role('administrator')
                            <a href="{{ url('school/edit/' . $data->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500 hover:scale-125 mr-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{ url('school/destroy/' . $data->id) }}" method="POST"
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
                            @endrole
                        </div>

                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
@endsection
