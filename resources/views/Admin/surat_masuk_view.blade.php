<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Surat Masuk</title>

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .container {
            margin-top: 30px;
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
        }

        .label {
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card p-4">
            <h3 class="text-center mb-4">Detail Surat Masuk</h3>

            <table class="table table-bordered">
                <tr>
                    <th>Nomor Surat</th>
                    <td>{{ $suratmasuk->nomor_surat }}</td>
                </tr>
                <tr>
                    <th>Pengirim</th>
                    <td>{{ $suratmasuk->pengirim }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($suratmasuk->tanggal)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Sifat</th>
                    <td>{{ $suratmasuk->sifat }}</td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td>{!! $suratmasuk->perihal !!}</td>
                </tr>
                <tr>
                    <th>Tembusan</th>
                    <td>
                        <ul>
                            @foreach ($suratmasuk->tembusans as $tembusan)
                                <li>{{ $tembusan->jabatan->nama_jabatan ?? '-' }}
                                    ({{ $tembusan->unitKerja->nama_unitkerja ?? '-' }})
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    </div>

    <!-- Optional: AdminLTE & Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>

</html>
