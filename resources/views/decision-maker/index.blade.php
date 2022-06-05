@extends('layout/main')
@section('main')
    <div>
        <p class="text-4xl">Decision Maker</p>
    </div>
    <div class="mt-12">
        <div class="flex items-center justify-between w-4/5">
            <div></div>
            <button
                class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                <a href="{{ route('create-decision-maker') }}">Add+</a>
            </button>
        </div>
        <table class="w-4/5 text-sm divide-y-2 mt-6 rounded-2xl divide-gray-200 bg-gray-100">
            <thead>
                <tr>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        No
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Name
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
                        {{ $data->name }}
                    </td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data->created_at }}</td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                        <div class="flex flex-inline place-content-center">
                            <a href="{{url('decision-maker/edit/'.$data->id)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500 hover:scale-125 mr-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{ url('decision-maker/destroy/' . $data->id) }}" method="POST"
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
