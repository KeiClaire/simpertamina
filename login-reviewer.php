<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mencari user dengan email yang dimasukkan
    $stmt = $conn->prepare('SELECT * FROM reviewer WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika user ditemukan dan password cocok
    if ($user && $password === $user['password']) {
        // Login berhasil
        $_SESSION['user_email'] = $user['email'];
        header('Location: data-driver.php'); // Ganti dengan halaman dashboard atau halaman tujuan setelah login
        exit();
    } else {
        // Login gagal
        $error = "Email atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Reviewer</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .custom-modal-dialog {
            max-width: 350px; /* Pastikan ini sesuai dengan lebar yang diinginkan */
            width: 100%;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

      <div class="row">
            <div class="col-12">
                <a href="index.php" class="btn btn-outline-secondary mb-3" style="position: absolute; top: 10px; left: 10px;">&larr; Back</a>
            </div>
        </div>

    <div class="modal-dialog custom-modal-dialog"> <!-- Menggunakan kelas custom -->
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Login Reviewer</h1>
            </div>
            <div class="modal-body p-5 pt-0">
                <form method="POST" action="login-reviewer.php">
                    <?php if (!empty($error)): ?>
                        <p class="text-danger"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
