@extends('layout/main')
@section('main')
    <p class="text-4xl">Welcome</p>
    @if (count($data) != null)
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
    @endif
@endsection
