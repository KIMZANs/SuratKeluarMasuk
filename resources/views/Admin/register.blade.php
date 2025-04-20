<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
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
                            <a class="nav-link active" href="{{ route('register') }}">
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

            <!-- Main Content -->
            <main class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Form Registrasi</h1>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow">
                                <div class="card-header text-center">
                                    Form Registrasi
                                </div>
                                <div class="card-body">
                                    <!-- Modal Error -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('register.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <!-- Kolom Kiri -->
                                            <div class="col-md-6">
                                                <!-- Nama -->
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
                                                </div>

                                                <!-- NIP -->
                                                <div class="mb-3">
                                                    <label for="nip" class="form-label">NIP</label>
                                                    <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" required>
                                                </div>

                                                <!-- Email -->
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                                                </div>
                                            </div>

                                            <!-- Kolom Kanan -->
                                            <div class="col-md-6">
                                                <!-- Password -->
                                                <div class="mb-3 position-relative">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                            <i class="bi bi-eye" id="passwordIcon"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Role -->
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Role</label>
                                                    <select class="form-select" id="role" name="role" required>
                                                        <option value="" selected disabled>Pilih Role</option>
                                                        <option value="penandatangan">Penandatangan</option>
                                                        <option value="reviewer">Reviewer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tambahkan input hidden untuk status -->
                                        <input type="hidden" name="status" value="inactive">

                                        <!-- Submit Button -->
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Register</button>
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
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        });
    </script>
</body>
</html>