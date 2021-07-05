<?php session_start();
include_once('classes.php');
include_once('menu.php');
?>
<div class='container mt-5 table'>
    <?php
    // login form 
    $head_echo =    "<div class='table-title'><h2>Log In</h2></div>
                <hr class='mb-5'>
                <div class='mb-3 table-content'>";


    if (isset($_POST['login']) && isset($_POST['password'])) {
        $users = User::checkUser($_POST['login'], $_POST['password']);
    }

    $echo = "<form method='post' id='login-form' class=''>
                        <label for='exampleInputEmail1' class='form-label'>Login</label><br>
                                      <input type='text' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp'  name='login' required><br>
                                        <label for='exampleInputPassword1' class='form-label'>Password</label>
                                     <input type='password' placeholder='Password' class='form-control'
                                       name='password' required><br>
                                    <input type='submit' value='Enter' class='btn btn-primary'>
                      </form> </div>";
    if ($_SESSION == null) {
        echo $head_echo;
        echo $echo;
    }
    ?>

</div>