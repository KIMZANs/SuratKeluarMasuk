<!-- filepath: c:\xampp\htdocs\Surat\resources\views\Admin\jabatan.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jabatan</title>
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
                                        <i class="fa-regular fa-circle-dot"></i>
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
                            <h1>Jabatan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Daftar Jabatan</li>
                                </li>
                                <li class="breadcrumb-item active">Jabatan</li>
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
                                    <form method="GET" action="{{ route('admin.jabatan') }}">
                                        <input type="text" name="search" class="form-control" placeholder="Search"
                                               value="{{ request('search') }}">
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalTambahJabatan">
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
                                                <th>Keterangan</th>
                                                <th style="width: 10px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($jabatans as $index => $jabatan)
                                                <tr>
                                                    <td>{{ $jabatans->firstItem() + $index }}</td>
                                                    <td>{{ $jabatan->nama_jabatan }}</td>
                                                    <td>{{ $jabatan->keterangan }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-toggle="modal" data-target="#modalEditJabatan"
                                                            data-id="{{ $jabatan->id }}"
                                                            data-nama_jabatan="{{ $jabatan->nama_jabatan }}"
                                                            data-keterangan="{{ $jabatan->keterangan }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal" data-target="#modalHapusJabatan"
                                                            data-id="{{ $jabatan->id }}"
                                                            data-nama="{{ $jabatan->nama_jabatan }}">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak ada data jabatan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{ $jabatans->links('pagination::bootstrap-4') }}
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
        <div class="modal fade" id="modalTambahJabatan" tabindex="-1" role="dialog"
            aria-labelledby="modalTambahJabatanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.jabatan.store') }}" method="POST">
                    @csrf
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahJabatanLabel">Tambah Jabatan</h5>
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
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan"
                                    placeholder="Masukan keterangan">
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
        <div class="modal fade" id="modalEditJabatan" tabindex="-1" aria-labelledby="modalEditJabatanLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" id="formEditJabatan">
                    @csrf
                    @method('PUT')
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditJabatanLabel">Edit Jabatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_jabatan">Nama Jabatan</label>
                                <input type="text" class="form-control" id="edit_nama_jabatan" name="nama_jabatan"
                                    value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}" required
                                    placeholder="Masukan nama jabatan">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="edit_keterangan" name="keterangan"
                                    value="{{ old('keterangan', $jabatan->keterangan) }}"
                                    placeholder="Masukan keterangan">
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
        <div class="modal fade" id="modalHapusJabatan" tabindex="-1" role="dialog"
            aria-labelledby="modalHapusJabatanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.jabatan.destroy', $jabatan->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHapusJabatanLabel">Hapus Jabatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus jabatan <strong id="jabatanNama"></strong> ini?</p>
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
            @if (session('success'))
                $('#flashMessageContent').text("{{ session('success') }}");
                $('#flashMessageModal').modal('show');
            @elseif (session('error'))
                $('#flashMessageContent').text("{{ session('error') }}");
                $('#flashMessageModal').modal('show');
            @endif

            // Populate Edit Modal with data
            $('#modalEditJabatan').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nama_jabatan = button.data('nama_jabatan');
                var keterangan = button.data('keterangan');

                var modal = $(this);
                modal.find('#edit_nama_jabatan').val(nama_jabatan);
                modal.find('#edit_keterangan').val(keterangan);

                var formAction = "{{ route('admin.jabatan.update', ':id') }}";
                formAction = formAction.replace(':id', id);
                modal.find('#formEditJabatan').attr('action', formAction);
            });
        });
    </script>
</body>

</html>