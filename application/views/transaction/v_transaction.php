<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Detail Transaksi</h3>
        </div>

        <!-- Digunakan untuk menampilkan tabel pemesenan -->

        <div class="card-body">
            <p class="card-text"><strong>No Transaksi :</strong> <?= $order->no_transaksi ?></p>
            <p class="card-text"><strong>Tanggal Transaksi :</strong> <?= $order->tanggal ?></p>
            <p class="card-text"><strong>Username :</strong> <?= $order->username ?></p>
            <p class="card-text"><strong>Email :</strong> <?= $order->email ?></p>
            <p class="card-text"><strong>Alamat Pengiriman :</strong> <?= $order->alamat ?></p>

            <h4>Barang yang Dipesan :</h4>

            <!-- Digunakan untuk menampilkan tabel pemesanan_detail -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_details as $detail) : ?>
                        <tr>
                            <td><?= $detail->produk ?></td>
                            <td><?= $detail->jumlah_barang ?></td>
                            <td>Rp. <?= number_format($detail->total_harga, 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3><strong> Total : Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?></strong></h3>
        </div>
        <?php if ($order->pesan_status == 1) : ?>
            <div class="card-footer" style="background-color: #f8f9fa; border-bottom-ritgh-radius: 15px; border-bottom-right-radius: 15px;">
                <button type="submit" class="btn btn-primary" onclick="window.history.back();">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check"></i> Pay Now
                </button>
            </div>
        <?php else : ?>
            <div class="alert alert-warning text-center">
                <p>Menunggu Di Verifikasi Admin</p>
            </div>
        <?php endif; ?>
    </div>
</div>