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
            <div onload="generatePDF()" class="col-3 mx-auto mt-5" id="chart"></div>

            <section class="section col-6 mt-5 mx-auto">
                <div class="table-responsive">
                    <table class="table">
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
                            foreach ($kandidat as $data) : ?>

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



<script>
    // -- -- -- --pie chart-- -- -- --
    var total_poll_array = <?php echo json_encode($total_poll); ?>;
    var kandName_array = <?php echo json_encode($kandName); ?>;
    // console.log(total_poll_array);
    var options = {

        series: total_poll_array,
        chart: {
            width: 380,
            type: 'pie',
            animations: {
                enabled: false,
            },
        },
        labels: kandName_array,
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

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();


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
            data: total_poll_array
        }],
        chart: {
            height: 350,
            type: 'bar',
            animations: {
                enabled: false,
            },
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
            categories: kandName_array,
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
            }, 1000);
        }
    });
</script>


<?= $this->endSection('content'); ?>