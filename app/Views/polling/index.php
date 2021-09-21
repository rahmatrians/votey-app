<?= $this->extend('layout/userTemplate'); ?>
<br>
<br>

<?= $this->section('content'); ?>

<div id="">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading text-center my-5">
        <h3>Pilih Calon Ketua BEM!</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row d-flex justify-content-center">

                    <?php foreach ($kandidat as $data) : ?>

                        <div class="col-6 col-lg-4 col-md-6">
                            <form action="<?= base_url(); ?>/polling/voted/<?= $data['id_kandidat']; ?>" method="POST">
                                <div class="xz-card card">
                                    <div class="card-body d-flex flex-column">
                                        <div class="row">
                                            <div class="col-6 mt-4 mx-auto d-flex justify-content-center overflow-hidden" style="background-color:; height: 120px;  width: 150px;">
                                                <img src=" <?= base_url() . '/images/kandidat/' . $data['foto_ketua']; ?>" class="rounded-circle d-flex justify-content-center img-fluid">
                                            </div>
                                            <div class="col-md-12 text-center mt-4">
                                                <h6 class="font-extrabold mb-0"><?= $data['nama_ketua'] . ' & ' . $data['nama_wakil']; ?></h6>
                                            </div>
                                        </div>
                                        <?= csrf_field(); ?>
                                        <input hidden name="id_kandidat" value="<?= $data['id_kandidat']; ?>" type="text">
                                        <input hidden name="nim" value="<?= session()->get('nim'); ?>" type="text">
                                        <input hidden name="id_poll" value="<?= $data['id_poll']; ?>" type="text">
                                        <button type="submit" class="m-3 btn btn-primary mt-auto">Pilih</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php endforeach; ?>

                </div>

            </div>
            <!-- <div class="col-12 col-lg-3">
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

                    <a class="m-3 btn btn-danger" href="<?= base_url(); ?>/auth/logout/<?= session()->get('id_admin'); ?>">Logout</a>
                </div>
                <div class="card">
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
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Visitors Profile</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-visitors-profile"></div>
                    </div>
                </div>
            </div> -->
        </section>
    </div>

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

<?= $this->endSection('content'); ?>