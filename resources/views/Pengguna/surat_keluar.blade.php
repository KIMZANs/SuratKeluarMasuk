<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
        }
        .sidebar .nav-link {
            color: white;
            transition: background-color 0.3s;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .card-header {
            font-weight: bold;
        }
        .navbar {
            background-color: #343a40;
            color: white;
        }
        .navbar .navbar-brand {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <div class="ms-auto d-flex align-items-center">
                    <!-- Menampilkan nama pengguna -->
                    <span class="navbar-text me-3">Selamat Datang, {{ Auth::user()->name }}</span>
                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <h4 class="text-center py-3">Pengguna Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pengguna/dashboard') ? 'active' : '' }}" href="{{ route('pengguna.dashboard') }}">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengguna.surat_masuk') }}">
                                <i class="bi bi-envelope-arrow-down"></i> Surat Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('pengguna.surat_keluar') }}">
                                <i class="bi bi-envelope-arrow-up"></i> Surat Keluar
                            </a>
                        </li>

                        <!-- Garis Pembatas -->
                        <hr class="text-white">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengguna.pengaturan') }}">
                                <i class="bi bi-gear"></i> Setting
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Surat Keluar</h1>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Daftar Surat Keluar
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Tujuan</th>
                                        <th>Perihal</th>
                                        <th>Tanggal Surat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($suratKeluar as $index => $surat)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $surat->nomor_surat }}</td>
                                            <td>{{ $surat->tujuan }}</td>
                                            <td>{{ $surat->perihal }}</td>
                                            <td>{{ $surat->tanggal_surat }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info">Lihat</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada surat keluar</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>