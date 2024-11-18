<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog custom-modal">
    <div class="modal-content" style="border-radius: 15px; background-color: #fff; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
      <div class="modal-header" style="background-color: #28a745; border-top-left-radius: 15px; border-top-right-radius: 15px;">
        <h5 class="modal-title text-white" id="paymentModalLabel">
          <i class="fa-solid fa-credit-card" style="margin-right: 10px;"></i> Payment Gateway
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= site_url('cart/saveOrder') ?>" method="POST">
        <div class="modal-body" style="padding: 30px; background-color: #fff;">
          <!-- Transaction Date -->
          <div class="form-group">
            <label for="transaction_date" class="font-weight-bold">Transaction Date</label>
            <input type="text" class="form-control" id="transaction_date" name="transaction_date" value="<?= date('Y-m-d H:i:s', strtotime('+5 hours')) ?>" readonly>
          </div>

          <?php if ($this->session->userdata('username') && $this->session->userdata('email')) : ?>
            <div class="form-group row">
              <div class="col-md-6">
                <label for="username" class="font-weight-bold">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $this->session->userdata('username') ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="email" class="font-weight-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $this->session->userdata('email') ?>" readonly>
              </div>
            </div>

            <!-- Cart Items -->
            <div class="form-group">
              <label class="font-weight-bold">Items Purchased</label>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th class="text-center">Quantity</th>
                      <th class="text-right">Price</th>
                      <th class="text-right">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($cart_items as $key => $item) : ?>
                      <tr>
                        <td>
                          <?= $item['name'] ?>
                          <input type="hidden" name="product_name[]" value="<?= $item['name'] ?>">
                          <input type="hidden" name="product_id[]" value="<?= $item['id'] ?>">
                        </td>
                        <td class="text-center">
                          <?= $item['qty'] ?>
                          <input type="hidden" name="qty[]" value="<?= $item['qty'] ?>">
                        </td>
                        <td class="text-right">
                          Rp. <?= number_format($item['price'], 0, ',', '.') ?>
                        </td>
                        <td class="text-right">
                          Rp. <?= number_format($item['subtotal'], 0, ',', '.') ?>
                          <input type="hidden" name="subtotal[]" value="<?= $item['subtotal'] ?>">
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>

                </table>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <label for="total_items" class="font-weight-bold">Total Items</label>
                <input type="text" class="form-control" id="total_items" name="total_items" value="<?= array_sum(array_column($cart_items, 'qty')) ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="total_amount" class="font-weight-bold">Total Amount</label>
                <input type="text" class="form-control" id="total_amount" name="total_amount" value="Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="shipping_address" class="font-weight-bold">Shipping Address</label>
              <textarea class="form-control" id="shipping_address" name="shipping_address" placeholder="Enter your full shipping address" rows="4" required></textarea>
            </div>

            <div class="container my-4">
              <div class="form-group row mb-3">
                <div class="col-md-6">
                  <label for="txprovinsi" class="font-weight-bold">Provinsi :</label>
                  <select name="provinsi" id="txprovinsi" onchange="load_kota(this.value)" class="form-select" aria-label="Pilih Provinsi">
                    <option value="">Pilih Provinsi</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="txkota" class="font-weight-bold">Kota :</label>
                  <select name="kota" id="txkota" class="form-select" onchange="load_kecamatan(this.value)" aria-label="Pilih Kota">
                    <option value="">Pilih Kota</option>
                  </select>
                </div>
              </div>

              <div class="form-group row mb-3">
                <div class="col-md-6">
                  <label for="txkecamatan" class="font-weight-bold">Kecamatan :</label>
                  <select name="kecamatan" id="txkecamatan" class="form-select" aria-label="Pilih Kecamatan">
                    <option value="">Pilih Kecamatan</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="txkurir" class="font-weight-bold">Kurir :</label>
                  <select name="kurir" id="txkurir" class="form-select" onchange="cek_ongkir()" aria-label="Pilih Kurir">
                    <option value="">Pilih Kurir</option>
                    <option value="jne">JNE</option>
                    <option value="jnt">JNT</option>
                    <option value="tiki">TIKI</option>
                    <option value="pos">POS</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3" id="dynamic-container">
            </div>
          <?php else : ?>
            <!-- Message for Non-Logged-In Users -->
            <div class="alert alert-danger text-center">
              <p>You must be logged in to proceed with payment.</p>
            </div>
            <div class="form-group row">
              <div class="col-md-12 text-center">
                <a href="<?= site_url('login') ?>" class="btn btn-primary">Login</a>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <?php if ($this->session->userdata('username') && $this->session->userdata('email')) : ?>
          <div class="modal-footer" style="background-color: #f8f9fa; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa-solid fa-times"></i> Cancel
            </button>
            <button type="submit" class="btn btn-success">
              <i class="fa-solid fa-check"></i> Proceed to Payment
            </button>
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>


