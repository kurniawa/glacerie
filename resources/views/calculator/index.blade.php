@extends('layouts.main')
@section('content')
    <main>
        <x-errors-any></x-errors-any>
        <x-validation-feedback></x-validation-feedback>
        <div class="mt-3 mx-2">
            <table>
                <thead>
                    <tr>
                        <th>Resep</th><th>Porsi</th>
                    </tr>
                </thead>
                <tbody id="calculator-resep">
                    <tr>
                        <td>
                            <input type="text" name="nama[]" id="nama-0" autocomplete="given-name" class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 w-44">
                            <input type="hidden" name="resep_id[]" id="resep_id-0" class="resep_binder">
                        </td>
                        <td><input type="text" name="porsi[]" id="porsi-0" readonly class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 bg-gray-200 w-20"></td>
                        <td><input type="text" name="jumlah[]" id="jumlah-0" readonly class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 bg-gray-200 w-20"></td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-end mt-1">
                <button class="bg-emerald-300 text-white p-1 rounded-md" onclick="addResepKalkulator()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="mt-3 mx-2">
            <table id="table-bahan-yang-dibutuhkan" class="w-full">
                {{-- @foreach ($bahans as $bahan)
                <tr id="tr_bahan-{{ $bahan->id }}"><td>{{ $bahan->nama }}</td><td id="jumlah_bahan-{{ $bahan->id }}"></td><td id="satuan_bahan-{{ $bahan->id }}"></td></tr>
                @endforeach --}}
            </table>
        </div>
    </main>

    <script>
        const reseps = {!! json_encode($reseps, JSON_HEX_TAG) !!};
        const bahans = {!! json_encode($bahans, JSON_HEX_TAG) !!};
        const resep_bahans = {!! json_encode($resep_bahans, JSON_HEX_TAG) !!};
        console.log(resep_bahans);

        let index_resep_kalkulator = 1;
        function addResepKalkulator() {
            let html_resep_kalkulator = `
            <tr>
                <td>
                    <input type="text" name="nama[]" id="nama-${index_resep_kalkulator}" autocomplete="given-name" class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 w-44">
                    <input type="hidden" name="resep_id[]" id="resep_id-${index_resep_kalkulator}" class="resep_binder">
                </td>
                <td><input type="text" name="porsi[]" id="porsi-${index_resep_kalkulator}" readonly class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 bg-gray-200 w-20"></td>
                <td><input type="text" name="jumlah[]" id="jumlah-${index_resep_kalkulator}" readonly class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 bg-gray-200 w-20"></td>
            </tr>
            `;

            document.getElementById('calculator-resep').insertAdjacentHTML('beforeend', html_resep_kalkulator);
            setAutocompleteResepKalkulator(index_resep_kalkulator);
            index_resep_kalkulator++;
        }

        setAutocompleteResepKalkulator(0);

        function setAutocompleteResepKalkulator(index) {
            $(`#nama-${index}`).autocomplete({
                source: reseps,
                select: (event, ui) => {
                    // console.log(ui)
                    // console.log(ui.item)
                    // console.log(ui.item.id)
                    // let related_resep_bahans = resep_bahans.filter((o) => {return o.resep_id == ui.item.id});
                    // console.log(related_resep_bahans);
                    // related_resep_bahans.forEach(resep_bahan => {
                    //     let jumlah_bahan_el = document.getElementById(`jumlah_bahan-${resep_bahan.bahan_id}`);
                    //     let satuan_bahan_el = document.getElementById(`satuan_bahan-${resep_bahan.bahan_id}`);
                    //     let jumlah_bahan = parseFloat(resep_bahan.jumlah);
                    //     let decimal_jumlah_bahan = jumlah_bahan % 1;
                    //     jumlah_bahan = Math.trunc(jumlah_bahan) * 100 / 100;
                    //     if (decimal_jumlah_bahan != 0) {
                    //         jumlah_bahan = jumlah_bahan + decimal_jumlah_bahan;
                    //     }

                    //     if (jumlah_bahan_el.textContent == '') {
                    //         jumlah_bahan_el.textContent = jumlah_bahan;
                    //     }
                    //     if (satuan_bahan_el.textContent == '') {
                    //         satuan_bahan_el.textContent = resep_bahan.satuan;
                    //     }
                    //     console.log(parseFloat(resep_bahan.jumlah) % 1);
                    // });

                    let resep_id_el = document.getElementById(`resep_id-${index}`);
                    resep_id_el.value = ui.item.id;
                    let porsi = `${ui.item.porsi} ${ui.item.satuan}`;
                    document.getElementById(`porsi-${index}`).value = porsi;
                    let reseps = document.querySelectorAll('.resep_binder');
                    let data_bahans = [];

                    reseps.forEach(resep => {
                        // console.log(resep.value);
                        let related_resep_bahans = resep_bahans.filter((o) => {return o.resep_id == resep.value});
                        // console.log('related_resep_bahans');
                        // console.log(related_resep_bahans);
                        related_resep_bahans.forEach(resep_bahan => {
                            let related_bahan = bahans.filter((o) => o.id == resep_bahan.bahan_id);
                            // console.log('related_bahan');
                            // console.log(related_bahan);
                            related_bahan = related_bahan[0];
                            let bahan_sudah_terinput = data_bahans.filter((o) => o.id == related_bahan.id);
                            // console.log('bahan_sudah_terinput')
                            // console.log(bahan_sudah_terinput);
                            if (bahan_sudah_terinput.length === 0) {
                                let satuan_1 = null;
                                let satuan_2 = null;
                                let satuan_3 = null;
                                let satuan_4 = null;
                                let satuan_5 = null;

                                if (resep_bahan.satuan_1 !== null) {
                                    satuan_1 = resep_bahan.satuan_1;
                                }
                                if (resep_bahan.satuan_2 !== null) {
                                    satuan_2 = resep_bahan.satuan_2;
                                }
                                if (resep_bahan.satuan_3 !== null) {
                                    satuan_3 = resep_bahan.satuan_3;
                                }
                                if (resep_bahan.satuan_4 !== null) {
                                    satuan_4 = resep_bahan.satuan_4;
                                }
                                if (resep_bahan.satuan_5 !== null) {
                                    satuan_5 = resep_bahan.satuan_5;
                                }

                                let jumlah_1 = null;
                                let jumlah_2 = null;
                                let jumlah_3 = null;
                                let jumlah_4 = null;
                                let jumlah_5 = null;

                                if (resep_bahan.jumlah_1 !== null) {
                                    jumlah_1 = pangkasDesimal(resep_bahan.jumlah_1);
                                }
                                if (resep_bahan.jumlah_2 !== null) {
                                    jumlah_2 = pangkasDesimal(resep_bahan.jumlah_2);
                                }
                                if (resep_bahan.jumlah_3 !== null) {
                                    jumlah_3 = pangkasDesimal(resep_bahan.jumlah_3);
                                }
                                if (resep_bahan.jumlah_4 !== null) {
                                    jumlah_4 = pangkasDesimal(resep_bahan.jumlah_4);
                                }
                                if (resep_bahan.jumlah_5 !== null) {
                                    jumlah_5 = pangkasDesimal(resep_bahan.jumlah_5);
                                }

                                let data_bahan = {
                                    'id': related_bahan.id,
                                    'nama': related_bahan.nama,
                                    'satuan_1': satuan_1,
                                    'satuan_2': satuan_2,
                                    'satuan_3': satuan_3,
                                    'satuan_4': satuan_4,
                                    'satuan_5': satuan_5,
                                    'jumlah_1': jumlah_1,
                                    'jumlah_2': jumlah_2,
                                    'jumlah_3': jumlah_3,
                                    'jumlah_4': jumlah_4,
                                    'jumlah_5': jumlah_5,
                                };
                                data_bahans.push(data_bahan);
                            } else {
                                let found_index = data_bahans.findIndex( x => x.id == related_bahan.id);
                                if (data_bahans[found_index].satuan_1 !== null && data_bahans[found_index].satuan_1 == resep_bahan.satuan_1) {
                                    let jumlah_old = 0;

                                    if (data_bahans[found_index].jumlah_1 !== null) {
                                        jumlah_old = data_bahans[found_index].jumlah_1;
                                    }

                                    data_bahans[found_index].jumlah_1 = jumlah_old + pangkasDesimal(resep_bahan.jumlah_1);
                                }

                                if (data_bahans[found_index].satuan_2 !== null && data_bahans[found_index].satuan_2 == resep_bahan.satuan_2) {
                                    let jumlah_old = 0;

                                    if (data_bahans[found_index].jumlah_2 !== null) {
                                        jumlah_old = data_bahans[found_index].jumlah_2;
                                    }

                                    data_bahans[found_index].jumlah_2 = jumlah_old + pangkasDesimal(resep_bahan.jumlah_2);
                                }

                                if (data_bahans[found_index].satuan_3 !== null && data_bahans[found_index].satuan_3 == resep_bahan.satuan_3) {
                                    let jumlah_old = 0;

                                    if (data_bahans[found_index].jumlah_3 !== null) {
                                        jumlah_old = data_bahans[found_index].jumlah_3;
                                    }

                                    data_bahans[found_index].jumlah_3 = jumlah_old + pangkasDesimal(resep_bahan.jumlah_3);
                                }

                                if (data_bahans[found_index].satuan_4 !== null && data_bahans[found_index].satuan_4 == resep_bahan.satuan_4) {
                                    let jumlah_old = 0;

                                    if (data_bahans[found_index].jumlah_4 !== null) {
                                        jumlah_old = data_bahans[found_index].jumlah_4;
                                    }

                                    data_bahans[found_index].jumlah_4 = jumlah_old + pangkasDesimal(resep_bahan.jumlah_4);
                                }

                                if (data_bahans[found_index].satuan_5 !== null && data_bahans[found_index].satuan_5 == resep_bahan.satuan_5) {
                                    let jumlah_old = 0;

                                    if (data_bahans[found_index].jumlah_5 !== null) {
                                        jumlah_old = data_bahans[found_index].jumlah_5;
                                    }

                                    data_bahans[found_index].jumlah_5 = jumlah_old + pangkasDesimal(resep_bahan.jumlah_5);
                                }
                            }
                        });
                    });
                    console.log('data_bahans')
                    console.log(data_bahans);

                    printKeTableBahanYangDibutuhkan(data_bahans);
                }
            });
        }

        function pangkasDesimal(str_value) {
            let float_value = parseFloat(str_value);
            let get_decimal = float_value % 1;
            let get_real_number = Math.trunc(float_value) * 100 / 100;
            if (get_decimal === 0) {
                return get_real_number;
            } else {
                return get_real_number + get_decimal;
            }
        }

        function printKeTableBahanYangDibutuhkan(data_bahans) {
            let html_data_bahan = '';
            data_bahans.forEach(data_bahan => {
                let jumlah = '';
                let satuan = '';

                if (data_bahan.satuan_1 !== null) {
                    satuan = data_bahan.satuan_1;
                    jumlah = data_bahan.jumlah_1;
                } else if (data_bahan.satuan_2 !== null) {
                    satuan = data_bahan.satuan_2;
                    jumlah = data_bahan.jumlah_2;
                } else if (data_bahan.satuan_3 !== null) {
                    satuan = data_bahan.satuan_3;
                    jumlah = data_bahan.jumlah_3;
                } else if (data_bahan.satuan_4 !== null) {
                    satuan = data_bahan.satuan_4;
                    jumlah = data_bahan.jumlah_4;
                } else if (data_bahan.satuan_5 !== null) {
                    satuan = data_bahan.satuan_5;
                    jumlah = data_bahan.jumlah_5;
                }

                html_data_bahan += `<tr>
                    <td>${data_bahan.nama}</td><td>${jumlah}</td><td>${satuan}</td>
                </tr>`;
            });
            document.getElementById('table-bahan-yang-dibutuhkan').innerHTML = html_data_bahan;
        }
    </script>
@endsection
