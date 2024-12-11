<?php
include('includes/db.php');
include('includes/header.php');

// Cek apakah pengguna sudah login
$is_logged_in = isset($_SESSION['user_id']); // Misalkan 'user_id' adalah ID pengguna yang disimpan di sesi

// Cek apakah ada kategori yang dipilih
$category_id = isset($_GET['category']) ? $_GET['category'] : '';

// Query untuk menampilkan produk berdasarkan kategori (jika ada kategori yang dipilih)
$query = "SELECT p.product_id, p.name AS product_name, p.description, p.price, p.stock, p.image, c.name AS category_name
          FROM products p
          LEFT JOIN categories c ON p.category_id = c.category_id";

// Jika ada kategori yang dipilih, tambahkan kondisi WHERE
if ($category_id) {
    $query .= " WHERE p.category_id = :category_id";
}

$stmt = $pdo->prepare($query);

// Jika ada kategori yang dipilih, bind parameter
if ($category_id) {
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
}

$stmt->execute();
$products = $stmt->fetchAll();
?>

<div class="container mt-4">
    <h2>Produk Kami</h2>
    
    <!-- Filter Kategori Produk -->
    <div class="mb-4">
        <form action="" method="get">
            <select name="category" class="form-control" onchange="this.form.submit()">
                <option value="">Pilih Kategori</option>
                <?php
                // Query untuk mendapatkan daftar kategori
                $categoryQuery = "SELECT * FROM categories";
                $categoryStmt = $pdo->prepare($categoryQuery);
                $categoryStmt->execute();
                $categories = $categoryStmt->fetchAll();
                foreach ($categories as $category):
                ?>
                    <option value="<?php echo $category['category_id']; ?>" <?php echo isset($_GET['category']) && $_GET['category'] == $category['category_id'] ? 'selected' : ''; ?>>
                        <?php echo $category['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <!-- Menampilkan Produk -->
    <div class="row">
        <?php if ($products): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <!-- Link untuk Detail Produk -->
                        <a href="product_detail.php?product_id=<?php echo $product['product_id']; ?>">
                            <img src="assets/img/<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['product_name']; ?>">
                        </a>
                        <div class="card-body">
                            <!-- Link untuk Nama Produk -->
                            <h5 class="card-title">
                                <a href="product_detail.php?product_id=<?php echo $product['product_id']; ?>">
                                    <?php echo $product['product_name']; ?>
                                </a>
                            </h5>
                            <p class="card-text"><?php echo $product['description']; ?></p>
                            <p class="card-text"><strong>Rp <?php echo number_format($product['price'], 2, ',', '.'); ?></strong></p>
                            <p class="card-text"><small class="text-muted">Kategori: <?php echo $product['category_name']; ?></small></p>
                            
                            <!-- Cek apakah pengguna sudah login -->
                            <?php if ($is_logged_in): ?>
                                <!-- Tombol untuk menambah produk ke keranjang -->
                                <a href="cart.php?action=add&product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Tambah ke Keranjang</a>
                            <?php else: ?>
                                <!-- Jika belum login, tampilkan tombol untuk login -->
                                <a href="login.php" class="btn btn-warning">Login untuk Menambah ke Keranjang</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning">Tidak ada produk ditemukan untuk kategori yang dipilih.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>
