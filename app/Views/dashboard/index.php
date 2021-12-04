<?= $this->extend('layout/adminTemplate'); ?>

<?php

$total_poll = [];
$kandName = [];
$prodi = [];
$totalVoteByProdi = [];

if ($totalPemilihByProdi != null) {

    for ($x = 0; $x < count($totalPemilihByProdi); $x++) {
        $prodi[$x] = $totalPemilihByProdi[$x]['nama_prodi'];
    }

    for ($x = 0; $x < count($totalPemilihByProdi); $x++) {
        $totalVoteByProdi[$x] = $totalPemilihByProdi[$x]['total'];
    }
}

?>


<?= $this->section('content'); ?>



<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3 id="tessst">Dashboard</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">

                    <?php
                    if (!empty($kandidat)) {
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
                        endforeach;
                    } else { ?>
                        <div class="col">
                            <div class="card px-2" style="min-height: 350px;">
                                <div class="card-body justify-content-center d-flex align-items-center">
                                    <p class="text-center">Data Masih Kosong!</p>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="card" style="min-height: 500px;">
                            <div class="card-header">
                                <h4>Perbandingan Suara</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="min-height: 500px;">
                            <div class="card-header">
                                <h4>Pemilih Berdasarkan Prodi</h4>
                            </div>
                            <div class="card-body">
                                <div id="barChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row bd-highlight mb-3 mt-4">
                                    <div class="p-2 bd-highlight">
                                        <h4 class="text-muted d-flex">Telah Memilih</h4>
                                    </div>
                                    <div class="p-2 bd-highlight">
                                        <h4 class="d-flex"><strong>
                                                <?php if (empty($totalSuara['total_suara'])) {
                                                ?>
                                                    --
                                                <?php
                                                } else { ?>
                                                    <?= $totalSuara['total_suara']; ?>
                                                <?php }; ?>
                                            </strong></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row bd-highlight mb-3 mt-4">
                                    <div class="p-2 bd-highlight">
                                        <h4 class="text-muted d-flex">Belum Memilih</h4>
                                    </div>
                                    <div class="p-2 bd-highlight">
                                        <h4 class="d-flex"><strong>
                                                <?php if (empty($totalSuara['total_suara'])) {
                                                ?>
                                                    --
                                                <?php
                                                } else { ?>
                                                    <?= $totalPeserta - $totalSuara['total_suara']; ?>
                                                <?php }; ?>
                                            </strong></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-5 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="<?= base_url(); ?>/vendor/images/faces/1.jpg" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold"><?= session()->get('nama_lengkap'); ?></h5>
                                <h6 class="text-muted mb-0"><?= session()->get('username'); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>




    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <!-- <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div> -->
        </div>
    </footer>
</div>


<script>
    function addElement(name) {
        var tag = document.createElement("p");
        var text = document.createTextNode("Data masih Kosong!");
        tag.appendChild(text);
        tag.setAttribute("class", "text-center mt-5");
        var element = document.querySelector(name);
        element.appendChild(tag);
    }
    if (parseInt(<?= json_encode($total_poll) ?>) === 0 || isNaN(parseInt(<?php echo json_encode($total_poll); ?>))) {
        addElement("#chart");
    } else {
        // -- -- -- --pie chart-- -- -- --
        var total_poll_array = <?php echo json_encode($total_poll); ?>;
        var kandName_array = <?php echo json_encode($kandName); ?>;
        var options = {

            series: total_poll_array,
            chart: {
                width: 380,
                type: 'pie',
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
    }
    var prodi = <?php echo json_encode($prodi); ?>;
    if (prodi == 0) {
        addElement("#barChart");
    } else {
        //  -------- bar chart  -------- 
        var prodi_array = <?php echo json_encode($prodi); ?>;
        var totalVoteByProdi_array = <?php echo json_encode($totalVoteByProdi); ?>;
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
    }
</script>


<?= $this->endSection('content'); ?>