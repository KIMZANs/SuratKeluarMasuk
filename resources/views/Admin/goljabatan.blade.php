<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golongan Jabatan</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link active">
                        Welcome, {{ Auth::user()->nama }}
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a class="brand-link">
                <img src="{{ asset('storage/assets/Logo_IPDN.png') }}" alt="Logo IPDN" class="brand-image img-circle"
                    width="150" height="150">
                <span class="brand-text font-weight-light">Arsip Surat</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pegawai') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-user"></i>
                                <p>Daftar Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fa-solid fa-user-plus"></i>
                                <p>
                                    Daftar jabatan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.jabatan') }}" class="nav-link">
                                        <i class="fa-regular fa-circle"></i>
                                        <p>Jabatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.goljabatan') }}" class="nav-link">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        <p>Jabatan Golongan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.unitkerja') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-briefcase"></i>
                                <p>
                                    Unit Kerja
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.surat_masuk') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-envelope"></i>
                                <p>
                                    Surat Masuk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.surat_keluar') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-envelope"></i>
                                <p>
                                    Surat Keluar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('akun.edit', Auth::user()->id) }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-gear"></i>
                                <p>
                                    Setting
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Jabatan Golongan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Daftar Jabatan</li>
                                </li>
                                <li class="breadcrumb-item active">Jabatan Golongan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col">
                                    <form method="GET" action="{{ route('admin.goljabatan') }}">
                                        <input type="text" name="search" class="form-control" placeholder="Search"
                                            value="{{ request('search') }}">
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalTambahJabatangol">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                            <div class="card shadow-none">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Jabatan</th>
                                                <th>Golongan</th>
                                                <th style="width: 10px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($golonganJabatan as $index => $golongan_jabatan)
                                                <tr>
                                                    <td>{{ $golonganJabatan->firstItem() + $index }}</td>
                                                    <td>{{ $golongan_jabatan->nama_jabatan }}</td>
                                                    <td>{{ $golongan_jabatan->nama_golongan }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-toggle="modal" data-target="#modalEditJabatangol"
                                                            data-id="{{ $golongan_jabatan->id }}"
                                                            data-nama_jabatan="{{ $golongan_jabatan->nama_jabatan }}"
                                                            data-nama_golongan="{{ $golongan_jabatan->nama_golongan }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal" data-target="#modalHapusJabatangol"
                                                            data-id="{{ $golongan_jabatan->id }}"
                                                            data-nama="{{ $golongan_jabatan->nama_jabatan }}">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak ada data yang
                                                        ditemukan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{ $golonganJabatan->links('pagination::bootstrap-4') }}
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Modal Tambah Jabatan -->
        <div class="modal fade" id="modalTambahJabatangol" tabindex="-1" role="dialog"
            aria-labelledby="modalTambahJabatanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.goljabatan.store') }}" method="POST">
                    @csrf
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahJabatanLabel">Tambah Jabatan Golongan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="jabatan">Nama Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="nama_jabatan" required
                                    placeholder="Masukan nama jabatan">
                            </div>
                            <div class="form-group">
                                <label for="golongan">Golongan</label>
                                <input type="text" class="form-control" id="golongan" name="nama_golongan" required
                                    placeholder="Masukan golongan jabatan">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal -->

        <!-- Modal Edit Jabatan -->
        <div class="modal fade" id="modalEditJabatangol" tabindex="-1" role="dialog"
            aria-labelledby="modalEditJabatangolLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" id="formEditJabatangol">
                    @csrf
                    @method('PUT')
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditJabatangolLabel">Edit Jabatan Golongan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_jabatan">Nama Jabatan</label>
                                <input type="text" class="form-control" id="edit_nama_jabatan" name="nama_jabatan"
                                    value="{{ old('nama_jabatan') }}" required placeholder="Masukkan nama jabatan">
                            </div>
                            <div class="form-group">
                                <label for="nama_golongan">Nama Golongan</label>
                                <input type="text" class="form-control" id="edit_nama_golongan" name="nama_golongan"
                                    value="{{ old('nama_golongan') }}" required placeholder="Masukkan nama golongan">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal -->

        <!-- Modal Konfirmasi Hapus Jabatan -->
        <div class="modal fade" id="modalHapusJabatangol" tabindex="-1" role="dialog"
            aria-labelledby="modalHapusJabatangolLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.goljabatan.destroy', $golongan_jabatan->id ?? '') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHapusJabatangolLabel">Hapus Jabatan Golongan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus jabatan <strong id="jabatanNama"></strong> ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal -->

        <!-- Modal Flash Message -->
        <div class="modal fade" id="flashMessageModal" tabindex="-1" role="dialog" aria-labelledby="flashMessageModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content shadow-none">
                    <div class="modal-header">
                        <h5 class="modal-title" id="flashMessageModalLabel">Informasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="flashMessageContent"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2024 Institut Pemerintahan Dalam Negeri</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {
            // Ketika modal edit ditampilkan
            $('#modalEditJabatangol').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var jabatanId = button.data('id');
                var namaJabatan = button.data('nama_jabatan');
                var namaGolongan = button.data('nama_golongan');

                var modal = $(this);
                modal.find('#edit_nama_jabatan').val(namaJabatan);
                modal.find('#edit_nama_golongan').val(namaGolongan);

                // Update action form supaya ke id yang bener
                modal.find('form').attr('action', '/admin/goljabatan/' + jabatanId);
            });

            // Ketika modal hapus ditampilkan
            $('#modalHapusJabatangol').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Tombol yang mengaktifkan modal
                var jabatanId = button.data('id'); // Ambil ID
                var jabatanNama = button.data('nama'); // Ambil Nama

                var modal = $(this);
                modal.find('#jabatanNama').text(jabatanNama); // Pakai jabatanNama di sini
                modal.find('#formHapusJabatangol').attr('action', '/admin/goljabatan/' + jabatanId);
            });

            @if (session('success'))
                $('#flashMessageContent').text("{{ session('success') }}");
                $('#flashMessageModal').modal('show');
            @elseif (session('error'))
                $('#flashMessageContent').text("{{ session('error') }}");
                $('#flashMessageModal').modal('show');
            @endif
        });
    </script>
</body>

</html>