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
        <div class="mb-4">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari Pompa...">
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
@include('validation.notifications')
@endsection
