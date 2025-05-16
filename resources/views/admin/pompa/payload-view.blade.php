@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Daftar Pompa
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Pompa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Spesifikasi Pompa</li>
            </ol>
        </nav>
        <div class="mb-4 row">
            <div class="col-md-10 mb-2 mb-md-0">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Pompa...">
            </div>
            <div class="col-md-2 text-md-end">
                @if (!Auth::user()->role_id == '3')
                    
                @endif
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPompa">
                    Tambah Pompa
                </button>
            </div>
        </div>
        
    </div>

    {{-- MODAL TAMBAH Pengguna --}}
    <div class="modal fade" id="modalTambahPompa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pompa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.store.pompa') }}" method="post">
                    @csrf
                    <div class="modal-body m-3">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Pompa <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi_pompa') is-invalid @enderror" name="deskripsi_pompa"
                            placeholder="Deskripsi Pompa" rows="3">{{ old('deskripsi_pompa') }}</textarea>
                            @error('deskripsi_pompa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Cairan <span class="text-danger">*</span></label>
                            <input type="jenis_cairan" name="jenis_cairan" 
                            class="form-control @error('jenis_cairan') is-invalid @enderror" placeholder="Jenis Cairan"
                            value="{{ old('jenis_cairan') }}">
                            @error('jenis_cairan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="color: red;">

                        <div class="mb-3">
                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                            <input type="brand" name="brand" 
                            class="form-control @error('brand') is-invalid @enderror" placeholder="Brand"
                            value="{{ old('brand') }}">
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Kode Bearing Pompa</label>
                            <input type="kode_bearing_pompa" name="kode_bearing_pompa" 
                            class="form-control @error('kode_bearing_pompa') is-invalid @enderror" placeholder="Kode Bearing Pompa"
                            value="{{ old('kode_bearing_pompa') }}">
                            @error('kode_bearing_pompa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis <span class="text-danger">*</span></label>
                            <input type="jenis" name="jenis" 
                            class="form-control @error('jenis') is-invalid @enderror" placeholder="Jenis"
                            value="{{ old('jenis') }}">
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kapasitas Pompa</label>
                            <input type="kapasitas_pompa" name="kapasitas_pompa" 
                            class="form-control @error('kapasitas_pompa') is-invalid @enderror" placeholder="Kapasitas Pompa"
                            value="{{ old('kapasitas_pompa') }}">
                            @error('kapasitas_pompa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="color: red;">

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <input type="type" name="type" 
                            class="form-control @error('type') is-invalid @enderror" placeholder="Type"
                            value="{{ old('type') }}">
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No Series <span class="text-danger">*</span></label>
                            <input type="no_series" name="no_series" 
                            class="form-control @error('no_series') is-invalid @enderror" placeholder="No Series"
                            value="{{ old('no_series') }}">
                            @error('no_series')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kapasitas Penggerak</label>
                            <input type="Kapasitas_penggerak" name="Kapasitas_penggerak" 
                            class="form-control @error('Kapasitas_penggerak') is-invalid @enderror" placeholder="Kapasitas Penggerak"
                            value="{{ old('Kapasitas_penggerak') }}">
                            @error('Kapasitas_penggerak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ampere</label>
                            <input type="ampere" name="ampere" 
                            class="form-control @error('ampere') is-invalid @enderror" placeholder="Ampere"
                            value="{{ old('ampere') }}">
                            @error('ampere')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Pengadaan</label>
                            <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                <input type="number" name="tahun_pengadaan" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum" />
                                <div class="input-group-text" data-target="#datetimepicker-minimum" data-toggle="datetimepicker">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Bearing Elmot</label>
                            <input type="kode_bearing_elmot" name="kode_bearing_elmot" 
                            class="form-control @error('kode_bearing_elmot') is-invalid @enderror" placeholder="Kode Bearing Elmot"
                            value="{{ old('kode_bearing_elmot') }}">
                            @error('kode_bearing_elmot')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="color: red;">

                        <div class="mb-3">
                            <label class="form-label">Merk <span class="text-danger">*</span></label>
                            <input type="merk" name="merk" 
                            class="form-control @error('merk') is-invalid @enderror" placeholder="Merk"
                            value="{{ old('merk') }}">
                            @error('merk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No Seri <span class="text-danger">*</span></label>
                            <input type="no_seri" name="no_seri" 
                            class="form-control @error('no_seri') is-invalid @enderror" placeholder="No Seri"
                            value="{{ old('no_seri') }}">
                            @error('no_seri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row" id="pompaList">
        @foreach ($pompa as $item)
            <div class="col-md-6 mb-4 pompa-item">
                <div class="card shadow-lg border-0 custom-card">
                    <div class="card-header text-white bg-gradient-primary d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white">Pompa #{{ $item->id_pompa }}</h5>
                        <span class="badge bg-light text-dark">{{ $item->jenis_cairan }}</span>
                    </div>
                    <div class="card-body">
                        <p class="border-bottom pb-2"><strong>Deskripsi:</strong> {{ $item->deskripsi_pompa }}</p>
                        <p class="border-bottom pb-2"><strong>Brand:</strong> {{ optional($item->detail_pompa)->brand ?? '-' }}</p>
                        <p class="border-bottom pb-2"><strong>Jenis:</strong> {{ optional($item->detail_pompa)->jenis ?? '-' }}</p>
                        <p class="border-bottom pb-2"><strong>Kapasitas Penggerak:</strong> {{ optional($item->spesifikasi_penggerak)->kapasitas ?? '-' }} KW</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.payload.pompa.detail', ['id' => $item->id_pompa]) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                            <small class="text-muted">Updated: {{ $item->updated_at->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .custom-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border-radius: 10px;
            overflow: hidden;
        }
    
        .custom-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
    
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
        }
    
        .btn-outline-primary {
            transition: all 0.3s ease-in-out;
        }
    
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
    </style>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let items = document.querySelectorAll('.pompa-item');
        
            items.forEach(function(item) {
                let text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>

    {{-- SCRIPT DATETIME PICKER --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#datetimepicker-minimum').datetimepicker({
                format: 'YYYY', // Hanya menampilkan tahun
                viewMode: 'years', // Memulai tampilan langsung ke pemilihan tahun
                minDate: moment().subtract(100, 'years'), // Batas minimal tahun (opsional)
                maxDate: moment().add(10, 'years') // Batas maksimal tahun (opsional)
            });
        });
    </script>
@include('validation.notifications')
@endsection
