<?= $this->extend('layout/userTemplate'); ?>
<br>
<br>

<?= $this->section('content'); ?>


<div class="d-flex align-content-center" style="height: 100vh">
    <div class="mx-auto d-flex align-items-center">
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