<div class="page-content">
    <div class="modal modal-add fade" id="Modal" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33"></h4>
                    <button type="button" class="close btn-closed" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <label for="txnama">Upload Bukti Pembayaran</label>
                        <br>
                        <div class="form-group">
                            <img id="imgPreview" src="" alt="Gambar Barang" style="width: 100%; max-height: 200px; object-fit: cover;">
                            <input type="file" id="tximg" size="20" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-closed btn-danger" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="btn-closed d-none d-sm-block ">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-submit ms-1" onclick="updateStatus()">
                            <i class="fa-solid fa-upload"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h3>Daftar Transaksi Anda</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No Transaksi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <!-- <th>pesan id</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                    <td><a href="<?= site_url("transaksi/transactionDetail/" . $transaction->pesan_id) ?>">
                        <?= $transaction->no_transaksi ?></td>
                        <td><?= $transaction->tanggal ?></td>
                        <td>
                            <?php if ($transaction->pesan_status == 0) : ?>
                                <p class="alert alert-warning text-center">
                                    <i class="fa-solid fa-hourglass-half"></i> Menunggu Di Verifikasi Admin
                                </p>
                            <?php elseif ($transaction->pesan_status == 1) : ?>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Modal" onclick="setTransactionId(<?= $transaction->pesan_id; ?>)">
                                    <i class="fa-solid fa-credit-card"></i> Pay Now
                                </button>
                            <?php elseif ($transaction->pesan_status == 2) : ?>
                                <button type="button" class="btn btn-info" onclick="setTransactionId(<?= $transaction->pesan_id; ?>); update_status1();">
                                    <i class="fa-solid fa-thumbs-up"></i> Terima
                                </button>
                            <?php elseif ($transaction->pesan_status == 3) : ?>
                                <p class="alert alert-success text-center">
                                    <i class="fa-solid fa-check-double"></i> Selesai
                                </p>
                            <?php endif; ?>
                        <!-- <td><?= $transaction->pesan_id ?></td> -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function setTransactionId(pesan_id) {
    $('#Modal').data('pesan_id', pesan_id); // Menyimpan pesan_id di modal
}

function update_status1() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Selesai?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mengambil pesan_id dari data modal
            let pesan_id = $('#Modal').data('pesan_id');
            if (pesan_id) {
                updateTerima(pesan_id); // Memanggil fungsi untuk mengupdate status
            } else {
                Swal.fire("Error", "Pesan ID tidak ditemukan.", "error");
            }
        }
    });
}

function updateTerima(pesan_id) {
    $.ajax({
        url: 'history/update_status',
        type: 'POST',
        data: { pesan_id: pesan_id },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire("Berhasil", response.msg, "success");
            } else {
                Swal.fire("Error", response.msg, "error");
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            Swal.fire("Error", "Terjadi kesalahan saat meng-update status.", "error");
        }
    });
}
    </script>