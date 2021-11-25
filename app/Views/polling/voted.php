<?= $this->extend('layout/userTemplate'); ?>
<br>
<br>

<?= $this->section('content'); ?>


<div class="d-flex align-content-center" style="height: 100vh">
    <div class="mx-auto d-flex align-items-center">
        <div class="d-flex flex-column bd-highlight mb-3">
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
    <div class="d-block mx-auto d-flex align-items-center">
        <div class="d-flex flex-column bd-highlight mb-3">
            <h3 class="mb-3 bd-highlight flex-fill text-center mx-auto"><?= $message; ?></h3>
            <a class="mx-5 text-center btn btn-danger" href="<?= base_url(); ?>/auth/logout/<?= session()->get('nim'); ?>"><strong>Logout</strong></a>
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