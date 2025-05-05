@extends('master')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white text-center py-3">
                <h3 class="mb-0 text-white fw-bold">🔹 Detail Pompa #{{ $pompa->id_pompa }}</h3>
            </div>
            <div class="card-body">
                <div class="tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">Informasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab" role="tab">Dokumentasi</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-1" role="tabpanel">
                            <h4 class="fw-bold text-primary"><i class="fas fa-info-circle"></i> Informasi Umum</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID Pompa</th>
                                            <td>{{ $pompa->id_pompa }}</td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td>{{ $pompa->deskripsi_pompa }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Cairan</th>
                                            <td>{{ $pompa->jenis_cairan }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h4 class="fw-bold text-primary mt-4"><i class="fas fa-cogs"></i> Detail Pompa</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Brand</th>
                                            <td>{{ optional($pompa->detail_pompa)->brand ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis</th>
                                            <td>{{ optional($pompa->detail_pompa)->jenis ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kapasitas Pompa</th>
                                            <td>{{ optional($pompa->detail_pompa)->kapasitas ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kode Bearing Pompa</th>
                                            <td>{{ optional($pompa->detail_pompa)->kode_bearing_pompa ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h4 class="fw-bold text-primary mt-4"><i class="fas fa-bolt"></i> Spesifikasi Penggerak</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Type</th>
                                            <td>{{ optional($pompa->spesifikasi_penggerak)->type ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Series</th>
                                            <td>{{ optional($pompa->spesifikasi_penggerak)->no_series ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kapasitas Penggerak</th>
                                            <td>{{ optional($pompa->spesifikasi_penggerak)->kapasitas ?? '-' }} KW</td>
                                        </tr>
                                        <tr>
                                            <th>Ampere</th>
                                            <td>{{ optional($pompa->spesifikasi_penggerak)->ampere ?? '-' }} A</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Pengadaan</th>
                                            <td>{{ optional($pompa->spesifikasi_penggerak)->tahun_pengadaan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kode Bearing Elmot</th>
                                            <td>{{ optional($pompa->spesifikasi_penggerak)->kode_bearing_elmot ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h4 class="fw-bold text-primary mt-4"><i class="fas fa-toolbox"></i> Mechanical Seal</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Merk</th>
                                            <td>{{ optional($pompa->mechanical_seal)->merk ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Seri</th>
                                            <td>{{ optional($pompa->mechanical_seal)->no_seri ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4 text-center">
                                <a href="{{ route('admin.payload.pompa') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                                @if (Auth::user()->role_id == '1' || Auth::user()->role_id == '2')
                                <button data-bs-toggle="modal" data-bs-target="#modalUpdatePompa" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button>
                                <form action="{{ route('admin.payload.pompa.delete',['id' => $pompa->id_pompa]) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-2" role="tabpanel">
                            <h4 class="tab-title">Dokumentasi</h4>
                            <div class="col-12 col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        @if ($pompa->file_pompa)
                                        <img src="{{ asset('storage/' . $pompa->file_pompa) }}" class="img-fluid rounded" alt="...">
                                        @else
                                        <p>Tidak ada dokumentasi!</p>
                                        @endif
                                        <form action="{{ route('admin.payload.pompa.dokumentasi', ['id' => $pompa->id_pompa]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="form-label w-100">Upload Gambar</label>
                                                <input name="file_pompa" type="file">
                                            </div>
                                            @if (Auth::user()->role_id == '2')
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    {{-- MODAL UPDATE POMPA --}}
    <div class="modal fade" id="modalUpdatePompa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Perbarui Pompa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.payload.pompa.update',['id' => $pompa->id_pompa]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body m-3">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Pompa <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi_pompa') is-invalid @enderror" name="deskripsi_pompa"
                            placeholder="Deskripsi Pompa" rows="3">{{ old('deskripsi_pompa',$pompa->deskripsi_pompa) }}</textarea>
                            @error('deskripsi_pompa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Cairan <span class="text-danger">*</span></label>
                            <input type="jenis_cairan" name="jenis_cairan" 
                            class="form-control @error('jenis_cairan') is-invalid @enderror" placeholder="Jenis Cairan"
                            value="{{ old('jenis_cairan',$pompa->jenis_cairan) }}">
                            @error('jenis_cairan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="color: red;">

                        <div class="mb-3">
                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                            <input type="brand" name="brand" 
                            class="form-control @error('brand') is-invalid @enderror" placeholder="Brand"
                            value="{{ old('brand',$pompa->detail_pompa->brand) }}">
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Kode Bearing Pompa</label>
                            <input type="kode_bearing_pompa" name="kode_bearing_pompa" 
                            class="form-control @error('kode_bearing_pompa') is-invalid @enderror" placeholder="Kode Bearing Pompa"
                            value="{{ old('kode_bearing_pompa',$pompa->detail_pompa->kode_bearing_pompa) }}">
                            @error('kode_bearing_pompa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis <span class="text-danger">*</span></label>
                            <input type="jenis" name="jenis" 
                            class="form-control @error('jenis') is-invalid @enderror" placeholder="Jenis"
                            value="{{ old('jenis',$pompa->detail_pompa->jenis) }}">
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kapasitas Pompa</label>
                            <input type="kapasitas_pompa" name="kapasitas_pompa" 
                            class="form-control @error('kapasitas_pompa') is-invalid @enderror" placeholder="Kapasitas Pompa"
                            value="{{ old('kapasitas_pompa',$pompa->detail_pompa->kapasitas_pompa) }}">
                            @error('kapasitas_pompa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="color: red;">

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <input type="type" name="type" 
                            class="form-control @error('type') is-invalid @enderror" placeholder="Type"
                            value="{{ old('type',$pompa->spesifikasi_penggerak->type) }}">
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No Series <span class="text-danger">*</span></label>
                            <input type="no_series" name="no_series" 
                            class="form-control @error('no_series') is-invalid @enderror" placeholder="No Series"
                            value="{{ old('no_series',$pompa->spesifikasi_penggerak->no_series) }}">
                            @error('no_series')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kapasitas Penggerak</label>
                            <input type="Kapasitas_penggerak" name="Kapasitas_penggerak" 
                            class="form-control @error('Kapasitas_penggerak') is-invalid @enderror" placeholder="Kapasitas Penggerak"
                            value="{{ old('Kapasitas_penggerak',$pompa->spesifikasi_penggerak->kapasitas_penggerak) }}">
                            @error('Kapasitas_penggerak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ampere</label>
                            <input type="ampere" name="ampere" 
                            class="form-control @error('ampere') is-invalid @enderror" placeholder="Ampere"
                            value="{{ old('ampere',$pompa->spesifikasi_penggerak->ampere) }}">
                            @error('ampere')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Pengadaan</label>
                            <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                <input type="number" name="tahun_pengadaan" class="form-control datetimepicker-input" value="{{ old('tahun_pengadaan',$pompa->spesifikasi_penggerak->tahun_pengadaan) }}" data-target="#datetimepicker-minimum" />
                                <div class="input-group-text" data-target="#datetimepicker-minimum" data-toggle="datetimepicker">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Bearing Elmot</label>
                            <input type="kode_bearing_elmot" name="kode_bearing_elmot" 
                            class="form-control @error('kode_bearing_elmot') is-invalid @enderror" placeholder="Kode Bearing Elmot"
                            value="{{ old('kode_bearing_elmot',$pompa->spesifikasi_penggerak->kode_bearing_elmot) }}">
                            @error('kode_bearing_elmot')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="color: red;">

                        <div class="mb-3">
                            <label class="form-label">Merk <span class="text-danger">*</span></label>
                            <input type="merk" name="merk" 
                            class="form-control @error('merk') is-invalid @enderror" placeholder="Merk"
                            value="{{ old('merk',$pompa->mechanical_seal->merk) }}">
                            @error('merk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No Seri <span class="text-danger">*</span></label>
                            <input type="no_seri" name="no_seri" 
                            class="form-control @error('no_seri') is-invalid @enderror" placeholder="No Seri"
                            value="{{ old('no_seri',$pompa->mechanical_seal->no_seri) }}">
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

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #3993f3, #0056b3);
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        table th {
            background-color: #f8f9fa;
            width: 30%;
        }

        table.table-striped tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn i {
            margin-right: 5px;
        }
    </style>

    {{-- SweetAlert Delete --}}
    <script>
        // Pilih semua tombol dengan kelas delete-btn
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // Mencegah pengiriman form langsung
    
                const form = this.closest('form'); // Ambil form terdekat dari tombol yang diklik
    
                Swal.fire({
                    title: 'Apakah data ini akan dihapus?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form jika pengguna mengonfirmasi
                    }
                });
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
