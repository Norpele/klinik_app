<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Detail Transaksi</h3>
        </div>
        <div class="card-body">
            <p class="card-text"><strong>No Transaksi :</strong> <?= $transaksi->no_transaksi ?></p>
            <p class="card-text"><strong>Tanggal Transaksi :</strong> <?= $transaksi->tanggal ?></p>
            <p class="card-text"><strong>Username :</strong> <?= $transaksi->username ?></p>
            <p class="card-text"><strong>Email :</strong> <?= $transaksi->email ?></p>
            <p class="card-text"><strong>Alamat Pengiriman :</strong> <?= $transaksi->alamat ?></p>

            <h4>Barang yang Dipesan :</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi_detail as $detail) : ?>
                        <tr>
                            <td><?= $detail->produk ?></td>
                            <td><?= $detail->jumlah_barang ?></td>
                            <td>Rp. <?= number_format($detail->total_harga, 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3><strong>Total: Rp. <?= number_format(array_sum(array_column($transaksi_detail, 'total_harga')), 0, ',', '.') ?></strong></h3>
        </div>
        <?php if ($transaksi->pesan_status == 3) : ?>
            <div class="card-footer" style="background-color: #f8f9fa;">
                <button type="button" class="btn btn-primary" onclick="window.history.back();">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </button>
            </div>
        <?php elseif ($transaksi->pesan_status == 2) : ?>
            <div class="card-footer" style="background-color: #f8f9fa;">
                <button type="button" class="btn btn-primary" onclick="window.history.back();">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </button>
            </div>
        <?php elseif ($transaksi->pesan_status == 1) : ?>
            <div class="card-footer" style="background-color: #f8f9fa;">
                <button type="button" class="btn btn-primary" onclick="window.history.back();">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </button>
            </div>
        <?php else : ?>
            <div class="alert alert-warning text-center">
                <p>Menunggu Di Verifikasi Admin</p>
            </div>
        <?php endif; ?>
    </div>
</div>