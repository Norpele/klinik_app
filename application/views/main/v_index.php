<div class="container-fluid">
<div class="content">
    <!-- Header Section -->
    <div class="header-section bg-danger text-white py-4 px-3 rounded shadow-sm mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0">Dashboard Admin</h1>
            <p class="mb-0 fs-6">Selamat datang kembali! Pantau aktivitas klinik dengan mudah.</p>
        </div>
        <div>
            <i class="fas fa-user-circle">Admin</i> 
        </div>
    </div>

    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-xl-3 col-md-6">
            <a href="<?php echo base_url('Poli') ?>" style="text-decoration: none;">
                <div class="card bg-success text-white shadow-sm">
                    <div class="card-body">
                        <h5>Manajemen Poli</h5>
                        <p class="fs-4"><?php echo $total_poli ?></p>
                        <i class="fas fa-user-md fa-2x"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- Card 2 -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <h5>Manajemen Pasien</h5>
                    <p class="fs-4">0</p>
                    <i class="fas fa-users fa-2x"></i>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white shadow-sm">
                    <div class="card-body">
                        <h5>Antrian</h5>
                        <p class="fs-4">50</p>
                        <i class="fas fa-file-medical fa-2x"></i>
                    </div>
                </div>
            </div>
        <!-- Card 4 -->
        <div class="col-xl-3 col-md-6 ml-auto" style="text-align: end;">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body">
                    <h5>Jadwal Hari Ini</h5>
                    <p id="current-date" class="fs-3" style="font-size: 16px;"></p>
                    <i class="fas fa-calendar-check fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2024</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>
</div>