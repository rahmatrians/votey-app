<?= $this->extend('layout/adminTemplate'); ?>


<?= $this->section('content'); ?>

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Pemilihan</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-2 col-md-6">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                            <div class="xz-card card">
                                <div class="card-body py-4-5">
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldPlus"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center mt-3">
                                            <h6 class="font-extrabold mb-0">Buat Pemilihan</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php foreach ($event as $data) :
                    ?>

                        <div class="col-6 col-lg-4 col-md-6">
                            <a href="<?= base_url(); ?>/kandidat/event/<?= $data['id_poll']; ?>">
                                <div class="xz-card card">
                                    <div class="card-body px-3 py-4-5 mx-2">
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                                <h6 class="font-extrabold mb-0"><?= $data['nama_poll']; ?></h6>
                                            </div>
                                            <div class="col-12">
                                                <p class="text-muted font-semibold"><?= $data['waktu']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php
                    endforeach; ?>





                </div>
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-5 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="<?= base_url(); ?>/vendor/images/faces/1.jpg" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold"><?= session()->get('nama_lengkap'); ?></h5>
                                <h6 class="text-muted mb-0"><?= session()->get('username'); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="card">
                            <div class="card-header">
                                <h4>Recent Messages</h4>
                            </div>
                            <div class="card-content pb-4">
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="<?= base_url(); ?>/vendor/images/faces/4.jpg">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">Hank Schrader</h5>
                                        <h6 class="text-muted mb-0">@johnducky</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="<?= base_url(); ?>/vendor/images/faces/5.jpg">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">Dean Winchester</h5>
                                        <h6 class="text-muted mb-0">@imdean</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="<?= base_url(); ?>/vendor/images/faces/1.jpg">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">John Dodol</h5>
                                        <h6 class="text-muted mb-0">@dodoljohn</h6>
                                    </div>
                                </div>
                                <div class="px-4">
                                    <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Start
                                        Conversation</button>
                                </div>
                            </div>
                        </div> -->
                <!-- <div class="card">
                            <div class="card-header">
                                <h4>Visitors Profile</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                            </div>
                        </div> -->
            </div>
        </section>
    </div>


    <!-- Vertically Centered modal Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-nd modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Buat Pemilihan
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url(); ?>/event/save" enctype="multipart/form-data" class="form form-vertical">
                        <?= csrf_field(); ?>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-4 has-icon-left">
                                                <label for="first-name-icon">Nama Voting</label>
                                                <div class="position-relative">
                                                    <input name="nama_poll" type="text" class="form-control <?= ($validation->hasError('nama_poll') ? 'is-invalid' : '') ?>" placeholder="Ketikkan di sini..." id="first-name-icon">
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
                                        <form action="" id="modalForm" method="POST" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="btn btn-primary ml-1">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Buat</span>
                                            </button>
                                        </form>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- Vertically Centered modal Modal -->


            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <!-- <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div> -->
                </div>
            </footer>
        </div>
    </div>


    <?= $this->endSection('content'); ?>