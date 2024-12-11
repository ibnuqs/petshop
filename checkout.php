<?php include('includes/header.php'); ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Checkout</h2>

    <form action="proses_checkout.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat Pengiriman</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="payment" class="form-label">Metode Pembayaran</label>
            <select class="form-select" id="payment" name="payment" required>
                <option value="cod">Cash on Delivery</option>
                <option value="bank_transfer">Transfer Bank</option>
                <option value="credit_card">Kartu Kredit</option>
            </select>
        </div>

        <h3>Ringkasan Pesanan</h3>
        <ul>
            <li>Makanan Kucing - Rp 100,000</li>
            <li>Mainan Anjing - Rp 100,000</li>
        </ul>
        <h4>Total: Rp 200,000</h4>

        <button type="submit" class="btn btn-primary">Selesaikan Pembelian</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
