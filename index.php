<?php
include('includes/db.php');
include('includes/header.php'); // Memanggil header

// Cek apakah pengguna sudah login
$is_logged_in = isset($_SESSION['user_id']);

// Ambil daftar produk dari database
$query = "SELECT * FROM products ORDER BY product_id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();
?>

<div class="container mt-5">
    <!-- Hero Section -->
    <section class="hero-section text-center text-white" style="background-image: url('assets/images/hero-banner.jpg'); background-size: cover; background-position: center; padding: 80px 0;">
        <div class="container">
            <h1>Selamat Datang di PetShop</h1>
            <p class="lead">Temukan segala kebutuhan hewan peliharaanmu, mulai dari makanan, mainan, hingga aksesoris!</p>
            <?php if ($is_logged_in): ?>
                <a href="cart.php" class="btn btn-lg btn-warning text-dark">Lihat Keranjang</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-lg btn-info">Login untuk mulai berbelanja</a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Produk Section -->
    <section class="products-section mt-5">
        <h2 class="text-center mb-4">Produk Terbaru</h2>
        <div class="row">
            <!-- Menampilkan produk -->
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-light" style="border-radius: 15px;">
                        <img src="assets/img/<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text text-muted"><?php echo substr(htmlspecialchars($product['description']), 0, 100); ?>...</p>
                            <p class="text-success font-weight-bold">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>

                            <!-- Cek apakah user sudah login, jika belum tampilkan tombol login -->
                            <?php if ($is_logged_in): ?>
                                <a href="cart.php?add=<?php echo $product['product_id']; ?>" class="btn btn-success">Tambah ke Keranjang</a>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-primary">Login untuk membeli</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php include('includes/footer.php'); // Memanggil footer ?>
