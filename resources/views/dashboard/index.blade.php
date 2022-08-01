@extends('layout/main')
@section('main')
    <p class="text-4xl">Welcome</p>
    @role('decision_maker')
    @if (count($data) != 0)
        <p class="mt-6 mb-3 text-lg">Berikut merupakan hasil perhitungan akhir dari masing-masing pembuat keputusan.</p>
        <table class="w-full text-sm divide-y-2 rounded-2xl divide-gray-200 bg-gray-100">
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
                        {{$data->rank}}
                    </td>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        {{$data->school->name}}
                    </td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                        {{$data->score}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @if (count($categories) == 0)
            <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
                <p>Sistem ini butuh kategori untuk setiap sesi-nya.
                    <br>Kamu bisa menghubungi administrator untuk langkah lebih lanjut!
                </p>
            </div>
        @else
            <p class="text-2xl mt-12">Sesi - {{$categories[0]->session->name}}</p>
            <p class="text-gray-500 mb-6">Berikut merupakan kategori untuk sesi {{$categories[0]->session->name}}</p>
            <table class="w-full text-sm divide-y-2 rounded-2xl divide-gray-200 bg-gray-100 w-3/5">
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
                                {{$no}}
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                @if ($data->category_id == 1)
                                    Jarak
                                @elseif ($data->category_id == 3)
                                    Visi dan Misi
                                @else
                                    {{ ucwords(str_replace('_',' ',$data->category->name)) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
    @endrole
@endsection
