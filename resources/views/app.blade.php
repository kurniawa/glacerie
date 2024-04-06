@extends('layouts.main')
@section('content')
    <main>
        <x-errors-any></x-errors-any>
        <x-validation-feedback></x-validation-feedback>
        <div class="flex justify-between m-2">
            <a href="{{ route('calculator.index') }}" class="loading-spinner bg-orange-300 text-white px-2 py-1 rounded">
                Calculator
            </a>
            <a href="{{ route('reseps.create') }}" class="loading-spinner bg-emerald-300 text-white px-2 py-1 rounded">
                + Add Recipe
            </a>
        </div>
        <div class="grid grid-cols-12">
            @foreach ($reseps as $resep)
            <div class="col-span-3"></div>
            <div class="col-span-5">{{ $resep->nama }}</div>
            <div class="col-span-2"></div>
            <div class="col-span-2"></div>
            @endforeach
        </div>
        <x-back-button :back=$back :backRoute=$backRoute :backRouteParams=$backRouteParams></x-back-button>
    </main>
@endsection
