<div class="page-content">
    <div class="modal modal-add fade" id="loginModal" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Data</h4>
                    <button type="button" class="close btn-closed" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <label for="txnama">Nama Barang</label>
                        <div class="form-group">
                            <input type="text" id="txnama" class="form-control">
                        </div>
                        <label for="txdeskripsi">Deskripsi Barang</label>
                        <div class="form-group">
                            <textarea id="txdeskripsi" rows="5" cols="50" placeholder="Masukkan deskripsi barang..."></textarea>
                        </div>
                        <label for="txkategori">Kategori Barang</label>
                        <div class="form-group">
                            <fieldset class="form-group">
                                <select class="form-select" id="txkategori"></select>


                            </fieldset>
                        </div>
                        <label for="txharga">Harga Barang</label>
                        <div class="form-group">
                            <input id="txharga" class="form-control" type="number" oninput="jumlah()">
                        </div>
                        <label for="txstock">Total Barang</label>
                        <div class="form-group">
                            <input id="txstock" name="txstock" type="number" class="form-control" oninput="jumlah()">
                        </div>
                        <label for="txtotal">Total Harga</label>
                        <div class="form-group">
                            <input id="txtotal" type="number" class="form-control" readonly oninput="jumlah()">
                        </div>
                        <label for="tximg">Foto Barang</label>
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
                        <button type="button" class="btn btn-primary btn-submit ms-1" onclick="add_barang()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Submit</span>
                        </button>
                        <button type="button" class="btn btn-warning btn-editen ms-1" onclick="update_barang()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Supplier -->
    <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="supplierModalLabel">Pilih Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="supplier-form">
                        <div id="checkbox-supplier-list"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Tutup</button>
                    <button type="button" class="btn btn-primary" id="save-supplier">Simpan</button>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="card card-data">
    <?php
    $breadcrumbs = array(
        'Home' => base_url(),
        'Manajemen Barang' => site_url('produk')
    );
    echo set_breadcrumb($breadcrumbs);
    ?>
    <div class="card-header">
        <h3 class="card-title" style="color:black;">
            Manajemen Barang
        </h3>
        <div class=" card-body information">
            <div class="alert alert-success" role="alert"> A simple success alert—check it out!</div>
            <div class="head-p">
                <span class="fas info fa-info-circle"></span> Informasi Manajemen Barang
            </div>
            <p class="p">Manajemen Barang adalah proses pengelolaan informasi produk, termasuk penambahan, pengeditan, dan penghapusan produk dalam sistem.
                Pengguna dapat menambahkan produk baru dengan mengisi detail seperti nama, deskripsi, kategori, harga, stok, dan foto.</p>
        </div>
    </div>
    <div class="card-body">
        <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bi bi-plus-lg"></i>Add</button>
        <button class="btn btn-primary" onclick="load_data()"><i class="bi bi-arrow-clockwise"></i>Refresh</button>

        <div class="table-responsive datatable-minimal" style="margin-top: 10px;">
            <table class="table" id="table2">
                <thead>
                    <tr>
                        <th>Id Barang</th>
                        <th>foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori Barang</th>
                        <th>Harga Barang</th>
                        <th>Stock Barang</th>
                        <th>Total Harga</th>
                        <th>Supplier</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>