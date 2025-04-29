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
        <div class="col-12 col-md-5">

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h5 class="card-title mb-0">{{ $unitPompa->jenis_pompa }}</h5>
                
                    <div class="d-flex align-items-center gap-2">
                        <form id="formTanggal" method="get" class="d-flex align-items-center gap-2">
                            <input 
                                type="date" 
                                id="tanggalInput"
                                name="tanggal_pemeliharaan"
                                class="form-control @error('tanggal_pemeliharaan') is-invalid @enderror"
                                value="{{ old('tanggal_pemeliharaan', $tanggal) }}"
                                placeholder="Tanggal Pemeriksaan"
                            >
                    
                            <button type="submit" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1">
                                <i class="fas fa-mouse-pointer"></i>
                                <span>Submit</span>
                            </button>
                            
                        </form>
                    </div>
                
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('admin.list.pompa', $idLokasi) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-fw fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                </div>
                

                <div class="card-body">
                    <form action="{{ route('admin.store.pemeliharaan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="unit_pompa_id" value="{{ $idUnitPompa }}">
                        <input type="hidden" name="tanggal_pemeliharaan" value="{{ $tanggal }}">

                        <div class="mb-3">
                            <label class="form-label">Uraian Pemeliharaan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('uraian_pemeliharaan') is-invalid @enderror" name="uraian_pemeliharaan"
                            placeholder="Uraian Pemeliharaan" rows="3">{{ old('uraian_pemeliharaan',$pemeliharaan?->uraian_pemeliharaan) }}</textarea>
                            @error('uraian_pemeliharaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                            placeholder="Keterangan" rows="3">{{ old('keterangan',$pemeliharaan?->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Daftar Seluruh Pemeliharaan Pompa {{ $unitPompa->pompa->deskripsi_pompa }}</h5>
                    <a href="{{ route('admin.export.pemeliharaan', ['id' => $idUnitPompa]) }}" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1""><i class="align-middle me-1 fas fa-fw fa-file-excel"></i>Export</a>
                </div>

                <div class="card-body">
                    <table id="datatables-pemeliharaan" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">NO</th>
                                <th style="text-align: center;">TANGGAL</th>
                                <th style="text-align: center;">URAIAN PEMELIHARAAN</th>
                                <th style="text-align: center;">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemeliharaanAll as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal_pemeliharaan }}</td>
                                    <td>{{ $item->uraian_pemeliharaan }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- SCRIPT SECTION --}}

    {{-- SCRIPT DATATABLE --}}
    <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Fixed Header
			$("#datatables-pemeliharaan").DataTable({
				fixedHeader: true,
				pageLength: 10,
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
                const url = `/admin/pemeliharaan-pompa/${unitPompaId}/${tanggal}`;
                window.location.href = url;
            } else {
                alert('Silakan pilih tanggal terlebih dahulu.');
            }
        });
    </script>

    @include('validation.notifications')
@endsection
