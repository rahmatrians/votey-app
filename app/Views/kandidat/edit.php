<?= $this->extend('layout/adminTemplate'); ?>

<?= $this->section('content'); ?>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Ubah Data Kandidat</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Kandidat</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="<?= base_url(); ?>/kandidat/update/<?= $kandidat['id_kandidat']; ?>" enctype="multipart/form-data" class="form form-vertical">
                                <?= csrf_field(); ?>
                                <input hidden name="id_poll" value="<?= $eventId; ?>" type="text">

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group mb-4 has-icon-left">
                                                        <label for="first-name-icon">Nama Calon Ketua</label>
                                                        <div class="position-relative">
                                                            <input value="<?= $kandidat['nama_ketua']; ?>" name="nama_ketua" type="text" class="form-control" placeholder="Ketikkan di sini..." id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group mb-4 has-icon-left">
                                                        <label for="first-name-icon">Nama Calon Wakil Ketua</label>
                                                        <div class="position-relative">
                                                            <input value="<?= $kandidat['nama_wakil']; ?>" name="nama_wakil" type="text" class="form-control" placeholder="Ketikkan di sini..." id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Foto Calon Ketua</label>
                                                        <input name="foto_ketua" class="form-control" type="file" id="formFile">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Foto Calon Wakil Ketua</label>
                                                        <input name="foto_wakil" class="form-control" type="file" id="formFile">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mb-4 has-icon-left">
                                                        <label for="first-name-icon">Slogan</label>
                                                        <div class="position-relative">
                                                            <input value="<?= $kandidat['slogan']; ?>" name="slogan" type="text" class="form-control" placeholder="Ketikkan di sini..." id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-chat"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-lg-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group mb-4">
                                                        <label for="first-name-icon">Visi</label>
                                                        <div class="form-floating">
                                                            <textarea name="visi" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="min-height: 200px;"><?= $kandidat['visi']; ?></textarea>
                                                            <label for="floatingTextarea">Ketikkan di sini...</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group mb-4">
                                                        <label for="first-name-icon">Misi</label>
                                                        <div class="form-floating">
                                                            <textarea name="misi" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="min-height: 200px;"><?= $kandidat['misi']; ?></textarea>
                                                            <label for="floatingTextarea">Ketikkan di sini...</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group mb-4">
                                                        <label for="first-name-icon">Program Kerja</label>
                                                        <div class="form-floating">
                                                            <textarea name="program_kerja" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="min-height: 200px;"><?= $kandidat['program_kerja']; ?></textarea>
                                                            <label for="floatingTextarea">Ketikkan di sini...</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <?= $this->endSection('content'); ?>