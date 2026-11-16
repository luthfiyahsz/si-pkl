<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @vite('resources/css/app.css')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="sidebar d-flex flex-column flex-shrink-0 p-3" id="sidebar">
            <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                <i class="bi bi-mortarboard-fill me-2 fs-4"></i>
                <span class="fs-5 fw-semibold">SI PKL</span>
            </a>
            <hr class="text-white opacity-25">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>

                @if (Auth::user()->role == 'admin')
                    <li class="nav-item mt-2">
                        <small class="text-white-50 ms-2">MASTER DATA</small>
                    </li>
                    <li>
                        <a href="{{ route('admin.siswa.index') }}" class="nav-link text-white {{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
                            <i class="bi bi-people me-2"></i> Siswa SMK
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.guru.index') }}" class="nav-link text-white {{ request()->routeIs('admin.guru*') ? 'active' : '' }}">
                            <i class="bi bi-person-badge me-2"></i> Guru
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.perusahaan.index') }}" class="nav-link text-white {{ request()->routeIs('admin.perusahaan*') ? 'active' : '' }}">
                            <i class="bi bi-building me-2"></i> Perusahaan
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <small class="text-white-50 ms-2">TRANSAKSI</small>
                    </li>
                    <li>
                        <a href="{{ route('admin.pkl.index') }}" class="nav-link text-white {{ request()->routeIs('admin.pkl*') ? 'active' : '' }}">
                            <i class="bi bi-briefcase me-2"></i> Data PKL
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jurnal.index') }}" class="nav-link text-white {{ request()->routeIs('admin.jurnal*') ? 'active' : '' }}">
                            <i class="bi bi-journal me-2"></i> Jurnal Harian
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.penilaian.index') }}" class="nav-link text-white {{ request()->routeIs('admin.penilaian*') ? 'active' : '' }}">
                            <i class="bi bi-star me-2"></i> Penilaian
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.absensi.index') }}" class="nav-link text-white {{ request()->routeIs('admin.absensi*') ? 'active' : '' }}">
                            <i class="bi bi-calendar-check me-2"></i> Absensi
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'siswa')
                    <li>
                        <a href="{{ route('siswa.pkl.index') }}" class="nav-link text-white {{ request()->routeIs('siswa.pkl*') ? 'active' : '' }}">
                            <i class="bi bi-briefcase me-2"></i> Pengajuan PKL
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.jurnal.index') }}" class="nav-link text-white {{ request()->routeIs('siswa.jurnal*') ? 'active' : '' }}">
                            <i class="bi bi-journal me-2"></i> Jurnal Harian
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.absensi.index') }}" class="nav-link text-white {{ request()->routeIs('siswa.absensi*') ? 'active' : '' }}">
                            <i class="bi bi-calendar-check me-2"></i> Absensi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.profil') }}" class="nav-link text-white {{ request()->routeIs('siswa.profil') ? 'active' : '' }}">
                            <i class="bi bi-person me-2"></i> Profil Saya
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'guru')
                    <li>
                        <a href="{{ route('guru.siswa.index') }}" class="nav-link text-white {{ request()->routeIs('guru.siswa*') ? 'active' : '' }}">
                            <i class="bi bi-people me-2"></i> Siswa Bimbingan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guru.jurnal.index') }}" class="nav-link text-white {{ request()->routeIs('guru.jurnal*') ? 'active' : '' }}">
                            <i class="bi bi-journal me-2"></i> Jurnal Siswa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guru.penilaian.index') }}" class="nav-link text-white {{ request()->routeIs('guru.penilaian*') ? 'active' : '' }}">
                            <i class="bi bi-star me-2"></i> Penilaian
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'perusahaan')
                    <li>
                        <a href="{{ route('perusahaan.siswa.index') }}" class="nav-link text-white {{ request()->routeIs('perusahaan.siswa*') ? 'active' : '' }}">
                            <i class="bi bi-people me-2"></i> Siswa PKL
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('perusahaan.jurnal.index') }}" class="nav-link text-white {{ request()->routeIs('perusahaan.jurnal*') ? 'active' : '' }}">
                            <i class="bi bi-journal me-2"></i> Jurnal Mahasiswa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('perusahaan.penilaian.index') }}" class="nav-link text-white {{ request()->routeIs('perusahaan.penilaian*') ? 'active' : '' }}">
                            <i class="bi bi-star me-2"></i> Penilaian
                        </a>
                    </li>
                @endif
            </ul>
            <hr class="text-white opacity-25">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-2 fs-5"></i>
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark shadow-sm">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div id="page-content" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3 py-2">
                <div class="container-fluid">
                    <button class="btn btn-sm" id="sidebarToggle"><i class="bi bi-list fs-4"></i></button>
                    <span class="navbar-text ms-2 fw-semibold">@yield('title', 'Dashboard')</span>
                    <div class="d-flex align-items-center ms-auto">
                        <span class="badge bg-primary me-2">{{ ucfirst(Auth::user()->role) }}</span>
                        <span class="text-muted small">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
        });

        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}', timer: 3000, showConfirmButton: false });
        @endif
    </script>
</body>
</html>
