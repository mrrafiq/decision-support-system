@extends('layout/main')
@section('main')
    <p class="text-4xl mb-4">Welcome, {{ $dm == 'Admin' ? 'Admin' : $dm->user->username }}!</p>
    <hr>
    @role('decision_maker')
        @if (count($data) != 0)
            <p class="mt-6 mb-3 text-lg">Berikut merupakan hasil perhitungan akhir dari sesi ini.</p>
            <table class="w-full text-sm divide-y-2 rounded-2xl divide-gray-200 bg-gray-100 w-4/5">
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
                    @foreach ($data as $data)
                        <tr>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ $data->rank }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                {{ $data->school->name }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-700 whitespace-nowrap">
                                {{ number_format($data->score, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @if (count($categories) == 0)
                <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
                    <p>Sistem ini butuh kategori untuk setiap sesi-nya.
                        <br>Silahkan pilih kriteria penilaian anda!
                    </p>
                    <button
                        class="mt-4 px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                        <a href="{{ url('user-categories/create/') }}">Pilih Kriteria</a>
                    </button>
                </div>
            @else
                <p class="mb-2 text-xl mt-12 font-semibold">Kriteria</p>
                <p class="mb-2 text-base text-gray-400">Kriteria yang dipilih oleh {{ $dm->user->username }}</p>
                <div class="flex items-center justify-between w-3/5">
                    <div></div>
                    <div>
                        <button
                            class=" px-3 py-2 text-sm font-medium text-white transition bg-yellow-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                            <a href="{{ url('user-categories/edit/' . $dm->id) }}">Edit</a>
                        </button>
                    </div>
                </div>
                <table class="w-full text-sm divide-y-2 rounded-2xl divide-gray-200 bg-gray-100 w-3/5 mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                                No
                            </th>
                            <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                                Kriteria
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($categories as $data)
                            @php
                                $no++;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $no }}
                                </td>
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                    @if ($data->category_id == 1)
                                        Jarak
                                    @elseif ($data->category_id == 3)
                                        Visi dan Misi
                                    @else
                                        {{ ucwords(str_replace('_', ' ', $data->category->name)) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if (count($school_session) == 0)
                <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
                    <p>Sistem ini butuh alternatif pilihan untuk setiap sesi-nya.
                        <br>Kamu bisa menghubungi administrator untuk langkah lebih lanjut!
                    </p>
                </div>
            @else
                <p class="mb-2 text-xl mt-12 font-semibold">Sekolah Pilihan</p>
                <table class="w-full text-sm divide-y-2 rounded-2xl divide-gray-200 bg-gray-100 w-3/5">
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
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($school_session as $data)
                            @php
                                $no++;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $no }}
                                </td>
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                    {{ $data->school->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if (count($user_session) <= 1)
                <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
                    <p>Sistem ini butuh decision maker yang lebih dari satu untuk setiap sesi-nya.
                        <br>Kamu bisa menghubungi administrator untuk langkah lebih lanjut!
                    </p>
                </div>
            @else
                <p class="mb-2 text-xl mt-12 font-semibold">Decision Maker</p>
                <table class="w-full text-sm divide-y-2 rounded-2xl divide-gray-200 bg-gray-100 w-3/5 mb-6">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                                No
                            </th>
                            <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                                Nama User
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($user_session as $data)
                            @php
                                $no++;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $no }}
                                </td>
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                    {{ $data->user->username }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif
    @endrole
    @role('administrator')
        <div class="mt-12 flex gap-8 w-full justify-start">
            <div class="bg-gray-50 px-4 py-4 w-1/3 border-2 border-gray-100 rounded-lg">
                <p>Jumlah Sesi</p>
                <hr>
                <p class="font-bold text-2xl ">{{ count($session) }}</p>
            </div>
            <div class="bg-gray-50 px-4 py-4 w-1/3 border-2 border-gray-100 rounded-lg">
                <p>Jumlah Decision Maker</p>
                <hr>
                <p class="font-bold text-2xl ">{{ count($dm_total) }}</p>
            </div>
            <div class="bg-gray-50 px-4 py-4 w-1/3 border-2 border-gray-100 rounded-lg">
                <p>Jumlah Sekolah</p>
                <hr>
                <p class="font-bold text-2xl ">{{ $school }}</p>
            </div>
        </div>
        @if (count($data) != 0)
            <p class="text-lg mt-12 text-gray-400">Berikut merupakan sesi yang telah selesai melakukan perhitungan</p>
            <table class="w-full text-sm divide-y-2 rounded-2xl divide-gray-200 bg-gray-100 w-3/5 mt-6">
                <thead>
                    <tr>
                        <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                            Id
                        </th>
                        <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                            Nama Sesi
                        </th>
                        <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                            Detail
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($data as $data)
                        <tr>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                {{ $data->id }}
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ $data->name }}
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                <a href="{{ url('decision-session/show/' . $data->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-500 hover:scale-125 mr-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
                <p>Belum ada sesi yang selesai melakukan perhitungan!
                </p>
            </div>
        @endif
    @endrole
@endsection
