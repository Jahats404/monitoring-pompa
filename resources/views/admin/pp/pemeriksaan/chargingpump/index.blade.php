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
                    <form action="{{ route('admin.store.pemeriksaan.chargingpump') }}" method="POST">
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
                
                                    </div>
                                </div>
                            </div>
                
                            {{-- DE MOTOR (mm/s) --}}
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
                                            <label class="col-form-label col-sm-3 text-sm-end">DE MOTOR (mm/s) (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_motor_v" value="{{ old('de_motor_v',$pemeriksaan?->de_motor_v) }}"
                                                    class="form-control @error('de_motor_v') is-invalid @enderror"
                                                    placeholder="DE MOTOR (mm/s) (V)">
                                                @error('de_motor_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_motor_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">DE MOTOR (mm/s) (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_motor_h" value="{{ old('de_motor_h',$pemeriksaan?->de_motor_h) }}"
                                                    class="form-control @error('de_motor_h') is-invalid @enderror"
                                                    placeholder="DE MOTOR (mm/s) (H)">
                                                @error('de_motor_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_motor_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">DE MOTOR (mm/s) (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_motor_a" value="{{ old('de_motor_a',$pemeriksaan?->de_motor_a) }}"
                                                    class="form-control @error('de_motor_a') is-invalid @enderror"
                                                    placeholder="DE MOTOR (mm/s) (A)">
                                                @error('de_motor_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            {{-- NDE MOTOR (mm/s) --}}
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
                                            <label class="col-form-label col-sm-3 text-sm-end">NDE MOTOR (mm/s) (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_motor_v" value="{{ old('nde_motor_v',$pemeriksaan?->nde_motor_v) }}"
                                                    class="form-control @error('nde_motor_v') is-invalid @enderror"
                                                    placeholder="NDE MOTOR (mm/s) (V)">
                                                @error('nde_motor_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_motor_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">NDE MOTOR (mm/s) (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_motor_h" value="{{ old('nde_motor_h',$pemeriksaan?->nde_motor_h) }}"
                                                    class="form-control @error('nde_motor_h') is-invalid @enderror"
                                                    placeholder="NDE MOTOR (mm/s) (H)">
                                                @error('nde_motor_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_motor_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">NDE MOTOR (mm/s) (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_motor_a" value="{{ old('nde_motor_a',$pemeriksaan?->nde_motor_a) }}"
                                                    class="form-control @error('nde_motor_a') is-invalid @enderror"
                                                    placeholder="NDE MOTOR (mm/s) (A)">
                                                @error('nde_motor_a')
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
                                            <label class="col-form-label col-sm-3 text-sm-end">DE PUMP (mm/s) (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_pump_v" value="{{ old('de_pump_v',$pemeriksaan?->de_pump_v) }}"
                                                    class="form-control @error('de_pump_v') is-invalid @enderror"
                                                    placeholder="DE PUMP (mm/s) (V)">
                                                @error('de_pump_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_pump_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">DE PUMP (mm/s) (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_pump_h" value="{{ old('de_pump_h',$pemeriksaan?->de_pump_h) }}"
                                                    class="form-control @error('de_pump_h') is-invalid @enderror"
                                                    placeholder="DE PUMP (mm/s) (H)">
                                                @error('de_pump_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- de_pump_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">DE PUMP (mm/s) (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="de_pump_a" value="{{ old('de_pump_a',$pemeriksaan?->de_pump_a) }}"
                                                    class="form-control @error('de_pump_a') is-invalid @enderror"
                                                    placeholder="DE PUMP (mm/s) (A)">
                                                @error('de_pump_a')
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
                                            <label class="col-form-label col-sm-3 text-sm-end">NDE PUMP (mm/s) (V)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_pump_v" value="{{ old('nde_pump_v',$pemeriksaan?->nde_pump_v) }}"
                                                    class="form-control @error('nde_pump_v') is-invalid @enderror"
                                                    placeholder="NDE PUMP (mm/s) (V)">
                                                @error('nde_pump_v')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_pump_h --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">NDE PUMP (mm/s) (H)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_pump_h" value="{{ old('nde_pump_h',$pemeriksaan?->nde_pump_h) }}"
                                                    class="form-control @error('nde_pump_h') is-invalid @enderror"
                                                    placeholder="NDE PUMP (mm/s) (H)">
                                                @error('nde_pump_h')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- nde_pump_a --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">NDE PUMP (mm/s) (A)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nde_pump_a" value="{{ old('nde_pump_a',$pemeriksaan?->nde_pump_a) }}"
                                                    class="form-control @error('nde_pump_a') is-invalid @enderror"
                                                    placeholder="NDE PUMP (mm/s) (A)">
                                                @error('nde_pump_a')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- TEMP. --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTen" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTen">
                                        <strong>TEMP.</strong>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTen" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        {{-- temp_casing_pump --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">TEMP. CASING PUMP</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="temp_casing_pump" value="{{ old('temp_casing_pump',$pemeriksaan?->temp_casing_pump) }}"
                                                    class="form-control @error('temp_casing_pump') is-invalid @enderror"
                                                    placeholder="TEMP. CASING PUMP">
                                                @error('temp_casing_pump')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- temp_mech_seal --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">TEMP. MECH SEAL</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="temp_mech_seal" value="{{ old('temp_mech_seal',$pemeriksaan?->temp_mech_seal) }}"
                                                    class="form-control @error('temp_mech_seal') is-invalid @enderror"
                                                    placeholder="TEMP. MECH SEAL">
                                                @error('temp_mech_seal')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- temp_bearing_pump_de --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">TEMP. BEARING PUMP DE</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="temp_bearing_pump_de" value="{{ old('temp_bearing_pump_de',$pemeriksaan?->temp_bearing_pump_de) }}"
                                                    class="form-control @error('temp_bearing_pump_de') is-invalid @enderror"
                                                    placeholder="TEMP. BEARING PUMP DE">
                                                @error('temp_bearing_pump_de')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- temp_bearing_pump_nde --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">TEMP. BEARING PUMP NDE</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="temp_bearing_pump_nde" value="{{ old('temp_bearing_pump_nde',$pemeriksaan?->temp_bearing_pump_nde) }}"
                                                    class="form-control @error('temp_bearing_pump_nde') is-invalid @enderror"
                                                    placeholder="TEMP. BEARING PUMP NDE">
                                                @error('temp_bearing_pump_nde')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- temp_bearing_motor_de --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">TEMP. BEARING MOTOR DE</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="temp_bearing_motor_de" value="{{ old('temp_bearing_motor_de',$pemeriksaan?->temp_bearing_motor_de) }}"
                                                    class="form-control @error('temp_bearing_motor_de') is-invalid @enderror"
                                                    placeholder="TEMP. BEARING MOTOR DE">
                                                @error('temp_bearing_motor_de')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- temp_bearing_motor_nde --}}
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-3 text-sm-end">TEMP. BEARING MOTOR NDE</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="temp_bearing_motor_nde" value="{{ old('temp_bearing_motor_nde',$pemeriksaan?->temp_bearing_motor_nde) }}"
                                                    class="form-control @error('temp_bearing_motor_nde') is-invalid @enderror"
                                                    placeholder="TEMP. BEARING MOTOR NDE">
                                                @error('temp_bearing_motor_nde')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- produk_pemompaan --}}
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

                        </div>
                        {{-- Footer --}}
                        <div class="card-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> --}}
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
                const url = `/admin/pemeriksaan-pompa/${unitPompaId}/${tanggal}`;
                window.location.href = url;
            } else {
                alert('Silakan pilih tanggal terlebih dahulu.');
            }
        });
    </script>

    @include('validation.notifications')
@endsection
