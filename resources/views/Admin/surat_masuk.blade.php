<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Masuk</title>
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
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
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
                            <a href="{{ route('admin.unitkerja') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-briefcase"></i>
                                <p>
                                    Unit Kerja
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.surat_masuk') }}" class="nav-link active">
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
                            <h1>Surat Masuk</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Surat Masuk</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalTambahSuratMasuk">
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
                                                <th>No</th>
                                                <th>Nomor Surat</th>
                                                <th>Pengirim</th>
                                                <th>Tembusan</th>
                                                <th>Tanggal</th>
                                                <th>Sifat</th>
                                                <th>Perihal</th>
                                                <th style="width: 10px">Detail</th>
                                                <th style="width: 10px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($suratmasuk as $index => $surat)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $surat->nomor_surat }}</td>
                                                    <td>{{ $surat->pengirim }}</td>
                                                    <td>
                                                        @if($surat->tembusans->count() > 0)
                                                            @foreach($surat->tembusans as $index => $tembusan)
                                                                {{ $tembusan->jabatan->nama_jabatan }}@if($index < $surat->tembusans->count() - 1), @endif
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $surat->tanggal }}</td>
                                                    <td>{{ $surat->sifat }}</td>
                                                    <td>{!! $surat->perihal !!}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm"
                                                            onclick="lihatDetail({{ $surat->id }})">Lihat Detail</button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm"
                                                            onclick="editSurat({{ $surat->id }})">Edit</button>
                                                        <form action="{{ route('admin.surat_masuk.delete', $surat->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{ $suratmasuk->links('pagination::bootstrap-4') }}
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

    <!-- Modal Tambah Surat Masuk -->
    <div class="modal fade" id="modalTambahSuratMasuk" tabindex="-1" role="dialog"
        aria-labelledby="modalTambahSuratMasukLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.surat_masuk.store') }}" method="POST">
                @csrf
                <div class="modal-content shadow-none">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahSuratMasukLabel">Tambah Surat Masuk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Tampilkan error jika ada -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="text" class="form-control" name="nomor_surat[]" placeholder="001"
                                        required value="{{ old('nomor_surat.0') }}">
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <span>/</span>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="nomor_surat[]" placeholder="001"
                                        required value="{{ old('nomor_surat.1') }}">
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <span>/</span>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="unit_kerja_id" required>
                                        <option value="" disabled selected>UKXX</option>
                                        @foreach ($unitKerja as $unit)
                                            <option value="{{ $unit->id }}" {{ old('unit_kerja_id') == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->kode_unitkerja }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pengirim</label>
                            <select class="select2" name="pengirim" style="width: 100%;" required>
                                <option value="" disabled selected>Pilih Pengirim</option>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}" {{ old('pengirim') == $jabatan->id ? 'selected' : '' }}>
                                        {{ $jabatan->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tembusan</label>
                            <select class="select2" name="tembusan[]" multiple="multiple"
                                data-placeholder="Pilih tembusan" style="width: 100%;" required>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}" 
                                        {{ is_array(old('tembusan')) && in_array($jabatan->id, old('tembusan')) ? 'selected' : '' }}>
                                        {{ $jabatan->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') ?? date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Sifat</label>
                            <select class="select2" name="sifat" style="width: 100%;" required>
                                <option value="Penting" {{ old('sifat') == 'Penting' ? 'selected' : '' }}>Penting</option>
                                <option value="Biasa" {{ old('sifat') == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="summernote">Perihal</label>
                            <textarea name="perihal" id="summernote" class="form-control">{{ old('perihal') }}</textarea>
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
    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <!-- Initialize -->
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#modalTambahSuratMasuk')
            });
            $('#summernote').summernote()
        });
    </script>
</body>

</html>