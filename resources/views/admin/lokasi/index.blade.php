@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Daftar Lokasi
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Lokasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Lokasi</li>
            </ol>
        </nav>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Daftar Lokasi</h5>
                    @if (Auth::user()->role_id == '2')
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahLokasi">Tambah Lokasi</button>
                    @endif
                </div>

                {{-- MODAL TAMBAH LOKASI --}}
                <div class="modal fade" id="modalTambahLokasi" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Lokasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.store.lokasi') }}" method="post">
                                @csrf
                                <div class="modal-body m-3">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lokasi" 
                                        class="form-control @error('nama_lokasi') is-invalid @enderror" placeholder="Nama Lokasi"
                                        value="{{ old('nama_lokasi') }}">
                                        @error('nama_lokasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Lokasi <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('alamat_lokasi') is-invalid @enderror" name="alamat_lokasi"
                                        placeholder="Alamat Lokasi" rows="3">{{ old('alamat_lokasi') }}</textarea>
                                        @error('alamat_lokasi')
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

                <div class="card-body">
                    <table id="datatables-fixed-header" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">NO</th>
                                <th style="text-align: center;">NAMA LOKASI</th>
                                <th style="text-align: center;">ALAMAT LOKASI</th>
                                @if (Auth::user()->role_id == '2')
                                    <th style="text-align: center;">AKSI</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lokasi as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_lokasi }}</td>
                                    <td>{{ $item->alamat_lokasi }}</td>
                                    @if (Auth::user()->role_id == '2')
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdateLokasi{{ $item->id_lokasi }}">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                    
                                            <!-- Form Delete -->
                                            <form action="{{ route('admin.delete.lokasi', ['id' => $item->id_lokasi]) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm delete-btn" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>

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

                                {{-- MODAL UPDATE LOKASI --}}
                                <div class="modal fade" id="modalUpdateLokasi{{ $item->id_lokasi }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Perbarui Lokasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.update.lokasi',['id' => $item->id_lokasi]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body m-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                                                        <input type="text" name="nama_lokasi" 
                                                        class="form-control @error('nama_lokasi') is-invalid @enderror" placeholder="Nama Lokasi"
                                                        value="{{ old('nama_lokasi',$item->nama_lokasi) }}">
                                                        @error('nama_lokasi')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat Lokasi <span class="text-danger">*</span></label>
                                                        <textarea class="form-control @error('alamat_lokasi') is-invalid @enderror" name="alamat_lokasi"
                                                        placeholder="Alamat Lokasi" rows="3">{{ old('alamat_lokasi',$item->alamat_lokasi) }}</textarea>
                                                        @error('alamat_lokasi')
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- SCRIPT SECTION --}}
    <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Fixed Header
			$("#datatables-fixed-header").DataTable({
                responsive: true,
				fixedHeader: true,
				pageLength: 25,
                // scrollX:true,
			});
		});
	</script>

    @include('validation.notifications')
@endsection
