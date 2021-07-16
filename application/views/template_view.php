<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User's Data</title>
    <!-- Datatable -->
    <link href='/js/DataTables/datatables.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/js/DataTables/css/dataTables.bootstrap4.css">
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
    <script src="/js/DataTables/js/dataTables.bootstrap4.js"></script>
    <!-- arcticModal -->
    <script src="/js/modal/jquery.arcticmodal-0.3.min.js"></script>
  
</head>

<body>

    <header>
        <div class="container-fluid ">
             <nav class="navbar navbar-light opacity_menu p-0 justify-content-around d-flex align-items-center">
                <ul class="nav nav-pills ">
                    <li class="nav-item"><a href="/" class="nav-link">Main Page</a></li>
                    <li class="nav-item"><a href="/registration" class="nav-link">Sign In</a></li>
                    <li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="/table" class="nav-link">Data list(Ajax)</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <body>
    <div class="container">
    <?php include_once 'application/views/'.$content_view; ?>
    </div>

<script>

</script>

<script src="../js/main.js"></script>
<!-- script modal -->
<script src="/js/modal.js"></script>
    </body>
    </html>