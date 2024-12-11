<?php
include('includes/db.php');
include('includes/header.php'); // Menambahkan header

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Validasi input
    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        $error = "Semua kolom harus diisi!";
    } elseif ($password !== $password_confirm) {
        $error = "Konfirmasi password tidak sesuai!";
    } else {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Cek apakah username atau email sudah terdaftar
        $checkQuery = "SELECT * FROM customers WHERE username = :username OR email = :email";
        $stmt = $pdo->prepare($checkQuery);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $error = "Username atau email sudah terdaftar!";
        } else {
            // Simpan data pengguna baru
            $insertQuery = "INSERT INTO customers (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($insertQuery);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password_hash);
            $stmt->execute();

            // Redirect ke halaman login setelah berhasil
            header("Location: login.php");
            exit();
        }
    }
}
?>

<div class="container mt-5">
    <h2>Daftar Akun</h2>

    <!-- Menampilkan error jika ada -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="register.php" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirm">Konfirmasi Password</label>
            <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>

    <p class="mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>

<?php include('includes/footer.php'); // Memanggil footer ?>
