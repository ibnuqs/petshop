<?php include('includes/header.php'); ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Kontak Kami</h2>

    <div class="row">
        <div class="col-md-6">
            <h4>Hubungi Kami</h4>
            <form action="send_contact.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
            </form>
        </div>

        <div class="col-md-6">
            <h4>Alamat Kami</h4>
            <p>Jl. Petshop No. 123, Jakarta, Indonesia</p>
            <p>Telp: (021) 12345678</p>
            <p>Email: info@petshop.com</p>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
