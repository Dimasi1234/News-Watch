<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Register</title>
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/styles.css') ?>" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Register</h3>
                                </div>
                                <div class="card-body">
                                    <?php if (session()->getFlashdata('error')): ?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                    <?php endif; ?>
                                    <?php if (session()->getFlashdata('success')): ?>
                                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                                    <?php endif; ?>

                                    <form action="<?= base_url('register') ?>" method="post" autocomplete="off">
                                        <?= csrf_field() ?>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="username" type="text" value="<?= old('username') ?>" required />
                                            <label for="username">Username</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="email" type="email" value="<?= old('email') ?>" required />
                                            <label for="email">Email address</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="password" type="password" required />
                                            <label for="password">Password</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password_confirm" id="password_confirm" type="password" required />
                                            <label for="password_confirm">Confirm Password</label>
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small">
                                        <a href="<?= base_url('/login') ?>">Sudah punya akun? Login di sini!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; News Update 2025</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/admin/js/scripts.js') ?>"></script>
</body>
</html>
