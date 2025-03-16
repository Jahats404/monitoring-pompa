@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Daftar Pompa
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Pompa</a></li>
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
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Data Spesifikasi Pompa</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPompa">Tambah Pompa</button>
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

                <div class="card-body">
                    <table id="datatables-fixed-header" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">NO</th>
                                <th style="text-align: center;">DESKRIPSI POMPA</th>
                                <th style="text-align: center;">JENIS CAIRAN</th>
                                <th style="text-align: center;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pompa as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->deskripsi_pompa }}</td>
                                    <td>{{ $item->jenis_cairan }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdatePengguna{{ $item->id_pompa }}">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                    
                                            <!-- Form Delete -->
                                            <form action="{{ route('admin.delete.user', ['id' => $item->id_pompa]) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm delete-btn" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
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

                                {{-- MODAL UPDATE PENGGUNA --}}
                                <div class="modal fade" id="modalUpdatePengguna{{ $item->id_pompa }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Perbarui Pengguna</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.update.user',['id' => $item->id_pompa]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body m-3">
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                                {{-- SCRIPT SECTION --}}

                                {{-- SCRIPT EYE ICON FOR PASSWORD --}}
                                <script>
                                    document.getElementById("togglePassword{{ $item->id_pompa }}").addEventListener("click", function () {
                                        let passwordField = document.getElementById("password{{ $item->id_pompa }}");
                                        let icon = this.querySelector("i");
                                    
                                        if (passwordField.type === "password") {
                                            passwordField.type = "text";
                                            icon.classList.remove("fa-eye");
                                            icon.classList.add("fa-eye-slash");
                                        } else {
                                            passwordField.type = "password";
                                            icon.classList.remove("fa-eye-slash");
                                            icon.classList.add("fa-eye");
                                        }
                                    });
                                </script>

                                {{-- SCRIPT SELECT2 --}}
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Inisialisasi Select2 setiap kali modal dibuka
                                        $('div[id^="modalUpdatePengguna"]').on('shown.bs.modal', function () {
                                            $(this).find('.select2Users-update').each(function () {
                                                if (!$(this).hasClass('select2-hidden-accessible')) {
                                                    $(this).select2({
                                                        dropdownParent: $(this).closest(".modal"),
                                                        placeholder: "-- Pilih Role --",
                                                        allowClear: true
                                                    });
                                                }
                                            });
                                        });

                                        // Simpan nilai Select2 ke input hidden sebelum submit
                                        $(".select2Users-update").on("change", function() {
                                            let hiddenField = $(this).data("hidden-id");
                                            $("#" + hiddenField).val($(this).val());
                                        });
                                    });
                                </script>



                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- SCRIPT SECTION --}}

    {{-- SCRIPT EYE ICON FOR PASSWORD --}}
    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            let passwordField = document.getElementById("password");
            let icon = this.querySelector("i");
        
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    </script>

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

    {{-- SCRIPT SELECT2 --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi Select2
            $(".select2Users").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "-- Pilih Role --",
                        dropdownParent: $(this).parent()
                    });
            });

            // Jika ada error Laravel, tambahkan class is-invalid ke Select2
            if ($(".select2Users").hasClass("is-invalid")) {
                $(".select2Users").next('.select2-container').addClass("is-invalid");
            }
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
