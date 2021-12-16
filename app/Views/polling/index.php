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

    <div class="page-heading text-center my-5 py-5">
        <h3><?= $event['nama_poll'] ?></h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row d-flex justify-content-center">

                    <?php foreach ($kandidat as $data) : ?>

                        <div class="col-6 col-lg-4 col-md-6">
                            <form action="<?= base_url(); ?>/polling/voted/<?= $data['id_kandidat']; ?>" method="POST">
                                <div class="poll-card card">
                                    <div class="card-body d-flex flex-column">
                                        <div class="row">

                                            <div class="col-6 mt-4 mx-auto d-flex justify-content-center overflow-hidden" style="height: 120px;  width: 150px;">
                                                <div class="avatar avatar-xl mx-auto">
                                                    <img src="<?= base_url(); ?>/images/kandidat/<?= $data['foto_ketua']; ?>" class="mx-2" alt="Face 1">
                                                    <img src="<?= base_url(); ?>/images/kandidat/<?= $data['foto_wakil']; ?>" class="mx-2" alt="Face 1">
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <h6 class="font-extrabold mb-0"><?= $data['nama_ketua'] . ' & ' . $data['nama_wakil']; ?></h6>
                                                <p class="my-3"><?= $data['slogan']; ?></p>
                                            </div>
                                        </div>
                                        <?= csrf_field(); ?>
                                        <input hidden name="id_kandidat" value="<?= $data['id_kandidat']; ?>" type="text">
                                        <input hidden name="nim" value="<?= session()->get('nim'); ?>" type="text">
                                        <input hidden name="id_poll" value="<?= $data['id_poll']; ?>" type="text">
                                        <div class="m-3 mt-auto d-flex flex-column">
                                            <button type="submit" class="my-1 btn btn-primary">Pilih</button>
                                            <a href="" class="my-1 btn sec-button visi-misi" data="<?= $data['id_kandidat']; ?>">Visi Misi</a>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php endforeach; ?>

                </div>

            </div>
        </section>
    </div>

    <!-- Vertically Centered modal Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Nama Calon Ketua & Wakil Ketua
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="pt-3"><b>Visi</b></h6>
                    <p id="visi">-</p>
                    <h6 class="pt-3"><b>Misi</b></h6>
                    <p id="misi">-</p>
                    </h6>
                    <h6 class="pt-3"><b>Program Kerja</b></h6>
                    <p id="proker">-</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered modal Modal -->

    <div class="" style="position: absolute; top: 30px; right:30px;">
        <div class="card px-2">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="">
                        <h5 class="bd-highlight flex-fill text-left mx-auto"><b>halo, <?= $_SESSION['nama_lengkap']; ?></b></h5>
                    </div>
                </div>
                <div class="mt-2">
                    <a class="w-100 text-center btn btn-danger" href="<?= base_url(); ?>/auth/logout/<?= session()->get('nim'); ?>"><strong>Logout</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.visi-misi').on('click', function() {
            var id = $(this).attr('data');
            // console.log(id);
            $.ajax({
                type: 'GET',
                url: '<?= base_url(); ?>/polling/getKandidatById/' + id,
                dataType: 'json',
                success: function(data) {
                    $('#exampleModalCenter').modal('show');
                    $('#exampleModalCenterTitle').html(data.kandidat.nama_ketua + " & " + data.kandidat.nama_wakil);
                    $('#slogan').html(data.kandidat.slogan);
                    $('#visi').html(data.kandidat.visi);
                    $('#misi').html(data.kandidat.misi);
                    $('#proker').html(data.kandidat.program_kerja);
                }
            })
            return false;
        })
    })
</script>

<?= $this->endSection('content'); ?>