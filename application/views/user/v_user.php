<div class="container" style="padding: 20px;"><a href="<?php echo base_url('user') ?>"><i class="fa-solid fa-arrow-left"></i></a>
<form method="get" action="<?php echo site_url('user/index'); ?>" style="margin: 20px 0px">
    <label for="kategori" style="color:black">Pilih Kategori :</label>
    <select name="kategori" id="txkategori" class="form-select-sm" aria-label="Default select example">
        <option value="">Semua Kategori</option>
        Kategori akan dimuat melalui jQuery
    </select>
    <button type="submit" class="btn btn-primary btn-sm ml-3">Filter</button>
</form>

<?php if (isset($_GET['kategori']) && $_GET['kategori'] !== '') : ?>
    <h4 class="text-center">Kategori yang Dipilih: <?= htmlspecialchars($_GET['kategori']) ?></h4>
<?php else : ?>
    <h4 class="text-center">Semua Barang</h4>
<?php endif; ?>

<?php if ($this->session->flashdata('error')) : ?>
    <div id="error-message" class="alert alert-danger text-center" style="display: none;">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>
<div class="container-md">
    <div class="row" id="barang-list" style="padding-top: 10px; background-color: #F5F7F8; padding: 20px; border-radius: 10px;">
        <?php if (!empty($barang)) : ?>
            <?php foreach ($barang as $item) : ?>
                <?php if (isset($item['set_harga']) && $item['set_harga'] !== '') : ?>
                    <div class="col-md-3 col-sm-6 item" data-kategori="<?= $item['kategori_barang'] ?>" style="margin-bottom: 20px;">
                        <div class="card mb-4 shadow" style="border-radius: 15px; overflow: hidden;">
                            <img src="<?= base_url('uploads/') . $item['foto'] ?>" class="card-img-top" alt="<?= $item['namaBarang'] ?>" style="height: 200px; object-fit: cover; width: auto;">
                            <div class="card-body" style="padding: 15px;">
                                <h5 class="card-title text-center" style="color:#333; font-size: 1.1rem; font-weight: bold;"><?= $item['namaBarang'] ?></h5>
                                <p class="card-text text-muted text-center" style="font-size: 0.9rem;"><?= $item['deskripsi'] ?></p>
                                <h5 class="text-center" style="color: #007bff; font-weight: bold; font-size: 1.2rem;">Rp. <?= number_format($item['set_harga'], 0, ',', '.') ?></h5>
                                <?php if ($item['stockBarang'] > 0) : ?>
                                    <?php echo anchor('user/add_to_cart/' . $item['id_barang'], '<div class="btn btn-outline-success w-100">Add to cart</div>') ?>
                                <?php else : ?>
                                    <div class="btn btn-outline-secondary w-100" disabled>Add to cart</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">Tidak ada barang yang tersedia dalam kategori ini.</p>
        <?php endif; ?>
    </div>
</div>
        </main>

<footer class="py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; 2024 Toko Online. Semua Hak Dilindungi.</p>
            </div>
            <div class="col-md-6 text-md-right">
                <p>Hubungi Kami: <a href="mailto:info@tokoonline.com">info@tokoonline.com</a></p>
            </div>
        </div>
    </div>
</footer>