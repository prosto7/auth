<?php include_once('menu.php');
include_once('classes.php'); ?>


<div class="container table mt-5">
    <h2 class='mb-3'>Sign In</h2>

    <hr>

    <?php


    if (!isset($_POST['regbtn'])) {

        Form::createFormReg();     // form output on registration page  

    } else {
        if (is_uploaded_file($_FILES['imagepath']['tmp_name']))  //download images
        {
            $path = "../images/users/" . $_FILES['imagepath']['name'];
            move_uploaded_file($_FILES['imagepath']['tmp_name'], $path);
        }

        if ($_POST['pass1'] !== $_POST['pass2']) {
            echo "<h3 class='text-danger'>Passwords do not match</h3>";
            Form::createFormReg();
        }

        if ($_POST['pass1'] === $_POST['pass2']) {
            $user = new User($_POST['login'], $_POST['pass1'], $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['birthday'], $_POST['gender'], $path);
            if ($user->register()) {
                echo "<h3 class='text-success'>User added</h3>";
            }
        }
    }
    ?>
</div>