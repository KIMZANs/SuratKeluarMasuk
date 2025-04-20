<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            animation: fadeIn 1s ease-in-out; /* Tambahkan animasi fade-in */
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(20px); /* Awal posisi */
            animation: slideUp 0.8s ease-in-out forwards; /* Tambahkan animasi slide-up */
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card-header {
            font-size: 20px;
            font-weight: 600;
            text-align: center;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .text-center p {
            color:rgb(0, 0, 0); /* Samakan warna dengan tautan */
            font-weight: 500;
        }
        .text-center a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-user-circle"></i> Form Login
                    </div>
                    <div class="card-body">
                        <!-- Modal Error -->
                        @if (session('error'))
                            <div class="alert alert-danger text-center" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('login.authenticate') }}" method="POST">
                            @csrf
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>