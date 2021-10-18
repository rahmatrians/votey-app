<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/css/bootstrap.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/iconly/bold.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/css/app.css">
    <link rel="shortcut icon" href="<?= base_url(); ?>/vendor/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/vendors/dripicons/webfont.css">

    <style>
        .xz-card {
            height: 350px !important;
        }

        .poll-card {
            height: 400px !important;
        }

        .sec-button {
            background-color: white;
            border: 1px solid #3950A2;
            color: #3950A2;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto">


                <div>

                    <?= $this->renderSection('content'); ?>

                </div>


            </div>
        </div>
    </div>


    <script src="<?= base_url(); ?>/vendor/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url(); ?>/vendor/vendors/apexcharts/apexcharts.js"></script>
    <script src="<?= base_url(); ?>/vendor/js/pages/dashboard.js"></script>


    <script src="<?= base_url(); ?>/vendor/js/main.js"></script>
</body>

</html>