@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Pemeriksaan Pompa {{ $unitPompa->pompa->deskripsi_pompa }}
        </h1>
        <div class="d-flex align-items-center justify-content-between">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">{{ $unitPompa->jenis_pompa }}</li>
                </ol>
            </nav>
            <a href="{{ route('admin.list.pompa', $idLokasi) }}" class="btn btn-outline-success">
                <i class="fas fa-fw fa-arrow-alt-circle-left"></i> Kembali
            </a>
        </div>
    </div>

    <style>
        hr{
            margin-top: 30px;
        }
    </style>
    
    <div class="row">
        @if (Auth::user()->role_id == '1')
            
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
                </div>
                

                <div class="card-body">
                    <form action="{{ route('admin.store.pemeliharaan') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="mb-3">
                            <label class="form-label">Dokumentasi <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('file_pemeliharaan') is-invalid @enderror" name="file_pemeliharaan">
                            @error('file_pemeliharaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        {{-- Footer --}}
                        <div class="card-footer">
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
                    @if (Auth::user()->role_id == '2' || Auth::user()->role_id == '3')
                    <a href="{{ route('admin.export.pemeliharaan', ['id' => $idUnitPompa]) }}" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1"><i class="align-middle me-1 fas fa-fw fa-file-excel"></i>Export</a>
                    @endif
                </div>

                <div class="card-body">
                    <table id="datatables-pemeliharaan" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">NO</th>
                                <th style="text-align: center;">TANGGAL</th>
                                <th style="text-align: center;">URAIAN PEMELIHARAAN</th>
                                <th style="text-align: center;">KETERANGAN</th>
                                <th style="text-align: center;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemeliharaanAll as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal_pemeliharaan }}</td>
                                    <td>{{ $item->uraian_pemeliharaan }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalDokumentasi{{ $item->id_pemeliharaan }}">
                                            Dokumentasi
                                        </button>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="modalDokumentasi{{ $item->id_pemeliharaan }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Dokumentasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.dokumentasi.pemeliharaan', ['id' => $item->id_pemeliharaan]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body m-3">
                                        <div class="mb-3">
                                            @if ($item->file_pemeliharaan)
                                            <img src="{{ asset('storage/' . $item->file_pemeliharaan) }}" class="img-fluid rounded" alt="...">
                                            @else
                                            <p>Tidak ada Dokumentasi!</p>
                                            @endif
                                            <label class="form-label">Dokumentasi <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control @error('file_pemeliharaan') is-invalid @enderror" name="file_pemeliharaan">
                                            @error('file_pemeliharaan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-12 col-md-12">
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
        @endif
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
                const url = `/adm/pemeliharaan-pompa/${unitPompaId}/${tanggal}`;
                window.location.href = url;
            } else {
                alert('Silakan pilih tanggal terlebih dahulu.');
            }
        });
    </script>

    @include('validation.notifications')
@endsection
