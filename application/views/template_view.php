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
    <link rel="stylesheet" href="/js/DataTables/css/buttons.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
    <!-- Custom style -->
    <link rel="stylesheet" href="/css/style.css">
    
    <script src="/js/jquery-3.6.js"></script>
    <script src="/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Datatable JS -->
    <script src="/js/DataTables/datatables.min.js"></script>
    <script src="/js/DataTables/js/dataTables.bootstrap4.js"></script>
    <script src="/js/DataTables/js/buttons.js"></script>
    <script src="/js/DataTables/js/button_bootstrap.js"></script>
    <script src="/js/DataTables/js/html5_button.js"></script>
    <script src="/js/DataTables/js/button_print.js"></script>
    <script src="/js/DataTables/js/button_zip.js"></script>
    <script src="/js/DataTables/js/button_pdf.js"></script>
    <script src="/js/DataTables/js/button_pdfmake.js"></script>
    <script src="/js/DataTables/js/dataTables.bootstrap4.js"></script>
    <script src="/js/DataTables/js/buttons.js"></script>
    <script src="/js/DataTables/js/html5_button.js"></script>
</head>

<body>

    <header>
        <div class="container-fluid ">
             <nav class="navbar navbar-light opacity_menu p-0 justify-content-around d-flex align-items-center">
                <ul class="nav nav-pills ">
                    <li class="nav-item"><a href="/" class="nav-link">Main Page</a></li>
                    <li class="nav-item"><a href="/login" class="nav-link">Sign In</a></li>
                    <li class="nav-item"><a id="login" href="" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="/table" class="nav-link">Data list(Ajax)</a></li>
                    <li class="nav-item"><a href="/data" class="nav-link">Data list(PHP)</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <body>
    <div class="container">
    <?php include_once 'application/views/'.$content_view; ?>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sign In</h5>
          <span aria-hidden="true">&times;</span>
      </div>
      <div class="modal-body">
      <div class='mb-3 table-content'>
<p class="d-none msg_error border_msg_error p-2">Lorem ipsum dolor sit.</p>
    <form id='login-form' >
        <label for='exampleInputEmail1' class='form-label'>Login</label><br>
        <input type='text' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' name='login' required><br>
        <label for='exampleInputPassword1' class='form-label'>Password</label>
        <input type='password' placeholder='Password' class='form-control' name='password' required><br>
        <p class="msg_reg">If you don't have an account yet. <a href="/registration"> Sign up now</a></p>
        <a class="msg_pass_recovery" href="/registration"> Forgot Username or Password?</a>
     
      </div>
   
      <div class="modal-footer">  
      
      <button type="submit" id ="login_btn" class="btn btn-primary " >Sign in</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
    </form>

      </div>
    </div>
  </div>
</div>
<script src="../js/main.js"></script>
<!-- script modal -->
<script src="/js/modal.js"></script>
    </body>
    </html>