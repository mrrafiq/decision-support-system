@extends('layout.main')
@section('main')
<div>
    <p class="text-4xl">Calculate</p>
</div>
@if (count($decision_maker)<=1) <div class="mt-8 bg-red-50 px-4 py-4 basis-1/2 border-2 border-red-100 rounded-lg">
    <p class="text-lg">You do not have enough decision makers for now.
        <br>You can click the button below to add decision maker.
        <br>Current: {{count($decision_maker_total)}}
    </p>
    <button
        class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-sky-500 focus:outline-none focus:ring">
        <a href="{{ route('create-decision-maker') }}">Add Decision Maker</a>
    </button>
    </div>
    @endif
    @if (count($ahp) == null && count($decision_maker)>1)
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
            <a href="{{url('calculate/direction/'. $data->id)}}">Start</a>
        </button>
    </div>
    @endif

    @endsection
