<!-- filepath: c:\xampp\htdocs\Surat\resources\views\reset-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>
    <p>Silakan klik tautan di bawah ini untuk mereset password Anda:</p>
    <a href="{{ $resetUrl }}" target="_blank">Reset Password</a>
    <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
    <p>Terima kasih,</p>
    <p><strong>Tim Support</strong></p>
</body>
</html>