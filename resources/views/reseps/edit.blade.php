@extends('layouts.main')
@section('content')
    <main>
        <x-errors-any></x-errors-any>
        <x-validation-feedback></x-validation-feedback>

        <div class="m-3">
            <form action="{{ route('reseps.update', $resep->id) }}" method="POST">
                @csrf
                <div class="sm:col-span-3">
                    <label for="nama" class="block font-medium leading-6 text-gray-900">Nama Resep</label>
                    <div class="mt-2">
                        <input type="text" name="nama" id="nama" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:leading-6" value="{{ old('nama') ? old('nama') : $resep->nama }}">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 mt-3">
                    <div>
                        <label for="porsi">Porsi</label>
                        <input type="text" name="porsi" id="porsi" class="w-full border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1" value="{{ old('porsi') ? old('porsi') : $resep->porsi }}">
                    </div>
                </div>
                <div class="border rounded p-2 mt-3">
                    <div class="text-center font-bold">
                        <h3>Detail Bahan</h3>
                    </div>
                    <div id="detail-bahan" class="grid grid-cols-5 gap-1">
                        <div class="flex justify-center col-span-3">Nama Bahan</div>
                        <div class="flex justify-center col-span-1">Jml</div>
                        <div class="flex justify-center col-span-1">Satuan</div>
                        @for ($i = 0; $i < count($resep->bahans); $i++)
                        <div class="col-span-3">
                            <input type="text" name="nama_bahan[]" id="nama_bahan-{{ $i }}" class="border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1" value="{{ old('nama_bahan.' . $i) ? old('nama_bahan.' . $i) : $resep->bahans[$i]->nama }}">
                        </div>
                        <div class="col-span-1">
                            <input type="text" name="jumlah_bahan[]" id="jumlah_bahan-{{ $i }}" class="border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1 w-full" value="{{ old('jumlah_bahan.' . $i) ? old('jumlah_bahan.' . $i) : (float)$resep->resep_bahans[$i]->jumlah+0 }}">
                        </div>
                        <div class="col-span-1">
                            <input type="text" name="satuan_bahan[]" id="satuan_bahan-{{ $i }}" class="border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1 w-full" value="{{ old('satuan_bahan.' . $i) ? old('satuan_bahan.' . $i) : $resep->resep_bahans[$i]->satuan }}">
                        </div>
                        @endfor

                    </div>
                </div>
                <div class="flex justify-end mt-1">
                    <button type="button" class="p-1 text-white bg-emerald-300 rounded-md" onclick="tambahBahan()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </div>
                <div class="mt-3">
                    <label for="cara_pembautan">Cara Pembuatan (opt):</label>
                    <textarea name="cara_pembuatan" id="cara_pembuatan" rows="5" class="w-full border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1">
                        {{ old('cara_pembuatan') ? old('cara_pembuatan') : $resep->cara_pembuatan }}
                    </textarea>
                </div>
                <div class="mt-5 text-center">
                    <button type="submit" class="px-3 py-2 text-white bg-emerald-300 border-2 border-emerald-400 rounded-md">Konfirmasi</button>
                </div>
            </form>
        </div>

        <x-back-button :back=$back :backRoute=$backRoute :backRouteParams=$backRouteParams></x-back-button>
    </main>

    <script>
        const reseps = {!! json_encode($reseps, JSON_HEX_TAG) !!};
        const bahans = {!! json_encode($bahans, JSON_HEX_TAG) !!};
        const satuans = {!! json_encode($satuans, JSON_HEX_TAG) !!};

        function setAutocomplete(id, source) {
            $(`#${id}`).autocomplete({source:source});
        }

        setAutocomplete(`nama`, reseps);
        setAutocomplete(`nama_bahan-0`, bahans);
        setAutocomplete(`satuan_bahan-0`, satuans);

        let index_bahan = 10;
        function tambahBahan() {
            let html_bahan = `
            <div class="col-span-3">
                <input type="text" name="nama_bahan[]" id="nama_bahan-${index_bahan}" class="border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1">
            </div>
            <div class="col-span-1">
                <input type="text" name="jumlah_bahan[]" id="jumlah_bahan-${index_bahan}" class="border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1 w-full">
            </div>
            <div class="col-span-1">
                <input type="text" name="satuan_bahan[]" id="satuan_bahan-${index_bahan}" class="border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1 w-full">
            </div>`;

            document.getElementById('detail-bahan').insertAdjacentHTML('beforeend', html_bahan);

            setAutocomplete(`nama_bahan-${index_bahan}`, bahans);
            setAutocomplete(`satuan_bahan-${index_bahan}`, satuans);

            index_bahan++;
        }
    </script>
@endsection
