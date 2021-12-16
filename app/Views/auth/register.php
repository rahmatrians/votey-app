<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Voting</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/css/app.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <!-- <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div> -->
                    <h1 class="auth-title">Buat Akun</h1>
                    <p class="auth-subtitle mb-5">Daftarkan dirimu untuk dapat mengakses seluruh fitur E-Voting</p>


                    <form method="post" action="<?= base_url(); ?>/auth/registerValidates">
                        <?= csrf_field(); ?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="nama_lengkap" type="text" class="form-control form-control-xl" placeholder="Nama Lengkap">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="email" type="email" class="form-control form-control-xl" placeholder="Email Aktif">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="username" type="text" class="form-control form-control-xl" placeholder="Nama Pengguna">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="password" type="password" class="form-control form-control-xl" placeholder="Kata Sandi Baru">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="confirm_password" type="password" class="form-control form-control-xl" placeholder="Konfirmasi Kata Sandi">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Daftar</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Sudah memiliki akun? <a href="<?= base_url(); ?>/auth" class="font-bold">Masuk</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>