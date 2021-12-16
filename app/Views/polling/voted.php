<?= $this->extend('layout/userTemplate'); ?>
<br>
<br>

<?= $this->section('content'); ?>


<div class="d-flex align-content-center" style="height: 100vh">
    <div class="mx-auto align-items-center">
        <div class="page-heading text-center mt-5 pt-5">
            <h3><?= $event['nama_poll'] ?></h3>
        </div>
        <div class="mb-3">
            <p style="font-size: 14pt;" class="mb-5 text-center"><?= $message; ?></b></p>
            <div class="row">

                <?php
                $x = 0;
                foreach ($kandidat as $data) : ?>

                    <div class="col">
                        <div class="card px-2" style="min-height: 350px;">
                            <div class="card-body">
                                <div class="mt-3 d-flex justify-content-center">
                                    <div class="avatar avatar-xl mx-auto">
                                        <img src="<?= base_url(); ?>/images/kandidat/<?= $data['foto_ketua']; ?>" class="mx-2" alt="Face 1">
                                        <img src="<?= base_url(); ?>/images/kandidat/<?= $data['foto_wakil']; ?>" class="mx-2" alt="Face 1">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="mt-5">
                                        <h5 class="font-bold text-center"><?= $data['nama_ketua']; ?> & <?= $data['nama_wakil']; ?></h5>
                                        <h6 class="text-muted text-center mb-0"><?= $data['slogan']; ?></h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="mt-4">
                                        <?php $total_poll[$x] = (int)$dataSuara[$x]['total_suara']; ?>
                                        <?php $kandName[$x] = $data['nama_ketua'] . ' & ' . $data['nama_wakil']; ?>

                                        <h1 class="text-center"><strong><?= $dataSuara[$x]['total_suara']; ?></strong></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                    $x++;
                endforeach; ?>

            </div>
        </div>
    </div>


    <div class="" style="position: absolute; top: 30px; right:30px;">
        <div class="card px-2">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="">
                        <h5 class="bd-highlight flex-fill text-left mx-auto"><b>halo, <?= $_SESSION['nama_lengkap']; ?></b></h5>
                    </div>
                </div>
                <div class="mt-3">
                    <a class="w-100 text-center btn btn-danger" href="<?= base_url(); ?>/auth/logout/<?= session()->get('nim'); ?>"><strong>Logout</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="page-content">
    <section class="row my-auto">
        <div class="col align-self-center">
            <div class="text-center">
                <h3>Kamu Sudah Memilih!</h3>
            </div>
        </div>
    </section>
</div> -->

<?= $this->endSection('content'); ?>