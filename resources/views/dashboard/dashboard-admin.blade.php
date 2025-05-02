@extends('master')
@section('content')
    <div class="header">
        <h1 class="header-title">
            Dashboard
        </h1>
        <nav aria-label="breadcrumb">
            {{-- <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard-default.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Blank</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
            </ol> --}}
        </nav>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4 col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Total Lokasi</h5>
                        </div>

                        <div class="col-auto">
                            <div class="avatar">
                                <div class="avatar-title rounded-circle bg-primary-dark">
                                    <i class="fas fa-fw fa-map-marked-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="display-5 mt-1 mb-3">{{ $totLokasi }}</h1>
                    {{-- <div class="mb-0">
                        <span class="text-danger"> <i class="fas fa-fw fa-map-marked-alt"></i> -2.65% </span>
                        Less sales than usual
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Pompa</h5>
                        </div>

                        <div class="col-auto">
                            <div class="avatar">
                                <div class="avatar-title rounded-circle bg-primary-dark">
                                    <i class="fas fa-fw fa-gas-pump"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="display-5 mt-1 mb-3">{{ $totPompa }}</h1>
                    {{-- <div class="mb-0">
                        <span class="text-success"> <i class="fas fa-fw fa-gas-pump"></i> 5.50% </span>
                        More visitors than usual
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Pengguna</h5>
                        </div>

                        <div class="col-auto">
                            <div class="avatar">
                                <div class="avatar-title rounded-circle bg-primary-dark">
                                    <i class="fas fa-fw fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="display-5 mt-1 mb-3">{{ $totPengguna }}</h1>
                    {{-- <div class="mb-0">
                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
                        More earnings than usual
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
