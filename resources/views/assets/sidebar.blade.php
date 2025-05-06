<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="index.html">
        {{-- <svg>
            <use xlink:href="#ion-ios-pulse-strong"></use>
        </svg>
        Spark --}}
        <img src="{{ asset('/') }}img/frame.png" class="img-thumbnail" alt="LOGO TRISTAR">
    </a>
    <div class="sidebar-content">
        <div class="sidebar-user">
            {{-- <img src="img/avatars/avatar.jpg" class="img-fluid rounded-circle mb-2" alt="Linda Miller" /> --}}
            <div class="fw-bold">{{ Auth::user()->name }}</div>
            <small>{{ Auth::user()->role->level }}</small>
        </div>

        @if (Auth::user()->role_id == '1')
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>
            <li class="sidebar-item {{ Request::routeIs('teknisi.dashboard*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('teknisi.dashboard') }}">
                    <i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            
            <li class="sidebar-item {{ Request::routeIs('admin.lokasi*') ? 'active' : '' }}">
                <a data-bs-target="#lokasi" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-map-marked-alt"></i> <span class="align-middle">Lokasi</span>
                </a>
                <ul id="lokasi" class="sidebar-dropdown list-unstyled collapse {{ Request::routeIs('admin.lokasi*') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Request::routeIs('admin.lokasi') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.lokasi') }}">Daftar Lokasi</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ Request::routeIs('admin.payload*') || Request::routeIs('admin.unitpompa') || Request::routeIs('admin.pompa') || Request::routeIs('admin.payload.pompa') ? 'active' : '' }}">
                <a data-bs-target="#pompa" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-gas-pump"></i> <span class="align-middle">Pompa</span>
                </a>
                <ul id="pompa" class="sidebar-dropdown list-unstyled collapse {{ Request::routeIs('admin.pompa*') || Request::routeIs('admin.payload.pompa') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    {{-- <li class="sidebar-item {{ Request::routeIs('admin.pompa') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.pompa') }}">Spesifikasi Pompa</a>
                    </li> --}}
                    <li class="sidebar-item {{ Request::routeIs('admin.payload.pompa') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.payload.pompa') }}">Spesifikasi Pompa</a>
                    </li>
                    <li class="sidebar-item {{ Request::routeIs('admin.unitpompa') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.unitpompa') }}">Unit Pompa</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ Request::routeIs('admin.list.lokasi*') || Request::routeIs('admin.standar*') ? 'active' : '' }}">
                <a data-bs-target="#periksa" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-calendar-check"></i> <span class="align-middle">Periksa & Pelihara</span>
                </a>
                <ul id="periksa" class="sidebar-dropdown list-unstyled collapse {{ Request::routeIs('admin.list.lokasi*') || Request::routeIs('admin.payload.pompa') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Request::routeIs('admin.list.lokasi') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.list.lokasi') }}">Periksa & Pelihara</a>
                    </li>
                    <li class="sidebar-item {{ Request::routeIs('admin.standar') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.standar') }}">Standar</a>
                    </li>
                </ul>
            </li>
            
        </ul>
        @endif


        @if (Auth::user()->role_id == '2')
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>

            <li class="sidebar-item {{ Request::routeIs('admin.dashboard*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::routeIs('admin.user*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.user') }}">
                    <i class="align-middle me-2 fas fa-fw fa-user"></i> <span class="align-middle">Pengguna</span>
                </a>
            </li>
            
            <li class="sidebar-item {{ Request::routeIs('admin.lokasi*') ? 'active' : '' }}">
                <a data-bs-target="#lokasi" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-map-marked-alt"></i> <span class="align-middle">Lokasi</span>
                </a>
                <ul id="lokasi" class="sidebar-dropdown list-unstyled collapse {{ Request::routeIs('admin.lokasi*') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Request::routeIs('admin.lokasi') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.lokasi') }}">Daftar Lokasi</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ Request::routeIs('admin.payload*') || Request::routeIs('admin.unitpompa') || Request::routeIs('admin.pompa') || Request::routeIs('admin.payload.pompa') ? 'active' : '' }}">
                <a data-bs-target="#pompa" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-gas-pump"></i> <span class="align-middle">Pompa</span>
                </a>
                <ul id="pompa" class="sidebar-dropdown list-unstyled collapse {{ Request::routeIs('admin.pompa*') || Request::routeIs('admin.payload.pompa') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    {{-- <li class="sidebar-item {{ Request::routeIs('admin.pompa') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.pompa') }}">Spesifikasi Pompa</a>
                    </li> --}}
                    <li class="sidebar-item {{ Request::routeIs('admin.payload.pompa') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.payload.pompa') }}">Spesifikasi Pompa</a>
                    </li>
                    {{-- <li class="sidebar-item {{ Request::routeIs('admin.unitpompa') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.unitpompa') }}">Unit Pompa</a>
                    </li> --}}
                </ul>
            </li>

            <li class="sidebar-item {{ Request::routeIs('admin.list.lokasi*') || Request::routeIs('admin.standar*') ? 'active' : '' }}">
                <a data-bs-target="#periksa" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-calendar-check"></i> <span class="align-middle">Periksa & Pelihara</span>
                </a>
                <ul id="periksa" class="sidebar-dropdown list-unstyled collapse {{ Request::routeIs('admin.list.lokasi*') || Request::routeIs('admin.payload.pompa') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Request::routeIs('admin.list.lokasi') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.list.lokasi') }}">Periksa & Pelihara</a>
                    </li>
                    <li class="sidebar-item {{ Request::routeIs('admin.standar') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.standar') }}">Standar</a>
                    </li>
                </ul>
            </li>
            
        </ul>
        @endif


        @if (Auth::user()->role_id == '3')
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>
            <li class="sidebar-item {{ Request::routeIs('pertamina.dashboard*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('pertamina.dashboard') }}">
                    <i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            {{-- <li class="sidebar-item {{ Request::routeIs('admin.user*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.user') }}">
                    <i class="align-middle me-2 fas fa-fw fa-user"></i> <span class="align-middle">Pengguna</span>
                </a>
            </li> --}}
            
            <li class="sidebar-item {{ Request::routeIs('admin.lokasi*') ? 'active' : '' }}">
                <a data-bs-target="#lokasi" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-map-marked-alt"></i> <span class="align-middle">Lokasi</span>
                </a>
                <ul id="lokasi" class="sidebar-dropdown list-unstyled collapse {{ Request::routeIs('admin.lokasi*') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Request::routeIs('admin.lokasi') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.lokasi') }}">Daftar Lokasi</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ Request::routeIs('admin.payload*') || Request::routeIs('admin.unitpompa') || Request::routeIs('admin.pompa') || Request::routeIs('admin.payload.pompa') ? 'active' : '' }}">
                <a data-bs-target="#pompa" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-gas-pump"></i> <span class="align-middle">Pompa</span>
                </a>
                <ul id="pompa" class="sidebar-dropdown list-unstyled collapse {{ Request::routeIs('admin.pompa*') || Request::routeIs('admin.payload.pompa') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    {{-- <li class="sidebar-item {{ Request::routeIs('admin.pompa') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.pompa') }}">Spesifikasi Pompa</a>
                    </li> --}}
                    <li class="sidebar-item {{ Request::routeIs('admin.payload.pompa') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.payload.pompa') }}">Spesifikasi Pompa</a>
                    </li>
                    <li class="sidebar-item {{ Request::routeIs('admin.unitpompa') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.unitpompa') }}">Unit Pompa</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ Request::routeIs('admin.list.lokasi*') || Request::routeIs('admin.standar*') ? 'active' : '' }}">
                <a data-bs-target="#periksa" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-calendar-check"></i> <span class="align-middle">Periksa & Pelihara</span>
                </a>
                <ul id="periksa" class="sidebar-dropdown list-unstyled collapse {{ Request::routeIs('admin.list.lokasi*') || Request::routeIs('admin.payload.pompa') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Request::routeIs('admin.list.lokasi') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.list.lokasi') }}">Periksa & Pelihara</a>
                    </li>
                    <li class="sidebar-item {{ Request::routeIs('admin.standar') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.standar') }}">Standar</a>
                    </li>
                </ul>
            </li>
            
        </ul>
        @endif
    </div>
</nav>