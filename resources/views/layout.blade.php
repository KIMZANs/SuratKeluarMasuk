<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat Keluar Masuk IPDN</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(135deg, #007bff, #6c63ff);
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .welcome-bubble {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9);
            color: #007bff;
            border-radius: 20px;
            padding: 30px 50px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 1050;
            text-align: center;
            display: none;
            opacity: 0;
            animation: fadeIn 1s ease-in-out forwards;
        }
        .welcome-bubble h1 {
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .welcome-bubble p {
            font-size: 18px;
            margin-bottom: 25px;
        }
        .welcome-bubble button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .welcome-bubble button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .container h1 {
            font-weight: 600;
        }
        .container p {
            font-size: 18px;
        }
        /* Keyframes for fade-in animation */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            100% {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }
    </style>
</head>
<body>
    <!-- Bubble Selamat Datang -->
    <div class="welcome-bubble" id="welcomeBubble">
        <h1><i class="fas fa-envelope-open-text"></i> Selamat Datang!</h1>
        <p>Selamat datang di website Arsip Surat Keluar Masuk IPDN.</p>
        <button onclick="closeBubble()">Lanjutkan</button>
    </div>

    <!-- Konten Utama -->
    <div class="container mt-5">
        <h1 class="text-center"><i class="fas fa-archive"></i> Arsip Surat Keluar Masuk IPDN</h1>
        <p class="text-center">Kelola surat keluar dan masuk dengan mudah dan efisien.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tampilkan bubble setelah halaman dimuat
        window.onload = function() {
            const bubble = document.getElementById('welcomeBubble');
            bubble.style.display = 'block';
        };

        // Fungsi untuk menutup bubble dan mengarahkan ke /login
        function closeBubble() {
            window.location.href = "{{ route('login') }}"; // Arahkan ke route login
        }
    </script>
</body>
</html>