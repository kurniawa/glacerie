@extends('layouts.main')
@section('content')
    <main>
        <x-errors-any></x-errors-any>
        <x-validation-feedback></x-validation-feedback>

        <div class="m-3">
            <form action="{{ route('reseps.store') }}" method="POST">
                @csrf
                <div class="sm:col-span-3">
                    <label for="nama" class="block font-medium leading-6 text-gray-900">Nama Resep</label>
                    <div class="mt-2">
                        <input type="text" name="nama" id="nama" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 mt-3">
                    <div>
                        <label for="porsi">Porsi</label>
                        <input type="number" name="porsi" id="porsi" class="w-full border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1">
                    </div>
                    <div>
                        <label for="satuan">Satuan</label>
                        <input type="text" name="satuan" id="satuan" class="w-full border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1">
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
                        <div class="col-span-3">
                            <input type="text" name="nama_bahan[]" id="nama_bahan-0" class="border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1">
                        </div>
                        <div class="col-span-1">
                            <input type="text" name="jumlah_bahan[]" id="jumlah_bahan-0" class="border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1 w-full">
                        </div>
                        <div class="col-span-1">
                            <input type="text" name="satuan_bahan[]" id="satuan_bahan-0" class="border-0 ring-1 ring-inset ring-gray-300 rounded-md py-1.5 px-1 w-full">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-1">
                    <button type="button" class="p-1 text-white bg-emerald-300 rounded-md" onclick="tambahBahan()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </div>
                <div class="mt-5 text-center">
                    <button type="submit" class="px-3 py-2 text-white bg-emerald-300 border-2 border-emerald-400 rounded-md">Konfirmasi</button>
                </div>
            </form>
        </div>

        <x-back-button :back=$back :backRoute=$backRoute :backRouteParams=$backRouteParams></x-back-button>
    </main>

    <script>
        let index_bahan = 1;
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

            index_bahan++;
        }
    </script>
@endsection