<div class="container" style="padding: 20px;"><a href="<?php echo base_url('user') ?>"><i class="fa-solid fa-arrow-left"></i></a>
  <div class="container my-5">
    <h2 class="text-center mb-4">Shopping Cart</h2>

    <?php if ($this->session->flashdata('error')) : ?>
      <div id="error-message" class="alert alert-danger text-center" style="display: none;">
        <?= $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>

    <?php if ($cart_items) : ?>
      <form action="<?= site_url('cart/update') ?>" method="post">
        <div class="card shadow-sm">
          <div class="card-body">
            <table class="table table-hover">
              <thead class="thead-light">
                <tr>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cart_items as $item) : ?>
                  <tr>
                    <td><?= $item['name'] ?></td>
                    <td>
                      <input type="number" name="cart[<?= $item['rowid'] ?>][qty]" value="<?= $item['qty'] ?>" min="1" data-stock="<?= isset($item['stockBarang']) ? $item['stockBarang'] : 0 ?>" class="form-control" oninput="cek_stock(this, <?= isset($item['stockBarang']) ? $item['stockBarang'] : 0 ?>)" readonly>
                      <input type="hidden" name="cart[<?= $item['rowid'] ?>][rowid]" value="<?= $item['rowid'] ?>">
                    </td>
                    <td>Rp. <?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td>Rp. <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                    <td>
                      <a href="<?= site_url('cart/remove/' . $item['rowid']) ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="5" class="text-muted">Stok Tersedia: <?= $item['stockBarang'] ?? 'N/A' ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <div class="text-right mt-3">
              <h4 class="font-weight-bold">Total: Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?></h4>
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-rotate-right" style="padding:5px" ;></i>Update</button>
              <button type="button" class="btn btn-success" onclick="openModal()" data-toggle="modal" data-target="#paymentModal"><i class="fa-solid fa-credit-card"></i> Proceed to Payment</button>
            </div>
          </div>
        </div>
      </form>
    <?php else : ?>
      <div class="alert alert-warning text-center">
        <p>Keranjang Anda kosong.</p>
      </div>
    <?php endif; ?>

  </div>

  <!-- Custom CSS -->
  <style>
    .table th,
    .table td {
      vertical-align: middle;
    }

    .table-hover tbody tr:hover {
      background-color: #f9f9f9;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #004085;
    }

    .form-select {
      border-radius: 8px;
      padding: 8px;
    }

    .form-group label {
      margin-bottom: 0.5rem;
    }

    .card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    margin-bottom: 15px;
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.card-text {
    color: #555;
}

.selectable-card {
    cursor: pointer;
    position: relative;
    transition: transform 0.2s;
    border: 2px solid transparent;
}

.selectable-card:hover {
    transform: scale(1.02);
}

.selectable-card.selected {
    border-color: #4CAF50;  /* Ganti warna border kartu saat terpilih */
    box-shadow: 0 4px 8px rgba(0, 128, 0, 0.3);
}

.checkmark {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: #4CAF50;
    display: none;  /* Sembunyikan awalnya */
}

.selectable-card.selected .checkmark {
    display: block;  /* Tampilkan ikon centang saat kartu dipilih */
}



    /* CSS Kustom untuk Modal Lebar */
    .custom-modal {
      max-width: 80%;
      /* Atur lebar modal sesuai kebutuhan (misalnya 80%) */
    }
  </style>

  <?php if ($this->session->flashdata('success_message')): ?>
    <script>
      window.onload = function() {
        Swal.fire({
          title: 'Success!',
          text: '<?= $this->session->flashdata('success_message'); ?>',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            $('#paymentModal').modal('hide'); // Tutup modal
          }
        });
      };
    </script>
  <?php elseif ($this->session->flashdata('error_message')): ?>
    <script>
      window.onload = function() {
        Swal.fire({
          title: 'Error!',
          text: '<?= $this->session->flashdata('error_message'); ?>',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      };
    </script>
  <?php endif; ?>