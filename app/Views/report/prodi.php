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

            <section class="section col-10 mt-5 mx-auto">
                <div class="table-responsive">
                    <table class="table">
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



<script>
    // -- -- -- --pie chart-- -- -- --
    var prodi_array = <?php echo json_encode($prodi); ?>;
    var totalVoteByProdi_array = <?php echo json_encode($totalVoteByProdi); ?>;
    // console.log(total_poll_array);



    //  -------- bar chart  -------- 
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
    var options = {
        series: [{
            data: totalVoteByProdi_array
        }],
        chart: {
            animations: {
                enabled: false,
            },
            height: 350,
            type: 'bar',
            events: {
                click: function(chart, w, e) {
                    // console.log(chart, w, e)
                }
            }
        },
        colors: colors,
        plotOptions: {
            bar: {
                columnWidth: '45%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: prodi_array,
            labels: {
                style: {
                    colors: colors,
                    fontSize: '12px'
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#barChart"), options);
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
            }, 1500);
        }
    });
</script>

<?= $this->endSection('content'); ?>