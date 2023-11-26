<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title  ?? 'Error' ?></title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="http://localhost/WEB2041_Ecommerce/">

    <!-- favicon  -->
    <link rel="apple-touch-icon" sizes="180x180" href="public/images/logo/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="public/images/logo/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/logo/favicon_io/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/logo/favicon_io/site.webmanifest">
    <!-- CSS -->

    <link rel="stylesheet" type="text/css" href="public/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/vendor/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="public/css/vendor/datatables.css">
    <link rel="stylesheet" type="text/css" href="public/css/vendor/select2.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/vendor/base.css">
    <link rel="stylesheet" type="text/css" href="public/css/admin/style.css">

    <script src="public/js/vendor/jquery.js"></script>
    <script src="public/js/vendor/sweetalert2.all.min.js"></script>


</head>

<body>
    <div class="main ">

        <?php
        require_once 'app/views/includes/admin/header.php';
        ?>

        <main>
            <?php
            require_once 'app/views/includes/admin/sidebar.php';
            ?>
            <div class="content-body-admin">
                <?php require_once 'app/views/pages/admin/' . $pages . '.php' ?>

            </div>
        </main>

    </div>



    <!-- JS Vendor-->
    <script src="public/js/vendor/bootstrap.min.js"></script>
    <script src="public/js/vendor/jquery.dataTables.js"></script>
    <script src="public/js/vendor/select2.min.js"></script>
    <script src="public/js/vendor/ckeditor.js"></script>


    <!-- Apexchar js -->
    <script src="public/js/vendor/apex-chart/moment.min.js"></script>
    <script src="public/js/vendor/apex-chart/apex-chart.js"></script>

    <!-- Main JS -->
    <script src="public/js/admin/main.js"></script>

    <!-- Api JS -->
    <script src="services/base.js"></script>
    <script src="services/userService.js"></script>
    <script src="services/productService.js"></script>
    <script src="services/statisticalService.js"></script>

</body>



</html>