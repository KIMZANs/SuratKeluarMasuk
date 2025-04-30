<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
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
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
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
                                        <i class="fa-regular fa-circle"></i>
                                        <p>Jabatan Golongan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.unitkerja') }}" class="nav-link active">
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
                            <h1>Unit Kerja</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Unit Kerja</li>
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
                                    <form method="GET" action="{{ route('admin.unitkerja') }}">
                                        <input type="text" name="search" class="form-control" placeholder="Search"
                                            value="{{ request('search') }}">
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalTambahUnitKerja">
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
                                                <th>Unit Kerja</th>
                                                <th>Kode Unit Kerja</th>
                                                <th style="width: 10px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($unitKerja as $index => $unit_kerja)
                                                <tr>
                                                    <td>{{ $unitKerja->firstItem() + $index }}</td>
                                                    <td>{{ $unit_kerja->nama_unitkerja }}</td>
                                                    <td>{{ $unit_kerja->kode_unitkerja }}</td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-toggle="modal" data-target="#modalEditUnitKerja"
                                                            data-id="{{ $unit_kerja->id }}"
                                                            data-nama_unitkerja="{{ $unit_kerja->nama_unitkerja }}"
                                                            data-kode_unitkerja="{{ $unit_kerja->kode_unitkerja }}">
                                                            Edit
                                                        </button>
                                                        <!-- Tombol Hapus -->
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal" data-target="#modalHapusUnitKerja"
                                                            data-id="{{ $unit_kerja->id }}"
                                                            data-nama_unitkerja="{{ $unit_kerja->nama_unitkerja }}">
                                                            Hapus
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak ada data unit kerja.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{ $unitKerja->links('pagination::bootstrap-4') }}
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

        <!-- Modal Tambah Unit Kerja -->
        <div class="modal fade" id="modalTambahUnitKerja" tabindex="-1" role="dialog"
            aria-labelledby="modalTambahUnitKerjaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.unitkerja.store') }}" method="POST">
                    @csrf
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahUnitKerjaLabel">Tambah Unit Kerja</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_unitkerja">Nama Unit Kerja</label>
                                <input type="text" class="form-control" id="nama_unitkerja" name="nama_unitkerja"
                                    required placeholder="Masukkan nama unit kerja">
                            </div>
                            <div class="form-group">
                                <label for="kode_unitkerja">Kode Unit Kerja</label>
                                <input type="text" class="form-control" id="kode_unitkerja" name="kode_unitkerja"
                                    placeholder="Masukkan kode unit kerja">
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

        <!-- Modal Edit Unit Kerja -->
        <div class="modal fade" id="modalEditUnitKerja" tabindex="-1" aria-labelledby="modalEditUnitKerjaLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" id="formEditUnitKerja">
                    @csrf
                    @method('PUT')
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditUnitKerjaLabel">Edit Unit Kerja</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_nama_unitkerja">Nama Unit Kerja</label>
                                <input type="text" class="form-control" id="edit_nama_unitkerja" name="nama_unitkerja"
                                    required placeholder="Masukkan nama unit kerja">
                            </div>
                            <div class="form-group">
                                <label for="edit_kode_unitkerja">Kode Unit Kerja</label>
                                <input type="text" class="form-control" id="edit_kode_unitkerja" name="kode_unitkerja"
                                    placeholder="Masukkan kode unit kerja">
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

        <!-- Modal Konfirmasi Hapus Unit Kerja -->
        <div class="modal fade" id="modalHapusUnitKerja" tabindex="-1" role="dialog"
            aria-labelledby="modalHapusUnitKerjaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" id="formHapusUnitKerja">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHapusUnitKerjaLabel">Hapus Unit Kerja</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus unit kerja <strong id="unitKerjaNama"></strong> ini?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
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
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2024 Institut Pemerintahan Dalam Negri</strong>
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

            // Menampilkan flash message jika ada
            @if (session('success'))
            $('#flashMessageContent').text("{{ session('success') }}");
            $('#flashMessageModal').modal('show');
        @elseif (session('error'))
            $('#flashMessageContent').text("{{ session('error') }}");
            $('#flashMessageModal').modal('show');
        @endif
            // Ketika modal edit Unit Kerja ditampilkan
            $('#modalEditUnitKerja').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var unitKerjaId = button.data('id'); // Ambil ID unit kerja
                var unitKerjaNama = button.data('nama_unitkerja'); // Ambil nama unit kerja
                var unitKerjaKode = button.data('kode_unitkerja'); // Ambil kode unit kerja

                // Isi data ke dalam modal
                var modal = $(this);
                modal.find('#edit_nama_unitkerja').val(unitKerjaNama);
                modal.find('#edit_kode_unitkerja').val(unitKerjaKode);

                // Perbarui form action dengan ID unit kerja yang benar
                var form = modal.find('form');
                form.attr('action', '{{ route("admin.unitkerja.update", ":id") }}'.replace(':id', unitKerjaId));
            });

            // Ketika modal hapus Unit Kerja ditampilkan
            $('#modalHapusUnitKerja').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var unitKerjaId = button.data('id'); // Ambil ID unit kerja
                var unitKerjaNama = button.data('nama_unitkerja'); // Ambil nama unit kerja

                var modal = $(this);
                modal.find('#unitKerjaNama').text(unitKerjaNama); // Setel nama unit kerja di modal
                modal.find('form').attr('action', '{{ route("admin.unitkerja.destroy", ":id") }}'.replace(':id', unitKerjaId));
            });
        });
    </script>
</body>

</html>