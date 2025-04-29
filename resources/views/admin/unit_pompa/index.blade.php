@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Unit Pompa
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Pompa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Unit Pompa</li>
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
                    <h5 class="card-title mb-0">Unit Pompa</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahUnitPompa">Tambah Unit</button>
                </div>

                {{-- MODAL TAMBAH Pengguna --}}
                <div class="modal fade" id="modalTambahUnitPompa" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Unit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.store.unitpompa') }}" method="post">
                                @csrf
                                <div class="modal-body m-3">
                                    <div class="mb-3">
                                        <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                                        <select class="form-control select2Lokasi @error('lokasi_id') is-invalid @enderror" 
                                            name="lokasi_id">
                                            <option value="">-- Pilih Lokasi --</option>
                                            @foreach ($lokasis as $lokasi)
                                                <option value="{{ $lokasi->id_lokasi }}" 
                                                    {{ old('lokasi_id') == $lokasi->id_lokasi ? 'selected' : '' }}>
                                                    {{ $lokasi->nama_lokasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('lokasi_id')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pompa <span class="text-danger">*</span></label>
                                        <select class="form-control select2Pompa @error('pompa_id') is-invalid @enderror" 
                                            name="pompa_id">
                                            <option value="">-- Pilih Pompa --</option>
                                            @foreach ($pompas as $pompa)
                                                <option value="{{ $pompa->id_pompa }}" 
                                                    {{ old('pompa_id') == $pompa->id_pompa ? 'selected' : '' }}>
                                                    {{ $pompa->deskripsi_pompa }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pompa_id')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Pompa <span class="text-danger">*</span></label>
                                        <select class="form-control select2-jenisPompa @error('jenis_pompa') is-invalid @enderror" 
                                            name="jenis_pompa" id="jenis_pompa">
                                            <option value="">-- Pilih Jenis Pompa --</option>
                                            <option value="Main Pump" {{ old('jenis_pompa') == 'Main Pump' ? 'selected' : '' }}>Main Pump</option>
                                            <option value="Charging Pump" {{ old('jenis_pompa') == 'Charging Pump' ? 'selected' : '' }}>Charging Pump</option>
                                        </select>
                                        @error('jenis_pompa')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jalur</label>
                                        <input type="jalur" name="jalur" 
                                        class="form-control @error('jalur') is-invalid @enderror" placeholder="Jalur"
                                        value="{{ old('jalur') }}">
                                        @error('jalur')
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
                                <th style="text-align: center;">LOKASI</th>
                                <th style="text-align: center;">DESKRIPSI POMPA</th>
                                <th style="text-align: center;">JENIS POMPA</th>
                                <th style="text-align: center;">JALUR</th>
                                <th style="text-align: center;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unitPompa as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->lokasi->nama_lokasi }}</td>
                                    <td>{{ $item->pompa->deskripsi_pompa }}</td>
                                    <td>{{ $item->jenis_pompa }}</td>
                                    <td>{{ $item->jalur ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdateUnitPompa{{ $item->id_unit_pompa }}">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                    
                                            <!-- Form Delete -->
                                            <form action="{{ route('admin.delete.unitpompa', ['id' => $item->id_unit_pompa]) }}" method="POST" class="delete-form">
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

                                {{-- MODAL UPDATE UNIT POMPA --}}
                                <div class="modal fade" id="modalUpdateUnitPompa{{ $item->id_unit_pompa }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Perbarui Unit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.update.unitpompa',['id' => $item->id_unit_pompa]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body m-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                                                        <select class="form-control select2Users-update @error('lokasi_id') is-invalid @enderror" 
                                                            name="lokasi_id">
                                                            <option value="">-- Pilih Lokasi --</option>
                                                            @foreach ($lokasis as $lokasi)
                                                                <option value="{{ $lokasi->id_lokasi }}" 
                                                                    {{ old('lokasi_id',$item->lokasi_id) == $lokasi->id_lokasi ? 'selected' : '' }}>
                                                                    {{ $lokasi->nama_lokasi }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('lokasi_id')
                                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Pompa <span class="text-danger">*</span></label>
                                                        <select class="form-control select2Users-update @error('pompa_id') is-invalid @enderror" 
                                                            name="pompa_id">
                                                            <option value="">-- Pilih Pompa --</option>
                                                            @foreach ($pompas as $pompa)
                                                                <option value="{{ $pompa->id_pompa }}" 
                                                                    {{ old('pompa_id',$item->pompa_id) == $pompa->id_pompa ? 'selected' : '' }}>
                                                                    {{ $pompa->deskripsi_pompa }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('pompa_id')
                                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Jenis Pompa <span class="text-danger">*</span></label>
                                                        <select class="form-control select2-jenisPompa-update @error('jenis_pompa') is-invalid @enderror" 
                                                            name="jenis_pompa" id="jenis_pompa">
                                                            <option value="">-- Pilih Jenis Pompa --</option>
                                                            <option value="Main Pump" {{ old('jenis_pompa', $item->jenis_pompa) == 'Main Pump' ? 'selected' : '' }}>Main Pump</option>
                                                            <option value="Charging Pump" {{ old('jenis_pompa', $item->jenis_pompa) == 'Charging Pump' ? 'selected' : '' }}>Charging Pump</option>
                                                        </select>
                                                        @error('jenis_pompa')
                                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="mb-3 jalur-container">
                                                        <label class="form-label">Jalur</label>
                                                        <input type="text" name="jalur" 
                                                            class="form-control @error('jalur') is-invalid @enderror" 
                                                            placeholder="Jalur"
                                                            value="{{ old('jalur', $item->jalur) }}">
                                                        @error('jalur')
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



                                {{-- SCRIPT SECTION --}}

                                {{-- SCRIPT EYE ICON FOR PASSWORD --}}
                                <script>
                                    document.getElementById("togglePassword{{ $item->id_unit_pompa }}").addEventListener("click", function () {
                                        let passwordField = document.getElementById("password{{ $item->id_unit_pompa }}");
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
                                        $('div[id^="modalUpdateUnitPompa"]').on('shown.bs.modal', function () {
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

                                {{-- SCRIPT SELECT2 UNTUK JENIS POMPA --}}
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        $('div[id^="modalUpdateUnitPompa"]').on('shown.bs.modal', function () {
                                            let modal = $(this);

                                            // Inisialisasi Select2
                                            modal.find('.select2-jenisPompa-update').each(function () {
                                                if (!$(this).hasClass('select2-hidden-accessible')) {
                                                    $(this).select2({
                                                        dropdownParent: modal,
                                                        placeholder: "-- Pilih Jenis Pompa --",
                                                        allowClear: true
                                                    });
                                                }
                                            });

                                            // Ambil elemen input "Jalur" di dalam modal
                                            let jalurField = modal.find(".jalur-container");
                                            let selectJenisPompa = modal.find(".select2-jenisPompa-update");

                                            // Periksa apakah jenis pompa yang dipilih adalah "Charging Pump"
                                            let selectedValue = selectJenisPompa.val();
                                            if (selectedValue === "Charging Pump") {
                                                jalurField.show();
                                            } else {
                                                jalurField.hide();
                                            }

                                            // Event listener saat jenis pompa berubah
                                            selectJenisPompa.on("change", function() {
                                                if ($(this).val() === "Charging Pump") {
                                                    jalurField.show();
                                                } else {
                                                    jalurField.hide();
                                                }
                                            });
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
            $(".select2Lokasi").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "-- Pilih Lokasi --",
                        dropdownParent: $(this).parent()
                    });
            });

            // Jika ada error Laravel, tambahkan class is-invalid ke Select2
            if ($(".select2Lokasi").hasClass("is-invalid")) {
                $(".select2Lokasi").next('.select2-container').addClass("is-invalid");
            }
        });
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi Select2
            $(".select2Pompa").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "-- Pilih Pompa --",
                        dropdownParent: $(this).parent()
                    });
            });

            // Jika ada error Laravel, tambahkan class is-invalid ke Select2
            if ($(".select2Pompa").hasClass("is-invalid")) {
                $(".select2Pompa").next('.select2-container').addClass("is-invalid");
            }
        });
    </script>
    
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
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi Select2
            $(".select2-jenisPompa").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "-- Pilih Jenis Pompa --",
                        dropdownParent: $(this).parent()
                    });
            });

            // Ambil elemen input "Jalur"
            let jalurField = $("input[name='jalur']").closest(".mb-3");

            // Sembunyikan input "Jalur" jika jenis_pompa bukan "Charging Pump"
            let selectedValue = $(".select2-jenisPompa").val();
            if (selectedValue === "Charging Pump") {
                jalurField.show();
            } else {
                jalurField.hide();
            }

            // Event listener untuk perubahan pada Select2
            $(".select2-jenisPompa").on("change", function() {
                let selectedValue = $(this).val(); // Ambil nilai yang dipilih
                
                if (selectedValue === "Charging Pump") {
                    jalurField.show();
                } else {
                    jalurField.hide();
                }
            });
        });
    </script>

    @include('validation.notifications')
@endsection
