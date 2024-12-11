<?php
include('includes/db.php');
include('includes/header.php');

// Mendapatkan ID produk dari URL
if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Query untuk menampilkan detail produk berdasarkan ID
    $query = "SELECT p.product_id, p.name AS product_name, p.description, p.price, p.stock, p.image, c.name AS category_name
              FROM products p
              LEFT JOIN categories c ON p.category_id = c.category_id
              WHERE p.product_id = :product_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch();

    // Jika produk tidak ditemukan
    if (!$product) {
        echo "<div class='alert alert-danger'>Produk tidak ditemukan.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>ID produk tidak valid.</div>";
    exit();
}
?>

<div class="container mt-4">
    <!-- Tombol Back -->
    <a href="index.php" class="btn btn-secondary mb-4">Kembali ke Daftar Produk</a>

    <h2>Detail Produk</h2>
    <div class="row">
        <div class="col-md-6">
            <img src="assets/img/<?php echo $product['image']; ?>" class="img-fluid" alt="<?php echo $product['product_name']; ?>">
        </div>
        <div class="col-md-6">
            <h3><?php echo $product['product_name']; ?></h3>
            <p><strong>Kategori:</strong> <?php echo $product['category_name']; ?></p>
            <p><strong>Deskripsi:</strong> <?php echo nl2br($product['description']); ?></p>
            <p><strong>Harga:</strong> Rp <?php echo number_format($product['price'], 2, ',', '.'); ?></p>
            <p><strong>Stok:</strong> <?php echo $product['stock']; ?> unit</p>
            <a href="cart.php?action=add&product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Tambah ke Keranjang</a>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
