<!-- filepath: c:\xampp\htdocs\Surat\resources\views\Admin\pegawai.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
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
        .navbar .navbar-brand:hover {
            color: #007bff;
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
                    <h4 class="text-center py-3">Admin Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/pegawai') ? 'active' : '' }}" href="{{ route('admin.pegawai') }}">
                                <i class="bi bi-people"></i> Daftar Pegawai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.jabatan') }}">
                                <i class="bi bi-briefcase"></i> Daftar Jabatan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.goljabatan') }}">
                                <i class="bi bi-list-task"></i> Golongan Jabatan
                            </a>
                        </li>

                        <!-- Garis Pembatas -->
                        <hr class="text-white">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-fill-add"></i> Tambah Pegawai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('akun.edit', Auth::user()->id) }}">
                                <i class="bi bi-gear"></i> Setting
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content Pegawai -->
            <main class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Daftar Pegawai</h1>
                    <div class="container mt-3">
                        <!-- Flash Message -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="{{ route('admin.pegawai') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Cari nama atau NIP..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Daftar Pegawai -->
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    Daftar Pegawai
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $index => $user)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->nip ?? '-' }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ ucfirst($user->role) }}</td>
                                                    <td>
                                                        <button type="button" 
                                                                class="btn btn-sm {{ $user->status === 'active' ? 'btn-success' : 'btn-danger' }}" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#confirmModal" 
                                                                onclick="setConfirmForm('{{ route('admin.pegawai.toggleStatus', $user->id) }}')">
                                                            {{ ucfirst($user->status) }}
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('akun.destroy', $user->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Success -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengubah status pengguna ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="confirmForm" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        </script>
    @endif

    <script>
        function setConfirmForm(actionUrl) {
            const confirmForm = document.getElementById('confirmForm');
            confirmForm.action = actionUrl;
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>