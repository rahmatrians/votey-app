<?= $this->extend('layout/reportTemplate'); ?>

<?php
for ($x = 0; $x < count($pesertaGolput); $x++) {
    $golput[$x] = $pesertaGolput[$x]['nim'];
}

$dataGolput = [
    $totalGolput,
    $totalPeserta,
];
?>


<?= $this->section('content'); ?>


<!-- <button onclick="generatePDF()">Download as PDF</button> -->
<div class="container" id="invoice">
    <div class="row">
        <div class="col">
            <h2 class="text-center mt-5">Laporan Peserta yang Tidak Memilih</h2>
            <div onload="generatePDF()" class="col-3 mx-auto mt-5" id="donutChart"></div>

            <section class="section col-10 mt-5 mx-auto">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Prodi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $x = 0;
                            foreach ($pesertaGolput as $data) : ?>

                                <tr>
                                    <td class=""><?= $x + 1; ?></td>
                                    <td class=""><?= $data['nim']; ?></td>
                                    <td class=""><?= $data['nama_lengkap']; ?></td>
                                    <td class=""><?= $data['nama_prodi']; ?></td>
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



<script>
    var golput_array = <?php echo json_encode($dataGolput); ?>;
    var colors = [
        "#F3B415",
        "#F27036",
        "#663F59",
        "#6A6E94",
        "#4E88B4",
        "#00A7C6",
        "#18D8D8",
        "#A9D794",
        "#46AF78",
        "#A93F55",
        "#8C5E58",
        "#2176FF",
        "#33A1FD",
        "#7A918D",
        "#BAFF29"
    ];

    // --------------------------- donut chart ----------------------------

    var options = {
        series: golput_array,
        chart: {
            animations: {
                enabled: false,
            },
            type: 'donut',
        },
        labels: ['Total Belum Memilih', 'Total Telah Memililh'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#donutChart"), options);
    chart.render();
</script>

<script>
    window.addEventListener("load", function() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById('invoice');
        // Choose the element and save the PDF for our user.
        if (html2pdf().from(element).save()) {
            setTimeout(function() {
                window.location.href = 'http://localhost:8080/report/';
            }, 1000);
        }
    });
</script>


<?= $this->endSection('content'); ?>