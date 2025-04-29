@php
    use Carbon\Carbon;

    $carbon = Carbon::parse($bulan);
    $headers = [];
    for ($i = 1; $i <= $jumlahHari; $i++) {
        $headers[] = $carbon->copy()->day($i)->format('Y-m-d');
    }

    $fieldListMainPump = [
        'rpm' => 'RPM',
        'flow_rate' => 'Flow Rate',
        'suction' => 'Suction',
        'discharge' => 'Discharge',
        'produk_pemompaan' => 'Produk Pemompaan',
        'de_motor_v' => 'DE Motor V', 'de_motor_h' => 'DE Motor H', 'de_motor_a' => 'DE Motor A', 'de_motor_temperatur_casing' => 'DE Motor Temperatur Casing',
        'nde_motor_v' => 'NDE Motor V', 'nde_motor_h' => 'NDE Motor H', 'nde_motor_a' => 'NDE Motor A', 'nde_motor_temperatur_casing' => 'NDE Motor Temperatur Casing',
        'in_gearbox_de_v' => 'In Gearbox DE V', 'in_gearbox_de_h' => 'In Gearbox DE H', 'in_gearbox_de_a' => 'In Gearbox DE A', 'in_gearbox_de_temperatur_casing' => 'In Gearbox DE Temperatur Casing',
        'in_gearbox_nde_v' => 'In Gearbox NDE V', 'in_gearbox_nde_h' => 'In Gearbox NDE H', 'in_gearbox_nde_a' => 'In Gearbox NDE A', 'in_gearbox_nde_temperatur_casing' => 'In Gearbox NDE Temperatur Casing',
        'out_gearbox_de_v' => 'Out Gearbox DE V', 'out_gearbox_de_h' => 'Out Gearbox DE H', 'out_gearbox_de_a' => 'Out Gearbox DE A', 'out_gearbox_de_temperatur_casing' => 'Out Gearbox DE Temperatur Casing',
        'out_gearbox_nde_v' => 'Out Gearbox NDE V', 'out_gearbox_nde_h' => 'Out Gearbox NDE H', 'out_gearbox_nde_a' => 'Out Gearbox NDE A', 'out_gearbox_nde_temperatur_casing' => 'Out Gearbox NDE Temperatur Casing',
        'de_pump_v' => 'DE Pump V', 'de_pump_h' => 'DE Pump H', 'de_pump_a' => 'DE Pump A', 'de_pump_temperatur_casing' => 'DE Pump Temperatur Casing',
        'nde_pump_v' => 'NDE Pump V', 'nde_pump_h' => 'NDE Pump H', 'nde_pump_a' => 'NDE Pump A', 'nde_pump_temperatur_casing' => 'NDE Pump Temperatur Casing',
        'thurstbearing_v' => 'Thurstbearing V', 'thurstbearing_h' => 'Thurstbearing H', 'thurstbearing_a' => 'Thurstbearing A', 'thurstbearing_temperatur_casing' => 'Thurstbearing Temperatur Casing',
        'temperatur_cassing' => 'Temperatur Cassing',
    ];

    $fieldListChargingPump = [
        'flow_rate' => 'Flow Rate', 'suction' => 'Suction', 'discharge' => 'Discharge',
        'de_motor_v' => 'DE Motor V', 'de_motor_h' => 'DE Motor H', 'de_motor_a' => 'DE Motor A',
        'nde_motor_v' => 'NDE Motor V', 'nde_motor_h' => 'NDE Motor H', 'nde_motor_a' => 'NDE Motor A',
        'de_pump_v' => 'DE Pump V', 'de_pump_h' => 'DE Pump H', 'de_pump_a' => 'DE Pump A',
        'nde_pump_v' => 'NDE Pump V', 'nde_pump_h' => 'NDE Pump H', 'nde_pump_a' => 'NDE Pump A',
        'temp_casing_pump' => 'Temperatur Casing Pump', 'temp_mech_seal' => 'Temperatur Mechanical Seal',
        'temp_bearing_pump_de' => 'Temperatur Bearing Pump DE', 'temp_bearing_pump_nde' => 'Temperatur Bearing Pump NDE',
        'temp_bearing_motor_de' => 'Temperatur Bearing Motor DE', 'temp_bearing_motor_nde' => 'Temperatur Bearing Motor NDE',
        'produk_pemompaan' => 'Produk Pemompaan',
    ];
@endphp

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 3px;
            text-align: center;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    {{-- TAMPILKAN MAIN PUMP --}}
    @if($mainPump->count())
        @foreach($mainPump as $unitId => $data)
            @php
                $fieldChunks = collect($fieldListMainPump)->chunk(ceil(count($fieldListMainPump)/2));
            @endphp

            @foreach($fieldChunks as $index => $chunk)
                <h4 align="center">
                    HASIL MONITORING POMPA {{ $data->first()->unit_pompa->pompa->deskripsi_pompa }}, {{ $data->first()->lokasi->nama_lokasi }}<br>
                    Bulan {{ $carbon->translatedFormat('F Y') }}
                </h4>
                <table>
                    <thead>
                        <tr>
                            <th rowspan="3">PEMERIKSAAN</th>
                            <th colspan="{{ $jumlahHari }}" style="text-transform: uppercase;">{{ $carbon->translatedFormat('F Y') }}</th>
                        </tr>
                        <tr><th colspan="{{ $jumlahHari }}">TANGGAL:</th></tr>
                        <tr>
                            @foreach ($headers as $tanggal)
                                <th>{{ \Carbon\Carbon::parse($tanggal)->day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chunk as $field => $label)
                            <tr>
                                <td>{{ $label }}</td>
                                @foreach ($headers as $tanggal)
                                    @php
                                        $value = $data->firstWhere('tanggal_pemeriksaan', $tanggal)?->$field;
                                    @endphp
                                    <td>{{ $value ?? '-' }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (!$loop->last)
                    <div class="page-break"></div>
                @endif
            @endforeach
            <div class="page-break"></div>
        @endforeach
    @endif

    {{-- TAMPILKAN CHARGING PUMP --}}
    @if($chargingPump->count())
        @foreach($chargingPump as $unitId => $data)
            @php
                $fieldChunks = collect($fieldListChargingPump)->chunk(ceil(count($fieldListChargingPump)/2));
            @endphp

            @foreach($fieldChunks as $index => $chunk)
                <h4 align="center">
                    HASIL MONITORING POMPA {{ $data->first()->unit_pompa->pompa->deskripsi_pompa }}, {{ $data->first()->lokasi->nama_lokasi }}<br>
                    Bulan {{ $carbon->translatedFormat('F Y') }}
                </h4>
                <table>
                    <thead>
                        <tr>
                            <th rowspan="3">PEMERIKSAAN</th>
                            <th colspan="{{ $jumlahHari }}" style="text-transform: uppercase;">{{ $carbon->translatedFormat('F Y') }}</th>
                        </tr>
                        <tr><th colspan="{{ $jumlahHari }}">TANGGAL:</th></tr>
                        <tr>
                            @foreach ($headers as $tanggal)
                                <th>{{ \Carbon\Carbon::parse($tanggal)->day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chunk as $field => $label)
                            <tr>
                                <td>{{ $label }}</td>
                                @foreach ($headers as $tanggal)
                                    @php
                                        $value = $data->firstWhere('tanggal_pemeriksaan', $tanggal)?->$field;
                                    @endphp
                                    <td>{{ $value ?? '-' }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (!$loop->last)
                    <div class="page-break"></div>
                @endif
            @endforeach
            <div class="page-break"></div>
        @endforeach
    @endif

</body>
</html>

