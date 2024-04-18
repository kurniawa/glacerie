@extends('layouts.main')
@section('content')
    <main>
        <x-errors-any></x-errors-any>
        <x-validation-feedback></x-validation-feedback>

        <div class="m-3">
            <h1 class="text-xl font-bold">{{ $resep->nama }} -> {{ $resep->porsi }}</h1>
            <div class="border rounded p-2 mt-3">
                <div class="text-center font-bold">
                    <h3>Detail Bahan</h3>
                </div>
                <div id="detail-bahan" class="grid grid-cols-5 gap-1">
                    <div class="flex justify-center col-span-3">Nama Bahan</div>
                    <div class="flex justify-center col-span-1">Jml</div>
                    <div class="flex justify-center col-span-1">Satuan</div>
                    @for ($i = 0; $i < count($resep->bahans); $i++)
                    <div class="col-span-3">{{ $resep->bahans[$i]->nama }}</div>
                    <div class="col-span-1 text-center">{{ (float)$resep->resep_bahans[$i]->jumlah + 0 }}</div>
                    <div class="col-span-1 text-center">{{ $resep->resep_bahans[$i]->satuan }}</div>
                    @endfor
                </div>
            </div>
            {{-- <div class="flex justify-end mt-1">
                <button type="button" class="p-1 text-white bg-emerald-300 rounded-md" onclick="tambahBahan()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div> --}}
            <div class="mt-3">
                <label for="cara_pembautan">Cara Pembuatan (opt):</label>
                <textarea name="cara_pembuatan" id="cara_pembuatan" rows="5" class="w-full border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1">
                    {{ $resep->cara_pembuatan }}
                </textarea>
            </div>

            <div class="flex justify-center mt-3">
                <a href="{{ route('reseps.edit', $resep->id) }}" class="bg-slate-400 text-white border border-slate-500 px-2 py-1 rounded flex gap-2 items-center" onclick="showLoadingSpinner()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    <span>Edit</span>
                </a>
            </div>
            <form action="{{ route('reseps.delete', $resep->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus resep ini?')" class="mt-3">
                @csrf
                <div class="flex justify-center">
                    <button type="submit" class="bg-red-300 rounded px-2 py-1 flex gap-2 items-center border border-red-500 text-white" onclick="showLoadingSpinner()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        <span>Hapus</span>
                    </button>
                </div>
            </form>
            {{-- <div class="mt-5 text-center">
                <button type="submit" class="px-3 py-2 text-white bg-emerald-300 border-2 border-emerald-400 rounded-md">Konfirmasi</button>
            </div> --}}
        </div>

        <x-back-button :back=$back :backRoute=$backRoute :backRouteParams=$backRouteParams></x-back-button>
    </main>

    <script>

    </script>
@endsection
