<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title ?? 'Error' ?></title>
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
    <link rel="stylesheet" type="text/css" href="public/css/vendor/flaticon/flaticon.css">
    <link rel="stylesheet" type="text/css" href="public/css/vendor/slick.css">
    <link rel="stylesheet" type="text/css" href="public/css/vendor/slick-theme.css">
    <!-- <link rel="stylesheet" type="text/css" href="public/css/vendor/jquery-ui.min.css"> -->
    <link rel="stylesheet" type="text/css" href="public/css/vendor/datatables.css">
    <link rel="stylesheet" type="text/css" href="public/css/vendor/sal.css">
    <link rel="stylesheet" type="text/css" href="public/css/vendor/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="public/css/vendor/base.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="public/js/vendor/sweetalert2.all.min.js"></script>
    <script src="public/js/vendor/jquery.js"></script>

</head>

<body>
    <div class="main">

        <?php
        require_once 'app/views/includes/header.php';
        $dataStoreCustom = ViewShare::$dataShare['dataStoreCustom'];
        //hide breadcumb
        if ($pages != 'product/detailProduct' && $pages != 'home' && $pages != 'checkout/checkout') {
            require_once 'app/views/includes/breadcumb.php';
        }
        ?>

        <main>
            <?php require_once 'app/views/pages/client/' . $pages . '.php' ?>
        </main>

        <?php
        require_once 'app/views/includes/footer.php'
        ?>

    </div>
    <!-- <div class="closeMask"></div> -->



    <!-- JS Vendor-->
    <script src="public/js/vendor/popper.min.js"></script>
    <script src="public/js/vendor/bootstrap.min.js"></script>
    <script src="public/js/vendor/slick.min.js"></script>
    <!-- <script src="public/js/vendor/jquery-ui.min.js"></script>
    <script src="public/js/vendor/jquery.ui.touch-punch.min.js"></script> -->
    <script src="public/js/vendor/jquery.dataTables.js"></script>

    <script src="public/js/vendor/sal.js"></script>
    <script src="public/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="public/js/vendor/counterup.js"></script>
    <script src="public/js/vendor/jquery.nice-select.min.js"></script>

    <!-- Main JS -->
    <script src="public/js/main.js"></script>

    <!-- Api JS -->
    <script src="services/base.js"></script>
    <script src="services/cartService.js"></script>
    <script src="services/ratingService.js"></script>
    <script src="services/productService.js"></script>



</body>


</html>