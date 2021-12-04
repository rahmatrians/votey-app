<?= $this->extend('layout/adminTemplate'); ?>

<?= $this->section('content'); ?>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading d-flex justify-content-between">
        <h3 class="">Peserta</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List Peserta</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama Lengkap</th>
                                                <th>Prodi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($peserta as $data) : ?>

                                                <tr>
                                                    <td><?= $data['nim']; ?></td>
                                                    <td><?= $data['nama_lengkap']; ?></td>
                                                    <td><?= $data['nama_prodi']; ?></td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto mx-auto">
                                                                <a href="<?= base_url() ?>/peserta/edit/<?= $data['nim']; ?>" class=" icon dripicons-pencil"></a>
                                                            </div>
                                                            <div class="col-auto mx-auto">
                                                                <form action="<?= base_url(); ?>/peserta/<?= $data['nim']; ?>" method="POST" class="d-inline">
                                                                    <?= csrf_field(); ?>
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button style="background-color: transparent; border: none;">
                                                                        <a class="icon dripicons-trash" style="color: red;"></a>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php endforeach ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Peserta</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="<?= base_url(); ?>/peserta/save" enctype="multipart/form-data" class="form form-vertical">
                                <?= csrf_field(); ?>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group mb-4 has-icon-left">
                                                        <label for="first-name-icon">NIM Peserta</label>
                                                        <div class="position-relative">
                                                            <input name="nim" value="<?= old('nim'); ?>" type="number" class="form-control <?= ($validation->hasError('nim') ? 'is-invalid' : '') ?>" placeholder="Ketikkan di sini..." id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                            <div class="invalid-tooltip">
                                                                <?= $validation->showError('nim'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group mb-4 has-icon-left">
                                                        <label for="first-name-icon">Nama Lengkap</label>
                                                        <div class="position-relative">
                                                            <input name="nama_lengkap" value="<?= old('nama_lengkap'); ?>" type="text" class="form-control <?= ($validation->hasError('nama_lengkap') ? 'is-invalid' : '') ?>" placeholder="Ketikkan di sini..." id="first-name-icon">
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
                                                            <input name="tgl_lahir" value="<?= old('tgl_lahir'); ?>" type="date" class="form-control <?= ($validation->hasError('tgl_lahir') ? 'is-invalid' : '') ?>" placeholder="Ketikkan di sini..." id="first-name-icon">
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
                                                        <select name="id_prodi" value="<?= old('prodi'); ?>" class="choices form-select <?= ($validation->hasError('prodi') ? 'is-invalid' : '') ?>">
                                                            <option value="">-- Pilih Prodi --</option>

                                                            <?php foreach ($prodi as $data) : ?>

                                                                <option value="<?= $data['id_prodi']; ?>"><?= $data['nama_prodi']; ?></option>

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

    <!-- Vertically Centered modal Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Vertically
                        Centered
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td class="px-3">
                                <p><strong>Nama Ketua</strong></p>
                            </td>
                            <td>
                                <p id="nama_ketua">-</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3">
                                <p><strong>Nama Wakil</strong></p>
                            </td>
                            <td>
                                <p id="nama_wakil">-</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3">
                                <p><strong>Slogan</strong></p>
                            </td>
                            <td>
                                <p id="slogan">-</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3">
                                <p><strong>VIsi</strong></p>
                            </td>
                            <td>
                                <p id="visi">-</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3">
                                <p><strong>Misi</strong></p>
                            </td>
                            <td>
                                <p id="misi">-</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <form action="" id="modalForm" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-warning ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Ubah</span>
                        </button>
                    </form>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered modal Modal -->
</div>


<script>
    $(document).ready(function() {
        $('.edit').on('click', function() {
            var id = $(this).attr('data');
            $.ajax({
                type: 'GET',
                url: '<?= base_url(); ?>/kandidat/' + id,
                dataType: 'json',
                success: function(data) {
                    $('#exampleModalCenter').modal('show');
                    $('#nama_ketua').html(data.kandidat.nama_ketua);
                    $('#modalForm').attr('action', '<?= base_url(); ?>/kandidat/edit/' + data.kandidat.id_kandidat);
                    $('#nama_wakil').html(data.kandidat.nama_wakil);
                    $('#slogan').html(data.kandidat.slogan);
                    $('#visi').html(data.kandidat.visi);
                    $('#misi').html(data.kandidat.misi);
                    $('[id="program_kerja"]').val(data.kandidat.program_kerja);
                }
            })
            return false;
        })
    })
</script>


<?= $this->endSection('content'); ?>