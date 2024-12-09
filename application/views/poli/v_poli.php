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
                        <label for="txnama">Nama Supplier</label>
                        <div class="form-group">
                            <input id="txname_poli" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-closed btn-danger" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="btn-closed d-none d-sm-block ">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-submit ms-1" onclick="simpan_data()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Submit</span>
                        </button>
                        <button type="button" class="btn btn-warning btn-editen ms-1" onclick="update_supplier()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
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
            Manajemen Poli
        </h3>
    </div>
    <div class="card-body">
        <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bi bi-plus-lg"></i>Add</button>
        <button class="btn btn-primary" onclick="load_data()"><i class="bi bi-arrow-clockwise"></i>Refresh</button>

        <div class="table-responsive datatable-minimal" style="margin-top: 10px;">
            <table class="table" id="table2">
                <thead>
                    <tr>
                        <th>Id Poli</th>                    
                        <th>Poli</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>