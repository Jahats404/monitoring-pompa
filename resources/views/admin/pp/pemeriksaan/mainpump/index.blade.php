@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Pemeriksaan Pompa {{ $unitPompa->pompa->deskripsi_pompa }}
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $unitPompa->jenis_pompa }}</li>
            </ol>
        </nav>
    </div>

    <style>
        hr{
            margin-top: 30px;
        }
    </style>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h5 class="card-title mb-0">{{ $unitPompa->jenis_pompa }}</h5>
                
                    <div class="d-flex align-items-center gap-2">
                        <form id="formTanggal" method="get" class="d-flex align-items-center gap-2">
                            <input 
                                type="date" 
                                id="tanggalInput"
                                name="tanggal_pemeriksaan"
                                class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror"
                                value="{{ old('tanggal_pemeriksaan', $tanggal) }}"
                                placeholder="Tanggal Pemeriksaan"
                            >
                    
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-fw fa-mouse-pointer"></i>
                            </button>
                        </form>
                    </div>
                
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('admin.list.pompa', $idLokasi) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-fw fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                </div>
                

                <div class="card-body">
                    <form action="{{ route('admin.store.pemeriksaan.mainpump') }}" method="POST">
                        @csrf
                        <input type="hidden" name="unit_pompa_id" value="{{ $idUnitPompa }}">
                        <input type="hidden" name="tanggal_pemeriksaan" value="{{ $tanggal }}">
                
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                
                            {{-- Pemeriksaan --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        <strong></strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                
                                        {{-- RPM --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">RPM</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="rpm" value="{{ old('rpm',$pemeriksaan?->rpm) }}"
                                                    class="form-control @error('rpm') is-invalid @enderror" placeholder="RPM">
                                                @error('rpm')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                
                                        {{-- FLOW RATE --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">FLOW RATE</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="flow_rate" value="{{ old('flow_rate',$pemeriksaan?->flow_rate) }}"
                                                    class="form-control @error('flow_rate') is-invalid @enderror"
                                                    placeholder="FLOW RATE">
                                                @error('flow_rate')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                
                                        {{-- SUCTION --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">SUCTION</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="suction" value="{{ old('suction',$pemeriksaan?->suction) }}"
                                                    class="form-control @error('suction') is-invalid @enderror"
                                                    placeholder="SUCTION (kg/cm2)(min. 5)">
                                                @error('suction')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                
                                        {{-- DISCHARGE --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">DISCHARGE</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="discharge" value="{{ old('discharge',$pemeriksaan?->discharge) }}"
                                                    class="form-control @error('discharge') is-invalid @enderror"
                                                    placeholder="DISCHARGE (kg/cm2)(max. 60)">
                                                @error('discharge')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                
                                        {{-- PRODUK PEMOMPAAN --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">PRODUK PEMOMPAAN</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="produk_pemompaan" value="{{ old('produk_pemompaan',$pemeriksaan?->produk_pemompaan) }}"
                                                    class="form-control @error('produk_pemompaan') is-invalid @enderror"
                                                    placeholder="PRODUK PEMOMPAAN">
                                                @error('produk_pemompaan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                
                            {{-- De motor --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTwo">
                                        <strong>DE MOTOR (mm/s)</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- de_motor_v --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Good Vibration 2,3 - 4,5 mm/s (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_motor_v" value="{{ old('de_motor_v',$pemeriksaan?->de_motor_v) }}"
                                                    class="form-control @error('de_motor_v') is-invalid @enderror"
                                                    placeholder="Good Vibration 2,3 - 4,5 mm/s (V)">
                                                @error('de_motor_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_motor_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Alarm : 5,5 - 6,5 mm/s (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_motor_h" value="{{ old('de_motor_h',$pemeriksaan?->de_motor_h) }}"
                                                    class="form-control @error('de_motor_h') is-invalid @enderror"
                                                    placeholder="Alarm : 5,5 - 6,5 mm/s (H)">
                                                @error('de_motor_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_motor_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">High Vibration > 7,1 mm/s (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_motor_a" value="{{ old('de_motor_a',$pemeriksaan?->de_motor_a) }}"
                                                    class="form-control @error('de_motor_a') is-invalid @enderror"
                                                    placeholder="High Vibration > 7,1 mm/s (A)">
                                                @error('de_motor_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_motor_temperatur_casing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperatur (65-83˚C) ISO 10816-3</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_motor_temperatur_casing" value="{{ old('de_motor_temperatur_casing',$pemeriksaan?->de_motor_temperatur_casing) }}"
                                                    class="form-control @error('de_motor_temperatur_casing') is-invalid @enderror"
                                                    placeholder="Temperatur (65-83˚C) ISO 10816-3">
                                                @error('de_motor_temperatur_casing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            {{-- Nde Motor --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseThree">
                                        <strong>NDE MOTOR (mm/s)</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- nde_motor_v --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Good Vibration 2,3 - 4,5 mm/s (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_motor_v" value="{{ old('nde_motor_v',$pemeriksaan?->nde_motor_v) }}"
                                                    class="form-control @error('nde_motor_v') is-invalid @enderror"
                                                    placeholder="Good Vibration 2,3 - 4,5 mm/s (V)">
                                                @error('nde_motor_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_motor_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Alarm : 5,5 - 6,5 mm/s (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_motor_h" value="{{ old('nde_motor_h',$pemeriksaan?->nde_motor_h) }}"
                                                    class="form-control @error('nde_motor_h') is-invalid @enderror"
                                                    placeholder="Alarm : 5,5 - 6,5 mm/s (H)">
                                                @error('nde_motor_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_motor_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">High Vibration > 7,1 mm/s (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_motor_a" value="{{ old('nde_motor_a',$pemeriksaan?->nde_motor_a) }}"
                                                    class="form-control @error('nde_motor_a') is-invalid @enderror"
                                                    placeholder="High Vibration > 7,1 mm/s (A)">
                                                @error('nde_motor_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_motor_temperatur_casing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperatur (65-83˚C) ISO 10816-3</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_motor_temperatur_casing" value="{{ old('nde_motor_temperatur_casing',$pemeriksaan?->nde_motor_temperatur_casing) }}"
                                                    class="form-control @error('nde_motor_temperatur_casing') is-invalid @enderror"
                                                    placeholder="Temperatur (65-83˚C) ISO 10816-3">
                                                @error('nde_motor_temperatur_casing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- IN GEARBOX  DE (mm/s) --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseFour">
                                        <strong>IN GEARBOX  DE (mm/s)</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- in_gearbox_de_v --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Good Vibration 2,3 - 4,5 mm/s (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="in_gearbox_de_v" value="{{ old('in_gearbox_de_v',$pemeriksaan?->in_gearbox_de_v) }}"
                                                    class="form-control @error('in_gearbox_de_v') is-invalid @enderror"
                                                    placeholder="Good Vibration 2,3 - 4,5 mm/s (V)">
                                                @error('in_gearbox_de_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- in_gearbox_de_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Alarm : 5,5 - 6,5 mm/s (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="in_gearbox_de_h" value="{{ old('in_gearbox_de_h',$pemeriksaan?->in_gearbox_de_h) }}"
                                                    class="form-control @error('in_gearbox_de_h') is-invalid @enderror"
                                                    placeholder="Alarm : 5,5 - 6,5 mm/s (H)">
                                                @error('in_gearbox_de_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- in_gearbox_de_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">High Vibration > 7,1 mm/s (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="in_gearbox_de_a" value="{{ old('in_gearbox_de_a',$pemeriksaan?->in_gearbox_de_a) }}"
                                                    class="form-control @error('in_gearbox_de_a') is-invalid @enderror"
                                                    placeholder="High Vibration > 7,1 mm/s (A)">
                                                @error('in_gearbox_de_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- in_gearbox_de_temperatur_casing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperatur (65-83˚C) ISO 10816-3</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="in_gearbox_de_temperatur_casing" value="{{ old('in_gearbox_de_temperatur_casing',$pemeriksaan?->in_gearbox_de_temperatur_casing) }}"
                                                    class="form-control @error('in_gearbox_de_temperatur_casing') is-invalid @enderror"
                                                    placeholder="Temperatur (65-83˚C) ISO 10816-3">
                                                @error('in_gearbox_de_temperatur_casing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- IN GEARBOX NDE (mm/s) --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseFive">
                                        <strong>IN GEARBOX NDE (mm/s)</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- in_gearbox_nde_v --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Good Vibration 2,3 - 4,5 mm/s (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="in_gearbox_nde_v" value="{{ old('in_gearbox_nde_v',$pemeriksaan?->in_gearbox_nde_v) }}"
                                                    class="form-control @error('in_gearbox_nde_v') is-invalid @enderror"
                                                    placeholder="Good Vibration 2,3 - 4,5 mm/s (V)">
                                                @error('in_gearbox_nde_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- in_gearbox_nde_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Alarm : 5,5 - 6,5 mm/s (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="in_gearbox_nde_h" value="{{ old('in_gearbox_nde_h',$pemeriksaan?->in_gearbox_nde_h) }}"
                                                    class="form-control @error('in_gearbox_nde_h') is-invalid @enderror"
                                                    placeholder="Alarm : 5,5 - 6,5 mm/s (H)">
                                                @error('in_gearbox_nde_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- in_gearbox_nde_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">High Vibration > 7,1 mm/s (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="in_gearbox_nde_a" value="{{ old('in_gearbox_nde_a',$pemeriksaan?->in_gearbox_nde_a) }}"
                                                    class="form-control @error('in_gearbox_nde_a') is-invalid @enderror"
                                                    placeholder="High Vibration > 7,1 mm/s (A)">
                                                @error('in_gearbox_nde_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- in_gearbox_nde_temperatur_casing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperatur (65-83˚C) ISO 10816-3</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="in_gearbox_nde_temperatur_casing" value="{{ old('in_gearbox_nde_temperatur_casing',$pemeriksaan?->in_gearbox_nde_temperatur_casing) }}"
                                                    class="form-control @error('in_gearbox_nde_temperatur_casing') is-invalid @enderror"
                                                    placeholder="Temperatur (65-83˚C) ISO 10816-3">
                                                @error('in_gearbox_nde_temperatur_casing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- OUT GEARBOX DE (mm/s) --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseSix">
                                        <strong>OUT GEARBOX DE (mm/s)</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- out_gearbox_de_v --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Good Vibration 2,3 - 4,5 mm/s (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="out_gearbox_de_v" value="{{ old('out_gearbox_de_v',$pemeriksaan?->out_gearbox_de_v) }}"
                                                    class="form-control @error('out_gearbox_de_v') is-invalid @enderror"
                                                    placeholder="Good Vibration 2,3 - 4,5 mm/s (V)">
                                                @error('out_gearbox_de_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- out_gearbox_de_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Alarm : 5,5 - 6,5 mm/s (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="out_gearbox_de_h" value="{{ old('out_gearbox_de_h',$pemeriksaan?->out_gearbox_de_h) }}"
                                                    class="form-control @error('out_gearbox_de_h') is-invalid @enderror"
                                                    placeholder="Alarm : 5,5 - 6,5 mm/s (H)">
                                                @error('out_gearbox_de_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- out_gearbox_de_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">High Vibration > 7,1 mm/s (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="out_gearbox_de_a" value="{{ old('out_gearbox_de_a',$pemeriksaan?->out_gearbox_de_a) }}"
                                                    class="form-control @error('out_gearbox_de_a') is-invalid @enderror"
                                                    placeholder="High Vibration > 7,1 mm/s (A)">
                                                @error('out_gearbox_de_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- out_gearbox_de_temperatur_casing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperatur (65-83˚C) ISO 10816-3</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="out_gearbox_de_temperatur_casing" value="{{ old('out_gearbox_de_temperatur_casing',$pemeriksaan?->out_gearbox_de_temperatur_casing) }}"
                                                    class="form-control @error('out_gearbox_de_temperatur_casing') is-invalid @enderror"
                                                    placeholder="Temperatur (65-83˚C) ISO 10816-3">
                                                @error('out_gearbox_de_temperatur_casing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- OUT GEARBOX NDE (mm/s) --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseSeven">
                                        <strong>OUT GEARBOX NDE (mm/s)</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- out_gearbox_nde_v --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Good Vibration 2,3 - 4,5 mm/s (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="out_gearbox_nde_v" value="{{ old('out_gearbox_nde_v',$pemeriksaan?->out_gearbox_nde_v) }}"
                                                    class="form-control @error('out_gearbox_nde_v') is-invalid @enderror"
                                                    placeholder="Good Vibration 2,3 - 4,5 mm/s (V)">
                                                @error('out_gearbox_nde_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- out_gearbox_nde_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Alarm : 5,5 - 6,5 mm/s (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="out_gearbox_nde_h" value="{{ old('out_gearbox_nde_h',$pemeriksaan?->out_gearbox_nde_h) }}"
                                                    class="form-control @error('out_gearbox_nde_h') is-invalid @enderror"
                                                    placeholder="Alarm : 5,5 - 6,5 mm/s (H)">
                                                @error('out_gearbox_nde_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- out_gearbox_nde_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">High Vibration > 7,1 mm/s (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="out_gearbox_nde_a" value="{{ old('out_gearbox_nde_a',$pemeriksaan?->out_gearbox_nde_a) }}"
                                                    class="form-control @error('out_gearbox_nde_a') is-invalid @enderror"
                                                    placeholder="High Vibration > 7,1 mm/s (A)">
                                                @error('out_gearbox_nde_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- out_gearbox_nde_temperatur_casing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperatur (65-83˚C) ISO 10816-3</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="out_gearbox_nde_temperatur_casing" value="{{ old('out_gearbox_nde_temperatur_casing',$pemeriksaan?->out_gearbox_nde_temperatur_casing) }}"
                                                    class="form-control @error('out_gearbox_nde_temperatur_casing') is-invalid @enderror"
                                                    placeholder="Temperatur (65-83˚C) ISO 10816-3">
                                                @error('out_gearbox_nde_temperatur_casing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- DE PUMP (mm/s) --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseEight" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseEight">
                                        <strong>DE PUMP (mm/s)</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- de_pump_v --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Good Vibration 2,3 - 4,5 mm/s (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_pump_v" value="{{ old('de_pump_v',$pemeriksaan?->de_pump_v) }}"
                                                    class="form-control @error('de_pump_v') is-invalid @enderror"
                                                    placeholder="Good Vibration 2,3 - 4,5 mm/s (V)">
                                                @error('de_pump_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_pump_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Alarm : 5,5 - 6,5 mm/s (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_pump_h" value="{{ old('de_pump_h',$pemeriksaan?->de_pump_h) }}"
                                                    class="form-control @error('de_pump_h') is-invalid @enderror"
                                                    placeholder="Alarm : 5,5 - 6,5 mm/s (H)">
                                                @error('de_pump_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_pump_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">High Vibration > 7,1 mm/s (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_pump_a" value="{{ old('de_pump_a',$pemeriksaan?->de_pump_a) }}"
                                                    class="form-control @error('de_pump_a') is-invalid @enderror"
                                                    placeholder="High Vibration > 7,1 mm/s (A)">
                                                @error('de_pump_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_pump_temperatur_casing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperatur (65-83˚C) ISO 10816-3</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_pump_temperatur_casing" value="{{ old('de_pump_temperatur_casing',$pemeriksaan?->de_pump_temperatur_casing) }}"
                                                    class="form-control @error('de_pump_temperatur_casing') is-invalid @enderror"
                                                    placeholder="Temperatur (65-83˚C) ISO 10816-3">
                                                @error('de_pump_temperatur_casing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- NDE PUMP (mm/s) --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseNine" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseNine">
                                        <strong>NDE PUMP (mm/s)</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- nde_pump_v --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Good Vibration 2,3 - 4,5 mm/s (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_pump_v" value="{{ old('nde_pump_v',$pemeriksaan?->nde_pump_v) }}"
                                                    class="form-control @error('nde_pump_v') is-invalid @enderror"
                                                    placeholder="Good Vibration 2,3 - 4,5 mm/s (V)">
                                                @error('nde_pump_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_pump_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Alarm : 5,5 - 6,5 mm/s (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_pump_h" value="{{ old('nde_pump_h',$pemeriksaan?->nde_pump_h) }}"
                                                    class="form-control @error('nde_pump_h') is-invalid @enderror"
                                                    placeholder="Alarm : 5,5 - 6,5 mm/s (H)">
                                                @error('nde_pump_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_pump_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">High Vibration > 7,1 mm/s (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_pump_a" value="{{ old('nde_pump_a',$pemeriksaan?->nde_pump_a) }}"
                                                    class="form-control @error('nde_pump_a') is-invalid @enderror"
                                                    placeholder="High Vibration > 7,1 mm/s (A)">
                                                @error('nde_pump_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_pump_temperatur_casing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperatur (65-83˚C) ISO 10816-3</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_pump_temperatur_casing" value="{{ old('nde_pump_temperatur_casing',$pemeriksaan?->nde_pump_temperatur_casing) }}"
                                                    class="form-control @error('nde_pump_temperatur_casing') is-invalid @enderror"
                                                    placeholder="Temperatur (65-83˚C) ISO 10816-3">
                                                @error('nde_pump_temperatur_casing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- THRUSTBEARING (mm/s) --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTeen" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTeen">
                                        <strong>THRUSTBEARING (mm/s)</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTeen" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- thurstbearing_v --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Good Vibration 2,3 - 4,5 mm/s (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="thurstbearing_v" value="{{ old('thurstbearing_v',$pemeriksaan?->thurstbearing_v) }}"
                                                    class="form-control @error('thurstbearing_v') is-invalid @enderror"
                                                    placeholder="Good Vibration 2,3 - 4,5 mm/s (V)">
                                                @error('thurstbearing_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- thurstbearing_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Alarm : 5,5 - 6,5 mm/s (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="thurstbearing_h" value="{{ old('thurstbearing_h',$pemeriksaan?->thurstbearing_h) }}"
                                                    class="form-control @error('thurstbearing_h') is-invalid @enderror"
                                                    placeholder="Alarm : 5,5 - 6,5 mm/s (H)">
                                                @error('thurstbearing_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- thurstbearing_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">High Vibration > 7,1 mm/s (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="thurstbearing_a" value="{{ old('thurstbearing_a',$pemeriksaan?->thurstbearing_a) }}"
                                                    class="form-control @error('thurstbearing_a') is-invalid @enderror"
                                                    placeholder="High Vibration > 7,1 mm/s (A)">
                                                @error('thurstbearing_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- thurstbearing_temperatur_casing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperatur (65-83˚C) ISO 10816-3</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="thurstbearing_temperatur_casing" value="{{ old('thurstbearing_temperatur_casing',$pemeriksaan?->thurstbearing_temperatur_casing) }}"
                                                    class="form-control @error('thurstbearing_temperatur_casing') is-invalid @enderror"
                                                    placeholder="Temperatur (65-83˚C) ISO 10816-3">
                                                @error('thurstbearing_temperatur_casing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- temperatur_cassing --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">Temperature  Cassing  (°C)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="temperatur_cassing" value="{{ old('temperatur_cassing',$pemeriksaan?->temperatur_cassing) }}"
                                                    class="form-control @error('temperatur_cassing') is-invalid @enderror"
                                                    placeholder="Temperature  Cassing  (°C)">
                                                @error('temperatur_cassing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- Footer --}}
                        <div class="card-footer">
                            @if (Auth::user()->role_id == '1')
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>


    {{-- SCRIPT SECTION --}}

    {{-- SCRIPT DATATABLE --}}
    <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Fixed Header
			$("#datatables-fixed-header").DataTable({
				fixedHeader: true,
				pageLength: 25,
                // scrollX: true,
                responsive: true,
			});
		});
	</script>

    {{-- SCRIPT TANGGAL --}}
    <script>
        document.getElementById('formTanggal').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah form kirim langsung
    
            const tanggal = document.getElementById('tanggalInput').value;
            const unitPompaId = "{{ $idUnitPompa }}";
    
            if (tanggal) {
                const url = `/adm/pemeriksaan-pompa/${unitPompaId}/${tanggal}`;
                window.location.href = url;
            } else {
                alert('Silakan pilih tanggal terlebih dahulu.');
            }
        });
    </script>

    @include('validation.notifications')
@endsection
