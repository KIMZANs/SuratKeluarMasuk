<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Reviewer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <h4 class="text-center py-3">Reviewer Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-envelope"></i> Surat Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-check-circle"></i> Surat Direview
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Dashboard Reviewer</h1>
                    <div class="row">
                        <!-- Daftar Surat -->
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    Daftar Surat untuk Direview
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul Surat</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Surat Perjanjian</td>
                                                <td>2025-04-15</td>
                                                <td><span class="badge bg-warning">Menunggu</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success">Review</button>
                                                    <button class="btn btn-sm btn-info">Lihat</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Surat Keputusan</td>
                                                <td>2025-04-14</td>
                                                <td><span class="badge bg-warning">Menunggu</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success">Review</button>
                                                    <button class="btn btn-sm btn-info">Lihat</button>
                                                </td>
                                            </tr>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>