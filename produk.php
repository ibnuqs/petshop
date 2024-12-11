<?php include('includes/header.php'); ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Produk Kami</h2>

    <!-- Filter or Search -->
    <div class="row mb-4">
        <div class="col-md-4">
            <select class="form-select">
                <option selected>Pilih Kategori</option>
                <option value="1">Makanan Hewan</option>
                <option value="2">Mainan Hewan</option>
                <option value="3">Aksesoris Hewan</option>
            </select>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Cari produk...">
        </div>
    </div>

    <div class="row">
        <!-- Daftar produk -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/food.jpg" class="card-img-top" alt="Makanan Hewan">
                <div class="card-body">
                    <h5 class="card-title">Makanan Kucing</h5>
                    <p class="card-text">Harga: Rp 100,000</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/toys.jpg" class="card-img-top" alt="Mainan Hewan">
                <div class="card-body">
                    <h5 class="card-title">Mainan Anjing</h5>
                    <p class="card-text">Harga: Rp 50,000</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        <!-- Produk lainnya bisa ditambahkan di sini -->
    </div>
</div>

<?php include('includes/footer.php'); ?>
