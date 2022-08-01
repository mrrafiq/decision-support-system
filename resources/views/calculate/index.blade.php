@extends('layout.main')
@section('main')
    <div>
        <p class="text-4xl mb-8">Calculate</p>
    </div>
    @role('decision_maker')
    @if (count($dm_total)<=1)
        <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
            <p>Sistem ini butuh lebih pengambil keputusan.
                <br>Kamu bisa menghubungi administrator untuk langkah lebih lanjut!
            </p>
        </div>
    @endif
    @if (count($ahp) == 0 && count($dm_total)>1)
        <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
            <p class="text-lg">Lakukan penilaian perbandingan berpasangan!</p>
            <button
                class="mt-4 px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                <a href="{{ url('calculate/weighting/'. $decision_maker->id) }}">Start Calculate</a>
            </button>
        </div>
    @else
        @if (count($aras) == 0 && count($dm_total)>1)
            <div class="mt-8 mb-8 bg-yellow-100 px-4 py-4 basis-1/2 border-2 border-yellow-200 rounded-lg">
                <p class="text-lg">Lakukan pembobotan kriteria untuk setiap sekolah!</p>
                <button
                    class="mt-4 px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                    <a href="{{url('calculate/alternate/'. $school->id)}}">Start</a>
                </button>
            </div>
        @endif
        @if (count($ahp) != 0 && count($dm_total)>1)
            <p>Berikut merupakan hasil perhitungan nilai setiap kategori menggunakan metode <span class="font-bold">AHP</span></p>
            <table class="w-full text-sm divide-y-2 mt-4 rounded-2xl divide-gray-200 bg-gray-100 mb-4 w-3/5">
                <thead>
                    <tr>
                        <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                            No
                        </th>
                        <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                            Kategori
                        </th>
                        <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                            Nilai
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($ahp as $ahp)
                    @php
                        $no++;
                    @endphp
                    <tr>
                        <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                            {{ $no }}
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                            @if ($ahp->category_id == 1)
                                Jarak
                            @elseif ($ahp->category_id == 3)
                                Visi dan Misi
                            @else
                                {{ucwords(str_replace('_',' ',$ahp->category->name))}}
                            @endif
                        </td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                            {{ $ahp->weight }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
    @if (count($aras) != 0)
        <p>Berikut merupakan hasil perhitungan peringkat alternatif sekolah menggunakan metode <span class="font-bold">ARAS</span></p>
        <table class="w-full text-sm divide-y-2 mt-4 rounded-2xl divide-gray-200 bg-gray-100 mb-4 w-3/5">
            <thead>
                <tr>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Ranking
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Sekolah
                    </th>
                    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                        Skor
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($aras as $aras)
                <tr>
                    <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                        {{ $aras->rank }}
                    </td>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        {{ $aras->school->name }}
                    </td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                        {{ $aras->score }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {{-- @if (count($ahp) == null && count($decision_maker)>1)
        <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
            <p class="text-lg">You have not calculated anything yet.</p>
            <button
                class="mt-4 px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                <a href="{{ url('calculate/weighting/'. $decision_maker[0]->id) }}">Start Calculate</a>
            </button>
        </div>
    @endif
    @if(count($ahp) != null && count($aras) == null)
        <div class="mt-8 bg-yellow-100 px-4 py-4 basis-1/2 border-2 border-yellow-200 rounded-lg">
            <p class="text-lg">Let's start to input the value of each school category!</p>
            <button
                class="mt-4 px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
                <a href="{{url('calculate/direction/'. $decision_maker_id->id)}}">Start</a>
            </button>
        </div>
    @endif

    @if(count($data) != null || count($aras) != null)
        @for($i = 0; $i < count(array_unique($count)); $i++)
            @if ($i > 0)
                <p class="mt-4 text-sm">Decision Maker: <span class="font-bold text-sm">{{$data[$i*count($school)]["decision_maker_name"]}}</span></p>
            @elseif($i == 0)
                <p class="mt-4 text-sm">Decision Maker: <span class="font-bold text-sm">{{$data[$i]["decision_maker_name"]}}</span></p>
            @endif
            <table class="w-full text-sm divide-y-2 mt-4 rounded-2xl divide-gray-200 bg-gray-100 mb-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                            Rank
                        </th>
                        <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                            School Name
                        </th>
                        <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">
                            Score
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @if ($i == 0)
                        @for($j = 0; $j < count($school); $j++)
                        <tr>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ $data[$j]["rank"] }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                {{ $data[$j]["school_name"] }}
                            </td>
                            <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data[$j]["score"] }}</td>
                        </tr>
                        @endfor
                    @elseif($i > 0)
                        @for($j = count($school)*$i; $j < count($school)*($i+1); $j++)
                        <tr>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ $data[$j]["rank"] }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                {{ $data[$j]["school_name"] }}
                            </td>
                            <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data[$j]["score"] }}</td>
                        </tr>
                        @endfor
                    @endif

                </tbody>
            </table>
        @endfor

    @endif --}}

    @else
    <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
        <p class="text-lg">
            Administrator cannot doing a calculation here! Login with decision maker account!
        </p>
    </div>
    @endrole

@endsection
