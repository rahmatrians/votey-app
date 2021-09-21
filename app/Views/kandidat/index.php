<?= $this->extend('layout/adminTemplate'); ?>

<?= $this->section('content'); ?>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading d-flex justify-content-between">
        <h3 class=""><?= $event['nama_poll']; ?></h3>

        <form method="post" action="<?= base_url(); ?>/event/updateStatus/<?= $event['id_poll']; ?>" enctype="multipart/form-data" class="form form-vertical">
            <?= csrf_field(); ?>

            <?php if ($event['status'] == 0) { ?>
                <input hidden name="status" value="1" type="text">
                <button type="submit" class="btn btn-success me-1 mb-1 font-extrabold">Aktifkan</button>
            <?php } else { ?>
                <input hidden name="status" value="0" type="text">
                <button type="submit" class="btn btn-danger me-1 mb-1 font-extrabold">Hentikan</button>
            <?php } ?>

    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List Kandidat</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kandidat</th>
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $x = 1;
                                            foreach ($kandidat as $data) {
                                            ?>
                                                <!-- button trigger for  Vertically Centered modal -->
                                                <tr>
                                                    <td class="col-1">
                                                        <p><?= $x++; ?></p>
                                                    </td>
                                                    <td class="col-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-xl">
                                                                <img src="<?= base_url(); ?>/vendor/images/faces/5.jpg">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class="font-bold my-1 py-0"><?= $data['nama_ketua'] . ' & ' . $data['nama_wakil']; ?></p>
                                                        <p class="my-0 py-0"><?= $data['slogan']; ?></p>
                                                    </td>
                                                    <td class="col-3">
                                                        <div class="row">
                                                            <div class="col-auto mx-auto">
                                                                <a class=" icon dripicons-pencil edit" data="<?= $data['id_kandidat']; ?>"></a>
                                                            </div>
                                                            <div class="col-auto mx-auto">
                                                                <form action="<?= base_url(); ?>/kandidat/<?= $data['id_kandidat']; ?>" method="POST" class="d-inline">
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
                                            <?php
                                            };
                                            ?>
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
                        <h4 class="card-title">Tambah Kandidat</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="<?= base_url(); ?>/kandidat/save" enctype="multipart/form-data" class="form form-vertical">
                                <?= csrf_field(); ?>

                                <input hidden name="id_poll" value="<?= $event['id_poll']; ?>" type="text">

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group mb-4 has-icon-left">
                                                        <label for="first-name-icon">Nama Calon Ketua</label>
                                                        <div class="position-relative">
                                                            <input name="nama_ketua" type="text" class="form-control" placeholder="Ketikkan di sini..." id="first-name-icon">
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
                                                            <input name="nama_wakil" type="text" class="form-control" placeholder="Ketikkan di sini..." id="first-name-icon">
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
                                                            <input name="slogan" type="text" class="form-control" placeholder="Ketikkan di sini..." id="first-name-icon">
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
                                                            <textarea name="visi" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                                            <label for="floatingTextarea">Ketikkan di sini...</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group mb-4">
                                                        <label for="first-name-icon">Misi</label>
                                                        <div class="form-floating">
                                                            <textarea name="misi" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                                            <label for="floatingTextarea">Ketikkan di sini...</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group mb-4">
                                                        <label for="first-name-icon">Program Kerja</label>
                                                        <div class="form-floating">
                                                            <textarea name="program_kerja" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                                            <label for="floatingTextarea">Ketikkan di sini...</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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