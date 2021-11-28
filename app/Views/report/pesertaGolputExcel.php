<?= $this->extend('layout/reportTemplate'); ?>


<?= $this->section('content'); ?>


<?php
$xls = [];
$xls[0] = ['No', 'NIM', 'Nama Lengkap', 'Prodi'];
for ($i = 1; $i < 2; $i++) {
    $x = 1;
    foreach ($pesertaGolput as $data) :

        $xls[$x][$i] = $x;
        $xls[$x][$i + 1] = $data['nim'];
        $xls[$x][$i + 2] = $data['nama_lengkap'];
        $xls[$x][$i + 3] = $data['nama_prodi'];

        $x++;
    endforeach;
}

$xlsx = SimpleXLSXGen::fromArray($xls);
$xlsx->downloadAs('Laporan Peserta Golput.xlsx'); ?>



<script>
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.location.href = 'http://localhost:8080/report/';
        }, 1000);
    });
</script>


<?= $this->endSection('content'); ?>