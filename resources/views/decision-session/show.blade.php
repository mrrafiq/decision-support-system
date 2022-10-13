@extends('layout.main')
@section('main')
    <div>
        <p class="text-4xl">{{$session->name}}</p>
    </div>
    @if (count($borda) != 0)
    <div class="mt-12">
        <p class="text-xl">Hasil Perhitungan</p>
        <p class="text-sm text-gray-500">Berikut merupakan hasil perhitungan dari setiap decision maker pada sesi ini.</p>
        <table class="w-full text-sm divide-y-2 mt-6 rounded-2xl divide-gray-200 bg-gray-100">
            <thead>
                <tr>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Rank
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        School
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Score
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($borda as $item)
                <tr>
                    <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                        {{ $item->rank }}
                    </td>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        {{ $item->school->name }}
                    </td>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        {{ number_format($item->score, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if ($message != null)
    <div class="basis-1/2 border-2 mt-6 mb-6 rounded-2xl border-red-200 text-red-900 py-2 px-3 bg-red-100"
        role="alert">
        {{ $message }}
    </div>
    @endif
    <div class="mt-12 mb-8">
        <p class="text-xl">Decision Maker</p>
        @if (count($borda) == 0)
            <div class="flex items-center justify-between w-3/5">
                <div></div>
                <button
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                    <a href="{{ url('decision-session/add/' . $session->id) }}">Add+</a>
                </button>
            </div>
        @endif
        <table class="w-3/5 text-sm divide-y-2 mt-6 rounded-2xl divide-gray-200 bg-gray-100">
            <thead>
                <tr>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Id
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Username
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Bobot
                    </th>
                    @if (count($borda) == 0)
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        Action
                    </th>
                    @endif
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($data as $data)
                <tr>
                    <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                        {{ $data->user_id }}
                    </td>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        {{ $data->user->username }}
                    </td>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        {{ $data->weight }}
                    </td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                        @if (count($borda) == 0)
                        <div class="flex flex-inline place-content-center">
                            <a href="{{url('decision-session/edit-dm/'.$data->id)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500 hover:scale-125 mr-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{ url('decision-session/delete-dm/' . $data->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure to delete this data?')">
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
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- To display school of this session --}}
    <div class="mt-12 mb-8">
        <p class="text-xl">Sekolah Pilihan</p>
        @if (count($school) == 0)
        <div class="flex items-center justify-between w-3/5">
            <div></div>
            <button
                class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                <a href="{{ url('school-session/create/'.$session->id) }}">Add+</a>
            </button>
        </div>
        @endif
        @if (count($borda) == 0)
            @if (count($school) != 0)
            <div class="flex items-center justify-between w-3/5">
                <div></div>
                <button
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-yellow-500 rounded hover:scale-110 hover:shadow-xl active:bg-yellow-500 focus:outline-none focus:ring">
                    <a href="{{ url('school-session/edit/'.$session->id) }}">Edit</a>
                </button>
            </div>
            @endif
        @endif
        <table class="w-3/5 text-sm divide-y-2 mt-6 rounded-2xl divide-gray-200 bg-gray-100">
            <thead>
                <tr>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        No
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Nama Sekolah
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                <?php $no = 0; ?>
                <?php foreach ($school as $data): $no++ ?>
                <tr>
                    <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                        {{ $no }}
                    </td>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        {{$data->school->name}}
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

@endsection
