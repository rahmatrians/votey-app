<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/vendor/vendors/apexcharts/apexcharts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="html2pdf.bundle.min.js"></script> -->


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

    <style>
        .xz-card {
            height: 160px !important;
        }
    </style>
</head>

<body style="background-color: white;">

    <div>

        <?= $this->renderSection('content'); ?>

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