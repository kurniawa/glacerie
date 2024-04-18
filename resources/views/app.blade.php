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

        @foreach ($reseps as $key => $resep)
        <div class="mx-2 py-2 border-b">
            <div class="grid grid-cols-12">
                <div class="col-span-1"></div>
                <div class="col-span-7">{{ $resep->nama }}</div>
                <div class="col-span-1"></div>
                <div class="col-span-3">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('reseps.show', $resep->id) }}" class="bg-yellow-300 border border-yellow-500 rounded px-2 py-1 text-slate-500">D</a>
                        <div>
                            <button id="toggle-bahans-{{ $key }}" class="rounded bg-white shadow drop-shadow" onclick="showDropdownGrid(this.id, 'bahans-{{ $key }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bahans-{{ $key }}" style="display: none" class="grid grid-cols-12">
                <div class="col-span-1 font-bold text-slate-400">No.</div>
                <div class="col-span-7 flex justify-center font-bold text-slate-400">Nama Bahan</div>
                <div class="col-span-4 flex justify-center font-bold text-slate-400">Takaran</div>
                @for ($i = 0; $i < count($resep->bahans); $i++)
                <div class="col-span-1">{{ $i + 1 }}.</div>
                <div class="col-span-7">{{ $resep->bahans[$i]->nama }}</div>
                <div class="col-span-4 flex justify-center">
                    <span>{{ (float)$resep->resep_bahans[$i]->jumlah + 0 }} {{ $resep->resep_bahans[$i]->satuan }}</span>
                </div>
                @endfor
            </div>
        </div>
        @endforeach
        <x-back-button :back=$back :backRoute=$backRoute :backRouteParams=$backRouteParams></x-back-button>
    </main>
@endsection
