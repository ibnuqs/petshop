<?php
session_start();
include('includes/db.php');
include('includes/header.php');

if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $product_id = $_GET['product_id'];
    
    // Cek apakah produk sudah ada di keranjang
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        // Ambil data produk
        $query = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $product = $stmt->fetch();

        // Masukkan ke keranjang
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
            'total_price' => $product['price']
        ];
    }
}

?>

<div class="container mt-4">
    <h2>Keranjang Belanja</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $product_id => $item) {
                echo "<tr>
                        <td>{$item['name']}</td>
                        <td>Rp " . number_format($item['price'], 2, ',', '.') . "</td>
                        <td>{$item['quantity']}</td>
                        <td>Rp " . number_format($item['total_price'], 2, ',', '.') . "</td>
                      </tr>";
                $total += $item['total_price'];
            }
            ?>
        </tbody>
    </table>
    <h3>Total: Rp <?php echo number_format($total, 2, ',', '.'); ?></h3>
    <a href="checkout.php" class="btn btn-success">Lanjutkan ke Pembayaran</a>
</div>

<?php include('includes/footer.php'); ?>
