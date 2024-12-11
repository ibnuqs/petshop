<?php include('includes/header.php'); ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Keranjang Belanja</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Makanan Kucing</td>
                <td>Rp 100,000</td>
                <td>1</td>
                <td>Rp 100,000</td>
                <td><a href="#" class="btn btn-danger btn-sm">Hapus</a></td>
            </tr>
            <tr>
                <td>Mainan Anjing</td>
                <td>Rp 50,000</td>
                <td>2</td>
                <td>Rp 100,000</td>
                <td><a href="#" class="btn btn-danger btn-sm">Hapus</a></td>
            </tr>
        </tbody>
    </table>

    <h3>Total: Rp 200,000</h3>
    <a href="checkout.php" class="btn btn-success">Lanjut ke Checkout</a>
</div>

<?php include('includes/footer.php'); ?>
