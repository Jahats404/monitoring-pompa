@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Standar Pemeriksaan
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Standar</a></li>
                {{-- <li class="breadcrumb-item active" aria-current="page">Daftar Lokasi</li> --}}
            </ol>
        </nav>
    </div>
    
    <div class="row">
        <!-- Kartu Standar Pemeriksaan Main Pump -->
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Standar Pemeriksaan Main Pump</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.standar.mainpump') }}" class="btn btn-outline-info fst-italic w-100 mb-2">
                        STANDAR PEMERIKSAAN MAIN PUMP
                    </a>
                </div>
            </div>
        </div>
    
        <!-- Kartu Standar Pemeriksaan Charging Pump -->
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Standar Pemeriksaan Charging Pump</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.standar.chargingpump') }}" class="btn btn-outline-secondary fst-italic w-100 mb-2">
                        STANDAR PEMERIKSAAN CHARGING PUMP
                    </a>
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
