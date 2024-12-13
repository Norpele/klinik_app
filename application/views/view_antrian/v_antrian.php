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
                        <label for="txnama_pasien">Nama Pasien</label>
                        <fieldset class="form-group">
                            <select class="form-select" id="txnama_pasien">

                            </select>
                        </fieldset>
                        <label for="txpoli">Poli</label>
                        <fieldset class="form-group">
                            <select class="form-select" id="txpoli">

                            </select>
                        </fieldset>
                        <label for="txtanggal">Tanggal Antri</label>
                        <input type="text" class="form-control" id="txtanggal" name="txtanggal" value="<?= date('Y-m-d') ?>" readonly>
                        <label for="txnomor_unik">No Unik Khusus Pasien</label>
                        <input type="text" class="form-control" id="txnomor_unik" name="txnomor_unik" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-closed btn-danger" data-bs-dismiss="modal" onchange="resetform()">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="btn-closed d-none d-sm-block ">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-submit ms-1" onclick="simpan_data_antrian()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card card-data">
    <div class="card-header">
        <h3 class="card-title" style="color:black;">
            Manajemen Antrian
        </h3>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="button-group">
                <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="bi bi-plus-lg"></i> Tambah
                </button>
                <button class="btn btn-primary ms-2" onclick="load_data()">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </button>
            </div>

            <div class="filter-data text-end">
                <h5 class="mb-2">Filter Data Antrian</h5>
                <fieldset class="form-group">
                    <select class="form-select" id="dropdown-filter" style="width: 200px;">
                        <option value="">-- Pilih Filter --</option>
                    </select>
                </fieldset>
            </div>
        </div>
        <div class="table-responsive datatable-minimal" style="margin-top: 10px;">
            <div class="spinner-border text-success spinner" role="status" style="display:none;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <table class="table" id="table2">
                <thead>
                    <tr>
                        <th>Id Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Nama Poli</th>
                        <th>Nomor Antrian</th>
                        <th>Tanggal Antrian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>