<?= $this->extend('layout/reportTemplate'); ?>


<?= $this->section('content'); ?>

<?php

$namaProdi = [];
$totalVoteByProdi = [];

for ($x = 0; $x < count($totalPemilihByProdi); $x++) {
    $prodi[$x] = $totalPemilihByProdi[$x]['nama_prodi'];
}

for ($x = 0; $x < count($totalPemilihByProdi); $x++) {
    $totalVoteByProdi[$x] = $totalPemilihByProdi[$x]['total'];
}

?>


<!-- <button onclick="generatePDF()">Download as PDF</button> -->
<div class="container" id="invoice">
    <div class="row">
        <div class="col-12">
        </div>

        <div class="col">
            <h2 class="text-center mt-5">Laporan Mahasiswa yang Telah Voting</h2>
            <div onload="generatePDF()" class="col-3 mx-auto mt-5" id="barChart"></div>

            <section class="section col-12 mt-5 mx-auto">
                <div class="table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th class="text-center">NIM</th>
                                <th>Nama Lengkap</th>
                                <th class="text-center">Prodi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $x = 0;
                            foreach ($pesertaPemilih as $data) : ?>

                                <tr>
                                    <td class=""><?= $x + 1; ?></td>
                                    <td class=""><?= $pesertaPemilih[$x]['nim']; ?></td>
                                    <td class=""><?= $pesertaPemilih[$x]['nama_lengkap']; ?></td>
                                    <td class=""><?= $pesertaPemilih[$x]['nama_prodi']; ?></td>
                                </tr>

                            <?php
                                $x++;
                            endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </section>
        </div>

    </div>
</div>

<?php
$xls = [];
$xls[0] = ['NIM', 'Nama Lengkap', 'Nama Prodi'];
for ($i = 1; $i < 2; $i++) {
    $x = 1;
    foreach ($pesertaPemilih as $data) :

        $xls[$x][$i] = $data['nim'];
        $xls[$x][$i + 1] = $data['nama_lengkap'];
        $xls[$x][$i + 2] = $data['nama_prodi'];

        $x++;
    endforeach;
}

$xlsx = SimpleXLSXGen::fromArray($xls);
$xlsx->downloadAs('Laporan Pemilih Berdasarkan Prodi.xlsx'); ?>


<script>
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.location.href = 'http://localhost:8080/report/';
        }, 1000);
    });
</script>

<?= $this->endSection('content'); ?>