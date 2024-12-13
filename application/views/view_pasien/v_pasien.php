<div class="page-content">
    <div class="modal modal-add fade" id="loginModal" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nama_pasien">Nama Pasien</label>
                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien">
                        </div>
                        <div class="col-md-3">
                            <label for="umur">Umur</label>
                            <input type="number" class="form-control" id="umur" name="umur">
                        </div>
                        <div class="col-md-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
                            <input type="text" class="form-control" id="tanggal_pendaftaran" name="tanggal_pendaftaran" value="<?= date('Y-m-d')?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                        <div class="col-md-3">
                            <label for="bpjs">bpjs</label>
                            <select class="form-select" id="bpjs">
                            <option selected>Pilih Kelas Bpjs</option>
                            <option value="1">Kelas 1</option>
                            <option value="2">Kelas 2</option>
                            <option value="3">Kelas 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-closed btn-danger" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="btn-closed d-none d-sm-block ">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-submit ms-1" onclick="saveDataPasien()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Submit</span>
                        </button>
                        <button type="button" class="btn btn-warning btn-editen ms-1" onclick="update_pasien()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="card card-data">
    <div class="card-header">
        <h3 class="card-title" style="color:black;">
            Manajemen Pasien
        </h3>
    </div>
    <div class="card-body">
        <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bi bi-plus-lg"></i>Tambah</button>
        <button class="btn btn-primary" onclick="load_data()"><i class="bi bi-arrow-clockwise"></i>Refresh</button>

        <div class="table-responsive datatable-minimal" style="margin-top: 10px;">
            <div class="spinner-border text-success spinner" role="status" style ="display:none;">
                 <span class="visually-hidden">Loading...</span>
            </div>
            <table class="table" id="table2">
                <thead>
                    <tr>
                        <th>Id Pasien</th>                    
                        <th>Nama Pasien</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Nomor Unik Pasien</th>
                        <th>Kelas Bpjs</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>