<body>
    
    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="row mb-3">
                <div class="col-md-6" style="margin-left: 20px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="see-password">
                        <label class="form-check-label" for="see-password">
                            <i id="toggle-icon" class="fa-solid fa-eye"></i> Lihat Password
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
            <button type="button" class="btn btn-primary w-100" id="login-button">Login</button>
            </div>
            <div class="text-center row mb-3">
                <div class="small"><a href="<?= base_url(); ?>regAcc">doesn't an account? Go to register</a></div>
            </div>
        </form>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger mt-3 text-center" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
    </div>