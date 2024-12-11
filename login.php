<?php
include('includes/db.php');
include('includes/header.php'); // Memanggil header

// Cek apakah pengguna sudah login, jika ya, redirect ke halaman utama
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Cek apakah form login disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validasi input
    if (empty($email) || empty($password)) {
        $error = "Email dan password harus diisi!";
    } else {
        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email tidak valid!";
        } else {
            // Query untuk mengambil data pengguna berdasarkan email
            $query = "SELECT * FROM customers WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();

            // Jika email ditemukan dan password cocok
            if ($user && password_verify($password, $user['password'])) {
                // Simpan informasi pengguna di session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];

                // Redirect ke halaman utama setelah login
                header("Location: index.php");
                exit();
            } else {
                $error = "Email atau password salah!";
            }
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Login</h2>

    <!-- Menampilkan error jika ada -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- Form Login -->
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Login</button>
    </form>

    <p class="mt-3">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</div>

<?php include('includes/footer.php'); // Memanggil footer ?>
