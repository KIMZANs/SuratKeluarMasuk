<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Bootstrap (Letakkan ini sebelum AdminLTE jika tidak ingin menimpa font AdminLTE) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Tempus Dominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar -->
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
            <!-- IPDN Logo -->
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
                            <a href="{{ route('akun.edit', Auth::user()->id) }}" class="nav-link active">
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

        <!-- Content Wrapper -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Setting Account</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Setting</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary shadow-none">
                                <!-- form start -->
                                <form action="{{ route('akun.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                @if($user->photo)
                                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil"
                                                        class="img-fluid rounded-circle mb-2"
                                                        style="width: 150px; height: 150px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('storage/assets/default-avatar.png') }}"
                                                        alt="Default Foto" class="img-fluid rounded-circle mb-2"
                                                        style="width: 150px; height: 150px; object-fit: cover;">
                                                @endif
                                                <div class="mt-2">
                                                    <label for="photo" class="form-label d-block">Photo Profil</label>
                                                    <div class="btn btn-light btn-file">
                                                        <i class="fas fa-paperclip"></i> Upload Photo
                                                        <input type="file" name="photo" id="photo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        placeholder="Masukan nama" value="{{ $user->nama }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nip">NIP</label>
                                                    <input type="text" class="form-control" id="nip" name="nip"
                                                        placeholder="Masukan NIP" value="{{ $user->nip }}" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tempat Lahir</label>
                                                            <select class="form-control select2" name="tempat_lahir"
                                                                style="width: 100%;">
                                                                <option value="Bandung" selected>Bandung</option>
                                                                <option value="Jakarta">Jakarta</option>
                                                                <option value="Cirebon">Cirebon</option>
                                                                <option value="Surabaya">Surabaya</option>
                                                                <option value="Medan">Medan</option>
                                                                <option value="Semarang">Semarang</option>
                                                                <option value="Yogyakarta">Yogyakarta</option>
                                                                <option value="Makassar">Makassar</option>
                                                                <option value="Denpasar">Denpasar</option>
                                                                <option value="Palembang">Palembang</option>
                                                                <option value="Bandar Lampung">Bandar Lampung</option>
                                                                <option value="Pontianak">Pontianak</option>
                                                                <option value="Balikpapan">Balikpapan</option>
                                                                <option value="Banjarmasin">Banjarmasin</option>
                                                                <option value="Pekanbaru">Pekanbaru</option>
                                                                <option value="Manado">Manado</option>
                                                                <option value="Padang">Padang</option>
                                                                <option value="Batam">Batam</option>
                                                                <option value="Bogor">Bogor</option>
                                                                <option value="Malang">Malang</option>
                                                                <option value="Samarinda">Samarinda</option>
                                                                <option value="Mataram">Mataram</option>
                                                                <option value="Kupang">Kupang</option>
                                                                <option value="Jayapura">Jayapura</option>
                                                                <option value="Banda Aceh">Banda Aceh</option>
                                                                <option value="Sibolga">Sibolga</option>
                                                                <option value="Tebing Tinggi">Tebing Tinggi</option>
                                                                <option value="Pematangsiantar">Pematangsiantar</option>
                                                                <option value="Tanjungbalai">Tanjungbalai</option>
                                                                <option value="Padang Panjang">Padang Panjang</option>
                                                                <option value="Bukittinggi">Bukittinggi</option>
                                                                <option value="Pagar Alam">Pagar Alam</option>
                                                                <option value="Lubuklinggau">Lubuklinggau</option>
                                                                <option value="Metro">Metro</option>
                                                                <option value="Pangkalpinang">Pangkalpinang</option>
                                                                <option value="Tanjungpinang">Tanjungpinang</option>
                                                                <option value="Serang">Serang</option>
                                                                <option value="Tangerang">Tangerang</option>
                                                                <option value="Depok">Depok</option>
                                                                <option value="Bekasi">Bekasi</option>
                                                                <option value="Cimahi">Cimahi</option>
                                                                <option value="Tasikmalaya">Tasikmalaya</option>
                                                                <option value="Magelang">Magelang</option>
                                                                <option value="Surakarta">Surakarta</option>
                                                                <option value="Salatiga">Salatiga</option>
                                                                <option value="Madiun">Madiun</option>
                                                                <option value="Blitar">Blitar</option>
                                                                <option value="Pasuruan">Pasuruan</option>
                                                                <option value="Probolinggo">Probolinggo</option>
                                                                <option value="Kediri">Kediri</option>
                                                                <option value="Batu">Batu</option>
                                                                <option value="Kendari">Kendari</option>
                                                                <option value="Gorontalo">Gorontalo</option>
                                                                <option value="Ambon">Ambon</option>
                                                                <option value="Ternate">Ternate</option>
                                                                <option value="Tidore">Tidore</option>
                                                                <option value="Sofifi">Sofifi</option>
                                                                <option value="Sorong">Sorong</option>
                                                                <option value="Nusantara">Nusantara</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Lahir</label>
                                                            <div class="input-group date" id="reservationdate"
                                                                data-target-input="nearest">
                                                                <input type="text"
                                                                    class="form-control datetimepicker-input"
                                                                    data-target="#reservationdate"
                                                                    name="tanggal_lahir" />
                                                                <div class="input-group-append"
                                                                    data-target="#reservationdate"
                                                                    data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Masukan email" value="{{ $user->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Masukan password">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All
            rights
            reserved.
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
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tempus Dominus -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- DateFunction -->
    <script>
        $(function () {
            $('#reservationdate').datetimepicker({
                format: 'DD MMMM YYYY',
                locale: 'id'
            });
        });

    </script>

</body>

</html>