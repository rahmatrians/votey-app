<?= $this->extend('layout/reportTemplate'); ?>


<?= $this->section('content'); ?>


<!-- <button onclick="generatePDF()">Download as PDF</button> -->
<div class="container" id="invoice">
    <div class="row">
        <div class="col-12">

            <?php
            $x = 0;
            foreach ($kandidat as $data) : ?>

                <?php $total_poll[$x] = (int)$dataSuara[$x]['total_suara']; ?>
                <?php $kandName[$x] = $data['nama_ketua'] . ' & ' . $data['nama_wakil']; ?>

            <?php
                $x++;
            endforeach; ?>

        </div>

        <div class="col">
            <h2 class="text-center mt-5">Laporan Pemungutan Suara</h2>

            <section class="section col-6 mt-5 mx-auto">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Ketua & Wakil Kandidat</th>
                                <th class="text-center">Total Suara</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $x = 0;
                            $xls = [];
                            foreach ($kandidat as $data) :

                            ?>

                                <tr>
                                    <td class=""><?= $x + 1; ?></td>
                                    <td class=""><?= $data['nama_ketua']; ?> & <?= $data['nama_wakil']; ?></td>
                                    <td class="text-bold text-center"><strong><?= $dataSuara[$x]['total_suara']; ?></strong></td>
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
$xls[0] = ['Nama', 'Total'];
for ($i = 1; $i < 2; $i++) {
    $x = 1;
    foreach ($kandidat as $data) :

        $xls[$x][$i] = $data['nama_ketua'] . " & " . $data['nama_wakil'];
        $xls[$x][$i + 1] = $dataSuara[$x - 1]['total_suara'];

        $x++;
    endforeach;
}

$xlsx = SimpleXLSXGen::fromArray($xls);
$xlsx->downloadAs('file.xlsx');; ?>



<script>
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.location.href = 'http://localhost:8080/';
        }, 5000);
    });
</script>


<?= $this->endSection('content'); ?>