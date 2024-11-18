<div class="container" style="padding: 20px;"><a href="<?php echo base_url('user') ?>"><i class="fa-solid fa-arrow-left"></i></a>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form>
                <h2 class="text-center mb-4">Account Settings</h2>
                <div class="form-group">
                    <label for="username"><strong>Username:</strong></label>
                    <input type="text" class="form-control" id="username" value="<?php echo $this->session->userdata('username'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="email" value="<?php echo $this->session->userdata('email'); ?>" readonly>
                </div>
                <div class="text-center mt-4">
                    <a type="button" class="btn btn-danger" href="<?= base_url('regAcc/logout'); ?>">Logout</a>
                </div>
            </form>
        </div>
    </div>
</div