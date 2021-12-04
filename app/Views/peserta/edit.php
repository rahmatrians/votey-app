<?= $this->extend('layout/adminTemplate'); ?>

<?= $this->section('content'); ?>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Ubah Data Peserta</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Peserta</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="<?= base_url(); ?>/peserta/update/<?= $peserta['nim']; ?>
                            " enctype="multipart/form-data" class="form form-vertical">
                                <?= csrf_field(); ?>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group mb-4 has-icon-left">
                                                        <label for="first-name-icon">Nama Lengkap</label>
                                                        <div class="position-relative">
                                                            <input name="nama_lengkap" value="<?= (empty(old('nama_lengkap')) ? $peserta['nama_lengkap'] : old('nama_lengkap')) ?>" type="text" class="form-control <?= ($validation->hasError('nama_lengkap') ? 'is-invalid' : '') ?>" placeholder="Ketikkan di sini..." id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                            <div class="invalid-tooltip">
                                                                <?= $validation->showError('nama_lengkap'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group mb-4 has-icon-left">
                                                        <label for="first-name-icon">Tanggal Lahir</label>
                                                        <div class="position-relative">
                                                            <input name="tgl_lahir" value="<?= (empty(old('nama_lengkap')) ? $peserta['tgl_lahir'] : old('tgl_lahir')) ?>" type="date" class="form-control <?= ($validation->hasError('tgl_lahir') ? 'is-invalid' : '') ?>" placeholder="Ketikkan di sini..." id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-calendar"></i>
                                                            </div>
                                                            <div class="invalid-tooltip">
                                                                <?= $validation->showError('tgl_lahir'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group mb-4 has-icon-left">
                                                        <label for="first-name-icon">Prodi</label>
                                                        <select name="id_prodi" class="choices form-select <?= ($validation->hasError('prodi') ? 'is-invalid' : '') ?>">

                                                            <?php foreach ($prodi as $data) :
                                                                if ($data['id_prodi'] == $oneProdi['id_prodi']) { ?>
                                                                    <option value="<?= $oneProdi['id_prodi']; ?>" selected><?= $oneProdi['nama_prodi']; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $data['id_prodi']; ?>"><?= $data['nama_prodi']; ?></option>
                                                                <?php } ?>

                                                            <?php endforeach ?>

                                                        </select>
                                                        <div class="invalid-tooltip">
                                                            <?= $validation->showError('prodi'); ?>
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
</div>



<?= $this->endSection('content'); ?>