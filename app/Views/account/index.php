<?php $this->extend('layout/adminTemplate'); ?>

<?php $this->section('content'); ?>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Pengaturan</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-12 col-sm-12">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-8 ">
                                                <label for="first-name-icon">Nama Lengkap</label>
                                                <h4><?= $admin['nama_lengkap']; ?></h4>
                                            </div>
                                            <div class="col-4 d-flex justify-content-end">
                                                <a class="btn btn-primary me-1 mb-1" id="btn-change-nama" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Ganti</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-12 col-sm-12">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-8 ">
                                                <label for="first-name-icon">Nama Pengguna</label>
                                                <h4><?= $admin['username']; ?></h4>
                                            </div>
                                            <div class="col-4 d-flex justify-content-end">
                                                <a class="btn btn-primary me-1 mb-1" id="btn-change-username" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Ganti</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-12 col-sm-12">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-8 ">
                                                <label for="first-name-icon">Kata Sandi</label>
                                                <h4>********</h4>
                                            </div>
                                            <div class="col-4 d-flex justify-content-end">
                                                <a class="btn btn-primary me-1 mb-1" id="btn-change-password" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Ganti</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>


    <!-- Vertically Centered modal Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-nd modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Kata Sandi
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url(); ?>/account/update/<?= $admin['id_admin']; ?>" enctype="multipart/form-data" class="form form-vertical">
                        <?= csrf_field(); ?>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-4 has-icon-left">
                                                <label id="label" for="first-name-icon">--</label>
                                                <div class="position-relative">
                                                    <input type="text" id="input-change-data" placeholder="Ketikkan di sini..." id="first-name-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-pencil"></i>
                                                    </div>
                                                    <div class="invalid-tooltip">
                                                        <?= $validation->showError('nama_poll'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Ubah</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- Vertically Centered modal Modal -->

        </div>
    </div>
</div>

<script>
    var getBtnNama = document.getElementById("btn-change-nama");
    var getBtnUsername = document.getElementById("btn-change-username");
    var getBtnPassword = document.getElementById("btn-change-password");
    getBtnNama.addEventListener("click", function() {
        document.getElementById("exampleModalCenterTitle").innerHTML = "Ubah Nama Lengkap";
        document.getElementById("input-change-data").setAttribute("name", "nama_lengkap");
        document.getElementById("input-change-data").setAttribute("value", "<?= (empty(old('nama_lengkap')) ? $admin['nama_lengkap'] : old('nama_lengkap')) ?>");
        document.getElementById("input-change-data").setAttribute("class", "form-control <?= ($validation->hasError('nama_lengkap') ? 'is-invalid' : '') ?>");
        document.getElementById("label").innerHTML = "Nama Lengkap";
    });
    getBtnUsername.addEventListener("click", function() {
        document.getElementById("exampleModalCenterTitle").innerHTML = "Ubah Nama Pengguna";
        document.getElementById("input-change-data").setAttribute("name", "username");
        document.getElementById("input-change-data").setAttribute("value", "<?= (empty(old('nama_lengkap')) ? $admin['username'] : old('username')) ?>");
        document.getElementById("input-change-data").setAttribute("class", "form-control <?= ($validation->hasError('username') ? 'is-invalid' : '') ?>");
        document.getElementById("label").innerHTML = "Nama Pengguna";
    });
    getBtnPassword.addEventListener("click", function() {
        document.getElementById("exampleModalCenterTitle").innerHTML = "Ubah Kata Sandi";
        document.getElementById("input-change-data").setAttribute("name", "password");
        document.getElementById("input-change-data").setAttribute("value", "");
        document.getElementById("input-change-data").setAttribute("class", "form-control");
        document.getElementById("label").innerHTML = "Kata Sandi";
    });
</script>

<?php $this->endSection('content'); ?>