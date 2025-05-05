@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Pemeriksaan Pompa di Lokasi {{ $lokasi->nama_lokasi }}
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Daftar Pompa</li>
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
                <img class="card-img-top img-fluid" 
                    src="{{ asset('storage/'. $lokasi->file_lokasi) }}" 
                    alt="Unsplash" 
                    style="max-height: 600px; object-fit: cover;">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Daftar Pompa {{ $lokasi->nama_lokasi }}</h5>
                    @if (Auth::user()->role_id == '2' || Auth::user()->role_id == '3')
                    <div class="d-flex justifiy-content-center">
                        <form method="get" action="{{ route('admin.export.pemeriksaan') }}" class="d-flex align-items-center gap-2" target="_blank">
                            <input type="month" name="bulan" class="form-control" required>
                            <input type="hidden" name="lokasi_id" value="{{ $lokasi->id_lokasi }}">
                    
                            <button type="submit" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-fw fa-file-excel"></i> Export
                            </button>
                        </form>
                        <a href="{{ route('admin.list.lokasi') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-arrow-alt-circle-left"></i> Kembali</a>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <table id="datatables-fixed-header" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">NO</th>
                                {{-- <th style="text-align: center;">LOKASI</th> --}}
                                <th style="text-align: center;">DESKRIPSI POMPA</th>
                                <th style="text-align: center;">JENIS POMPA</th>
                                <th style="text-align: center;">JALUR</th>
                                <th style="text-align: center;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tanggal = Carbon\Carbon::now()->toDateString();
                                // dd($tanggal);
                            @endphp
                            @foreach ($unitPompa as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td>{{ $item->lokasi->nama_lokasi }}</td> --}}
                                    <td>{{ $item->pompa->deskripsi_pompa }}</td>
                                    <td>{{ $item->jenis_pompa }}</td>
                                    <td>{{ $item->jalur ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.pemeriksaan', ['id' => $item->id_unit_pompa, 'tanggal' => $tanggal]) }}" class="btn btn-outline-primary btn-sm">
                                                Pemeriksaan
                                            </a>
                                            <a href="{{ route('admin.pemeliharaan', ['id' => $item->id_unit_pompa, 'tanggal' => $tanggal]) }}" class="btn btn-outline-secondary btn-sm">
                                                Pemeliharaan
                                            </a>
                                        </div>
                                    </td>
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
			$("#datatables-fixed-header").DataTable({
				fixedHeader: true,
				pageLength: 25,
                // scrollX: true,
                responsive: true,
			});
		});
	</script>

    @include('validation.notifications')
@endsection
