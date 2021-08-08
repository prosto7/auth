<?php session_start() ?>
<!-- header and nav -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <!-- Datatable -->
    <link href='/js/DataTables/datatables.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/js/DataTables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/js/DataTables/js/dataTables.bootstrap4.js">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- arcticModal theme -->
    <link rel="stylesheet" href="/js/modal/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="/js/modal/themes/simple.css">
    <!-- Custom style -->
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Datatable JS -->
    <script src="/js/DataTables/datatables.min.js"></script>
    <!-- arcticModal -->
    <script src="/js/modal/jquery.arcticmodal-0.3.min.js"></script>
</head>

<body>

    <header>
        <div class="container-fluid ">
            <nav class="navbar navbar-light opacity_menu p-0 justify-content-around d-flex align-items-center">
                <ul class="nav nav-pills ">
                    <li class="nav-item"><a href="/pages/registration.php" class="nav-link">Sign In</a></li>
                    <li class="nav-item"><a href="/pages/login.php" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="/pages/data_page.php" class="nav-link">Data list(Ajax)</a></li>
                    <li class="nav-item"><a href="/pages/data.php" class="nav-link">Data list(PHP)</a></li>


                    <?php
                    if (isset($_SESSION['superadmin'])) {
                        echo ' <li class="nav-item"><a href="/pages/admin_forms.php" class="nav-link">Admin Forms</a></li>';
                    }
                    if (isset($_SESSION['register']) || isset($_SESSION['superadmin'])) {
                        echo '<li class="nav-item"><a href="./out.php" class="nav-link">Exit</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>