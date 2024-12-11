<?php
session_start();
include('includes/db.php');
include('includes/header.php');

// Validasi jika keranjang kosong
if (empty($_SESSION['cart'])) {
    echo "Keranjang Anda kosong!";
    exit;
}

// Proses checkout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = 1; // Ganti dengan ID pelanggan yang login
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['total_price'];
    }

    // Insert ke tabel orders
    $query = "INSERT INTO orders (customer_id, total, status) VALUES (:customer_id, :total, 'pending')";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':total', $total);
    $stmt->execute();
    
    // Ambil ID order yang baru dibuat
    $order_id = $pdo->lastInsertId();

    // Insert ke tabel order_items
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $item['quantity']);
        $stmt->bindParam(':price', $item['price']);
        $stmt->execute();
    }

    // Kosongkan keranjang setelah checkout
    unset($_SESSION['cart']);

    // Redirect ke halaman konfirmasi pesanan
    header("Location: order-summary.php?order_id=$order_id");
}
?>

<div class="container mt-4">
    <h2>Checkout</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="address" class="form-label">Alamat Pengiriman</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Selesaikan Pembayaran</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
