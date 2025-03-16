@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Daftar Pengguna
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Pengguna</li>
            </ol>
        </nav>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Daftar Pengguna</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPengguna">Tambah Pengguna</button>
                </div>

                {{-- MODAL TAMBAH Pengguna --}}
                <div class="modal fade" id="modalTambahPengguna" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Pengguna</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.store.user') }}" method="post">
                                @csrf
                                <div class="modal-body m-3">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pengguna <span class="text-danger">*</span></label>
                                        <input type="text" name="name" 
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pengguna"
                                        value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" 
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email"
                                        value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" 
                                                class="form-control @error('password') is-invalid @enderror" 
                                                placeholder="Masukkan password"
                                                value="{{ old('password') }}">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pilih Role <span class="text-danger">*</span></label>
                                        <select class="form-control select2Users @error('role_id') is-invalid @enderror" 
                                            name="role_id">
                                            <option value="">-- Pilih Role --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id_role }}" 
                                                    {{ old('role_id') == $role->id_role ? 'selected' : '' }}>
                                                    {{ $role->level }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
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
                                <th style="text-align: center;">NAMA</th>
                                <th style="text-align: center;">EMAIL</th>
                                <th style="text-align: center;">ROLE</th>
                                <th style="text-align: center;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role->level }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdatePengguna{{ $item->id }}">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                    
                                            <!-- Form Delete -->
                                            <form action="{{ route('admin.delete.user', ['id' => $item->id]) }}" method="POST" class="delete-form">
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
                                <div class="modal fade" id="modalUpdatePengguna{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Perbarui Pengguna</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.update.user',['id' => $item->id]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body m-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Pengguna <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" 
                                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pengguna"
                                                        value="{{ old('name',$item->name) }}">
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                                        <input type="email" name="email" 
                                                        class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email"
                                                        value="{{ old('email',$item->email) }}">
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="password" id="password{{ $item->id }}" name="password" 
                                                                class="form-control @error('password') is-invalid @enderror" 
                                                                placeholder="Masukkan password"
                                                                value="{{ old('password') }}">
                                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword{{ $item->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            @error('password')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Pilih Role <span class="text-danger">*</span></label>
                                                        <input type="hidden" id="hiddenRoleId-{{ $item->id }}" name="role_id" 
                                                            value="{{ old('role_id', $item->role_id) }}">
                                                        <select id="select2Users-{{ $item->id }}" class="form-control select2Users-update" 
                                                            data-hidden-id="hiddenRoleId-{{ $item->id }}">
                                                            <option value="">-- Pilih Role --</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id_role }}" 
                                                                    {{ old('role_id', $item->role_id) == $role->id_role ? 'selected' : '' }}>
                                                                    {{ $role->level }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('role_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
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



                                {{-- SCRIPT SECTION --}}

                                {{-- SCRIPT EYE ICON FOR PASSWORD --}}
                                <script>
                                    document.getElementById("togglePassword{{ $item->id }}").addEventListener("click", function () {
                                        let passwordField = document.getElementById("password{{ $item->id }}");
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

    @include('validation.notifications')
@endsection
