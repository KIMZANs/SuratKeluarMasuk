<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Select2 Bootstrap4 Theme -->
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                            <a href="{{ route('admin.pegawai') }}" class="nav-link active">
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
                            <h1>Daftar Pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Daftar Pegawai</li>
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
                                    <form method="GET" action="{{ route('admin.pegawai') }}">
                                        <input type="text" name="search" class="form-control" placeholder="Search"
                                            value="{{ request('search') }}">
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalTambahPegawai">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                            <div class="card shadow-none">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Email</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Jabatan</th>
                                                <th>Jabatan Golongan</th>
                                                <th>Unit Kerja</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $index => $user)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $user->nama }}</td>
                                                    <td>{{ $user->nip ?? '-' }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->tempat_lahir ?? '-' }}</td>
                                                    <td>{{ $user->tanggal_lahir ?? '-' }}</td>
                                                    <td>{{ $user->jabatan }}</td>
                                                    <td>{{ $user->golongan_jabatan }}</td>
                                                    <td>{{ $user->unit_kerja }}</td>
                                                    <td>{{ ucfirst($user->role) }}</td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-sm {{ $user->status === 'active' ? 'btn-success' : 'btn-danger' }}"
                                                            data-toggle="modal" data-target="#confirmModal"
                                                            onclick="setConfirmForm('{{ route('admin.pegawai.toggleStatus', $user->id) }}')">
                                                            {{ ucfirst($user->status) }}
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary edit-btn"
                                                            data-id="{{ $user->id }}" data-nama="{{ $user->nama }}"
                                                            data-nip="{{ $user->nip }}" data-email="{{ $user->email }}"
                                                            data-tempat_lahir="{{ $user->tempat_lahir }}"
                                                            data-tanggal_lahir="{{ $user->tanggal_lahir }}"
                                                            data-role="{{ $user->role }}"
                                                            data-jabatan="{{ $user->jabatan }}"
                                                            data-golongan_jabatan="{{ $user->golongan_jabatan }}"
                                                            data-unit_kerja="{{ $user->unit_kerja }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                            data-id="{{ $user->id }}" data-nama="{{ $user->nama }}">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="12" class="text-center">Tidak ada data yang
                                                        ditemukan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{ $users->links('pagination::bootstrap-4') }}
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

        <!-- Modal Tambah Pegawai -->
        <div class="modal fade" id="modalTambahPegawai" tabindex="-1" role="dialog"
            aria-labelledby="modalTambahPegawaiLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="{{ route('admin.pegawai.store') }}" method="POST">
                    @csrf
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahPegawaiLabel">Tambah Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" name="nip" class="form-control">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Tempat Lahir</label>
                                    <select id="tempat-lahir" name="tempat_lahir" class="form-control select2-add"
                                        required>
                                        <option value="" disabled selected>Pilih Tempat Lahir</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Role</label>
                                    <select name="role" class="form-control select2-add" required>
                                        <option value="" disabled selected>Pilih Role</option>
                                        <option value="pengguna">Pengguna</option>
                                        <option value="reviewer">Reviewer</option>
                                        <option value="penandatangan">Penandatangan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Jabatan</label>
                                    <select name="jabatan" class="form-control select2-add" required>
                                        <option value="" disabled selected>Pilih Jabatan</option>
                                        @foreach ($jabatans as $jabatan)
                                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Golongan Jabatan</label>
                                    <select name="golongan_jabatan" class="form-control select2-add" required>
                                        <option value="" disabled selected>Pilih Golongan Jabatan</option>
                                        @foreach ($golongan_jabatans as $GolonganJabatan)
                                            <option value="{{ $GolonganJabatan->id }}">{{ $GolonganJabatan->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Unit Kerja</label>
                                    <select name="unit_kerja" class="form-control select2-add" required>
                                        <option value="" disabled selected>Pilih Unit Kerja</option>
                                        @foreach ($unit_kerjas as $UnitKerja)
                                            <option value="{{ $UnitKerja->id }}">{{ $UnitKerja->nama_unitkerja }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Form End -->
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit Pegawai -->
        <div class="modal fade" id="modalEditPegawai" tabindex="-1" role="dialog"
            aria-labelledby="modalEditPegawaiLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id="formEditPegawai" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-id">
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditPegawaiLabel">Edit Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" id="edit-nama" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" name="nip" id="edit-nip" class="form-control">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Tempat Lahir</label>
                                    <select id="edit-tempat_lahir" name="tempat_lahir" class="form-control select2-edit"
                                        required>
                                        <option value="" disabled selected>Pilih Tempat Lahir</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="edit-tanggal_lahir"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="edit-email" class="form-control" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Role</label>
                                    <select name="role" id="edit-role" class="form-control select2-edit" required>
                                        <option value="" disabled>Pilih Role</option>
                                        <option value="pengguna">Pengguna</option>
                                        <option value="reviewer">Reviewer</option>
                                        <option value="penandatangan">Penandatangan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Jabatan</label>
                                    <select name="jabatan" id="edit-jabatan" class="form-control select2-edit" required>
                                        <option value="" disabled>Pilih Jabatan</option>
                                        @foreach ($jabatans as $jabatan)
                                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Golongan Jabatan</label>
                                    <select name="golongan_jabatan" id="edit-golongan_jabatan"
                                        class="form-control select2-edit" required>
                                        <option value="" disabled>Pilih Golongan Jabatan</option>
                                        @foreach ($golongan_jabatans as $GolonganJabatan)
                                            <option value="{{ $GolonganJabatan->id }}">{{ $GolonganJabatan->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Unit Kerja</label>
                                    <select name="unit_kerja" id="edit-unit_kerja" class="form-control select2-edit"
                                        required>
                                        <option value="" disabled>Pilih Unit Kerja</option>
                                        @foreach ($unit_kerjas as $UnitKerja)
                                            <option value="{{ $UnitKerja->id }}">{{ $UnitKerja->nama_unitkerja }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Konfirmasi Status -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content shadow-none">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin mengubah status pengguna ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form id="confirmForm" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus Pegawai -->
        <div class="modal fade" id="modalDeletePegawai" tabindex="-1" role="dialog"
            aria-labelledby="modalDeletePegawaiLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="formDeletePegawai" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content shadow-none">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDeletePegawaiLabel">Hapus Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus pegawai <strong id="delete-nama"></strong>?</p>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Flash Message -->
        <div class="modal fade" id="flashMessageModal" tabindex="-1" role="dialog"
            aria-labelledby="flashMessageModalLabel" aria-hidden="true">
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
    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <!-- Select2 JS -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Initialize -->
    <script>
        // Function to set the form action for status confirmation
        function setConfirmForm(actionUrl) {
            document.getElementById('confirmForm').action = actionUrl;
        }

        $(document).ready(function () {
            // Initialize Select2 for Add Modal
            $('.select2-add').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#modalTambahPegawai')
            });

            // Initialize Select2 for Edit Modal
            $('.select2-edit').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#modalEditPegawai')
            });

            // Handle Edit Button Click
            $('.edit-btn').on('click', function () {
                // Get data attributes
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var nip = $(this).data('nip');
                var email = $(this).data('email');
                var tempat_lahir = $(this).data('tempat_lahir');
                var tanggal_lahir = $(this).data('tanggal_lahir');
                var role = $(this).data('role');
                var jabatan = $(this).data('jabatan');
                var golongan_jabatan = $(this).data('golongan_jabatan');
                var unit_kerja = $(this).data('unit_kerja');

                // Set form values
                $('#edit-id').val(id);
                $('#edit-nama').val(nama);
                $('#edit-nip').val(nip);
                $('#edit-email').val(email);
                $('#edit-tempat_lahir').val(tempat_lahir).trigger('change');
                $('#edit-tanggal_lahir').val(tanggal_lahir);
                $('#edit-role').val(role).trigger('change');
                $('#edit-jabatan').val(jabatan).trigger('change');
                $('#edit-golongan_jabatan').val(golongan_jabatan).trigger('change');
                $('#edit-unit_kerja').val(unit_kerja).trigger('change');

                // Set form action URL with correct route
                var url = "{{ route('admin.pegawai.update', ':id') }}".replace(':id', id);
                $('#formEditPegawai').attr('action', url);

                // Show the modal
                $('#modalEditPegawai').modal('show');
            });

            // Handle Delete Button Click
            $('.delete-btn').on('click', function () {
                var id = $(this).data('id');
                var nama = $(this).data('nama');

                // Set the employee name in the confirmation message
                $('#delete-nama').text(nama);

                // Set form action URL with correct route
                var url = "{{ route('admin.pegawai.destroy', ':id') }}".replace(':id', id);
                $('#formDeletePegawai').attr('action', url);

                // Show the modal
                $('#modalDeletePegawai').modal('show');
            });

            // Load kota dari API EMSIFA dan isi ke dropdown
            $.getJSON("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json", function (provinsi) {
                provinsi.forEach(function (prov) {
                    $.getJSON(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${prov.id}.json`, function (kota) {
                        kota.forEach(function (item) {
                            // Tambah ke "Tambah Pegawai"
                            $('#tempat-lahir').append(`<option value="${item.name}">${item.name}</option>`);

                            // Tambah ke "Edit Pegawai"
                            $('#edit-tempat_lahir').append(`<option value="${item.name}">${item.name}</option>`);
                        });

                        // Trigger Select2 update
                        $('#tempat-lahir').trigger('change');
                        $('#edit-tempat_lahir').trigger('change');
                    });
                });
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