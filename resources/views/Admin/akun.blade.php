<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f8f9fa;
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
            background-color: #007bff;
            color: white;
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
        .readonly-input {
            background-color: #e9ecef;
            color: #6c757d;
            pointer-events: none;
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
                            <a class="nav-link" href="{{ route('admin.pegawai') }}">
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
                            <a class="nav-link active" href="{{ route('akun.edit', Auth::user()->id) }}">
                                <i class="bi bi-gear"></i> Setting
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Edit Akun</h1>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header text-center">
                                    Edit Akun
                                </div>
                                <div class="card-body">
                                    <!-- Form Edit Akun -->
                                    <form action="{{ route('akun.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Nama -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <input type="text" class="form-control readonly-input" id="status" name="status" value="{{ ucfirst($user->status) }}" readonly>
                                        </div>

                                        <!-- Tombol Simpan -->
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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