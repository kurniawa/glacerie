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
                            <input type="hidden" name="resep_id[]" id="resep_id-0" class="selector-resep_id">
                        </td>
                        <td><input type="text" name="porsi[]" id="porsi-0" readonly class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 bg-gray-200 w-20"></td>
                        <td><input type="number" name="factor[]" id="factor-0" step="1" min="1" value="1" onchange="calculateResepGabungan()" class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 w-20 selector-factor"></td>
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
            <div id="data-bahan-gabungan" class="grid grid-cols-12"></div>
        </div>

        <x-back-button :back=$back :backRoute=$backRoute :backRouteParams=$backRouteParams></x-back-button>
    </main>

    <script>
        const reseps = {!! json_encode($reseps, JSON_HEX_TAG) !!};
        const bahans = {!! json_encode($bahans, JSON_HEX_TAG) !!};
        const resep_bahans = {!! json_encode($resep_bahans, JSON_HEX_TAG) !!};
        // console.log(resep_bahans);

        let index_resep_kalkulator = 1;
        function addResepKalkulator() {
            let html_resep_kalkulator = `
            <tr>
                <td>
                    <input type="text" name="nama[]" id="nama-${index_resep_kalkulator}" autocomplete="given-name" class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 w-44">
                    <input type="hidden" name="resep_id[]" id="resep_id-${index_resep_kalkulator}" class="selector-resep_id">
                </td>
                <td><input type="text" name="porsi[]" id="porsi-${index_resep_kalkulator}" readonly class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 bg-gray-200 w-20"></td>
                <td><input type="number" name="factor[]" id="factor-${index_resep_kalkulator}" step="1" min="1" value="1" onchange="calculateResepGabungan()" class="rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 w-20 selector-factor"></td>
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
                    let resep_id_el = document.getElementById(`resep_id-${index}`);
                    resep_id_el.value = ui.item.id;
                    let porsi = `${ui.item.porsi}`;
                    document.getElementById(`porsi-${index}`).value = porsi;
                    console.log(porsi);

                    calculateResepGabungan();
                }
            });
        }

        function calculateResepGabungan() {
            let reseps = document.querySelectorAll('.selector-resep_id');
            let factors = document.querySelectorAll('.selector-factor');
            let data_bahans = [];

            for (let i = 0; i < reseps.length; i++) {
                let related_resep_bahans = resep_bahans.filter((o) => {return o.resep_id == reseps[i].value});
                let factor = factors[i].value;
                related_resep_bahans.forEach(resep_bahan => {
                    let related_bahan = bahans.filter((o) => o.id == resep_bahan.bahan_id);
                    related_bahan = related_bahan[0];
                    let bahan_sudah_terinput = data_bahans.filter((o) => o.id == related_bahan.id);
                    // if (related_bahan.nama == 'Rumbutter') {
                    //     let pangkas_desimal = pangkasDesimal(resep_bahan.jumlah);
                    //     console.log('resep_bahan.jumlah');
                    //     console.log(resep_bahan.jumlah);
                    //     console.log('factor');
                    //     console.log(factor);
                    //     console.log('pangkas_desimal');
                    //     console.log(pangkas_desimal);
                    //     console.log('pangkas_desimal * factor')
                    //     console.log(pangkas_desimal * factor)
                    // }
                    if (bahan_sudah_terinput.length === 0) {
                        let satuan = resep_bahan.satuan;
                        let jumlah = pangkasDesimal(resep_bahan.jumlah * factor);

                        let data_jumlah = [{
                            'jumlah': jumlah,
                            'satuan': satuan,
                        }];

                        let data_bahan = {
                            'id': related_bahan.id,
                            'nama': related_bahan.nama,
                            'data_jumlah': data_jumlah,
                        };
                        data_bahans.push(data_bahan);
                    } else {
                        let found_index = data_bahans.findIndex( x => x.id == related_bahan.id);
                        let ada_satuan_sama = false;
                        data_bahans[found_index].data_jumlah.forEach(element => {
                            if (resep_bahan.satuan == element.satuan) {
                                ada_satuan_sama = true;
                                element.jumlah = element.jumlah + pangkasDesimal(resep_bahan.jumlah * factor);
                            }
                        });

                        if (!ada_satuan_sama) {
                            let data_jumlah = {
                                'jumlah': pangkasDesimal(resep_bahan.jumlah * factor),
                                'satuan': resep_bahan.satuan,
                            };

                            data_bahans[found_index].data_jumlah.push(data_jumlah);
                        }
                    }
                });
            }

            // console.log('data_bahans')
            // console.log(data_bahans);

            printKeTableBahanYangDibutuhkan(data_bahans);
        }

        function pangkasDesimal(str_value) {
            let float_value = parseFloat(str_value);
            let get_decimal = float_value % 1;
            // console.log(get_decimal);
            // console.log(get_decimal.toString());
            if (get_decimal.toString().length > 4) {
                get_decimal = get_decimal.toFixed(2);
            }
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
                // let jumlah = '';
                // let satuan = '';

                // if (data_bahan.satuan_1 !== null) {
                //     satuan = data_bahan.satuan_1;
                //     jumlah = data_bahan.jumlah_1;
                // } else if (data_bahan.satuan_2 !== null) {
                //     satuan = data_bahan.satuan_2;
                //     jumlah = data_bahan.jumlah_2;
                // } else if (data_bahan.satuan_3 !== null) {
                //     satuan = data_bahan.satuan_3;
                //     jumlah = data_bahan.jumlah_3;
                // } else if (data_bahan.satuan_4 !== null) {
                //     satuan = data_bahan.satuan_4;
                //     jumlah = data_bahan.jumlah_4;
                // } else if (data_bahan.satuan_5 !== null) {
                //     satuan = data_bahan.satuan_5;
                //     jumlah = data_bahan.jumlah_5;
                // }
                let html_jumlah = '';
                let html_satuan = '';
                data_bahan.data_jumlah.forEach(element => {
                    html_jumlah += `<div>${element.jumlah}</div>`;
                    html_satuan += `<div>${element.satuan}</div>`
                });

                // html_data_bahan += `<tr>
                //     <td>${data_bahan.nama}</td><td>${html_jumlah}</td><td>${html_satuan}</td>
                // </tr>`;
                html_data_bahan += `<div class="col-span-6 border-b my-2">${data_bahan.nama}</div>
                <div class="col-span-3 border-b my-2">${html_jumlah}</div>
                <div class="col-span-3 border-b my-2">${html_satuan}</div>`;
            });
            // document.getElementById('table-bahan-yang-dibutuhkan').innerHTML = html_data_bahan;
            document.getElementById('data-bahan-gabungan').innerHTML = html_data_bahan;
        }
    </script>
@endsection
