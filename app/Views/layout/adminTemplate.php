<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/vendor/vendors/apexcharts/apexcharts.js"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/css/bootstrap.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/simple-datatables/style.css">

    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/choices.js/choices.min.css" />

    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/iconly/bold.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/css/app.css">
    <link rel="shortcut icon" href="<?= base_url(); ?>/vendor/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/dripicons/webfont.css">

    <!-- noty js -->
    <link href="<?= base_url(); ?>/vendor/vendors/needim/noty/lib/noty.css" rel="stylesheet">
    <script src="<?= base_url(); ?>/vendor/vendors/needim/noty/lib/noty.js" type="text/javascript"></script>

    <!-- bounce js -->
    <script src="<?= base_url(); ?>/vendor/vendors/bounceJs/bounce.js" type="text/javascript"></script>

    <style>
        .xz-card {
            height: 160px !important;
        }

        .btn-logout:hover {
            background-color: #950000 !important;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <!-- <a href="index.html"><img src="<?= base_url(); ?>/vendor/images/logo/logo.png" alt="Logo" srcset=""></a> -->
                            <h2 style="color: #5561F5;"><i><strong>Votey App</strong></i></h2>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item ">
                            <a href="<?= base_url(); ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= base_url(); ?>/events" class='sidebar-link'>
                                <i class="bi bi-pencil"></i>
                                <span>Pemilihan</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= base_url(); ?>/peserta" class='sidebar-link'>
                                <i class="bi bi-person"></i>
                                <span>Peserta</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= base_url(); ?>/report" class='sidebar-link'>
                                <i class="bi bi-journal-text"></i>
                                <span>Laporan</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= base_url(); ?>/account/<?= session()->get('id_admin'); ?>" class='sidebar-link'>
                                <i class="bi bi-gear"></i>
                                <span>Pengaturan</span>
                            </a>
                        </li>
                        <!-- <hr> -->
                        <li class="sidebar-item mt-5">
                            <div class="sidebar-link btn btn-danger btn-logout">
                                <a class="text-center mx-auto text-white" href="<?= base_url(); ?>/auth/logout/<?= session()->get('id_admin'); ?>">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>



        <div>

            <?= $this->renderSection('content'); ?>

        </div>



    </div>
    <script src="<?= base_url(); ?>/vendor/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url(); ?>/vendor/js/pages/dashboard.js"></script>

    <script src="<?= base_url(); ?>/vendor/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <!-- Include Choices JavaScript -->
    <script src="<?= base_url(); ?>/vendor/vendors/choices.js/choices.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/js/pages/form-element-select.js"></script>

    <script src="<?= base_url(); ?>/vendor/js/main.js"></script>
</body>

</html>