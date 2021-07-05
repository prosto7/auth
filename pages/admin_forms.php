<?php include_once('menu.php');
include_once('classes.php');

// admin's forms will be seen if we have session is the superadmin
if (isset($_SESSION['superadmin'])) {

    //hidden block for displaying success results of removing the update and adding --- controlled JQuery 
    echo '<div class="d-none container table mt-5" id="hide"><h5 id="text_notification" class="text-success"></h5></div>';

    // form admin add user   

    if (!isset($_POST['regbtn'])) {
        Form::createAdminForm();
    } else {

        if (is_uploaded_file($_FILES['imagepath']['tmp_name']))  //download images
        {
            $path = "../images/users/" . $_FILES['imagepath']['name'];
            move_uploaded_file($_FILES['imagepath']['tmp_name'], $path);
        }

        // check passwords in the form
        if ($_POST['pass1'] !== $_POST['pass2']) {
            echo "<div class='container table mt-3'><h3 class='text-danger'>Passwords do not match</h3></div>";
            Form::createAdminForm();
        }

        if ($_POST['pass1'] === $_POST['pass2']) {
            $user = new Admin($_POST['login'], $_POST['pass1'], $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['birthday'], $_POST['gender'], $path);
            if ($user->addUser()) {
                Form::createAdminForm();

                //script for displaying block with h5 'User Added' for 5 seconds
                echo "<script>
    $(document).ready(function(){
    $('#hide').removeClass('d-none');
    $('#text_notification').text('User Added');
    window.setTimeout(function(){   
    $('#hide').addClass('d-none');
    let baseUrl = window.location.href.split('?')[0];
    window.history.pushState('name', '', baseUrl);
    },5000);});</script>";
            }
        }
    }

?>

    <div class="container table">
        <h4>Update User</h4>
        <?php

        // Update user block
        //script -  if we select options ,the button 'Update' becomes active

        Admin::drawUpdateUser();

        $id = $_POST['user_name_update'];

        $user_props = Admin::outInfoUsers($id);

        echo "<script>
    $(document).ready(function(){
    $('#user_name_update').on('change', function() {
    $('#user_update input[type=submit]').prop('disabled', false);
    });});</script>";

        if (isset($_POST['change_user'])) {

            echo '<script>$(document).ready(function(){$("#update_news").removeAttr("disabled");
    $("#button_update_cancel").removeAttr("disabled")})</script>';
        }

        ?>

        <!--  form for update -->

        <form class="form-group mb-5" action="" target="" enctype="multipart/form-data" method="post" id="update">
            <div class="mb-3">
                <input type="hidden" name="id" value="<?= $user_props['id'] ?>">
                <label for="update_theme_login">Login</label>
                <input id="update_theme_login" class="form-control" type="text" name="login" value="<?= $user_props['login'] ?>">
            </div>
            <div class="mb-3">
                <label for="update_theme_fname">First name</label>
                <input id="update_theme_fname" class="form-control" type="text" name="namefirst" value="<?= $user_props['namefirst'] ?>">
            </div>
            <div class="mb-3">
                <label for="update_theme_lname">Last name</label>
                <input id="update_theme_lname" class="form-control" name="namelast" value="<?= $user_props['namelast'] ?>">
            </div>
            <label for="update_theme_email">Email</label>
            <input id="update_theme_email" class="form-control" type="text" name="email" value="<?= $user_props['email'] ?>">
            <div class="mb-3">
                <label for="update_theme_date">Date birthday</label>
                <input id="update_theme_date" class="form-control" type="date" name="age" value="<? $user_props['age'] ?> ">
            </div>
            <div class="mb-3">
                <label for="user_gender_update">Gender</label>
                <select class="form-control" name="gender" id="gender">
                    <option selected disabled><?= $user_props['gender'] ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <br>
            <p>User's photo</p>
            <img class='card-img-top picture_mid' src='<?= $user_props['imagepath'] ?>' alt=''>
            <br>

            <input id="update_img" type="file" accept="image/*" name="imagepath" value="<?= $user_props['imagepath'] ?>">

            <br>

            <br> <br>
            <button type="submit" name="update_news" id="update_news" value="update_news" class="btn btn-info" disabled>Update</button>
            <button type="submit" class="btn btn-danger" value="button_update_cancel" name="button_update_cancel" id="button_update_cancel" disabled>Cancel</button>
        </form>

        <?php

        if (isset($_POST['update_news'])) {

            $click = true;

            //conditions for changing the imagepath to image

            if ($_FILES['imagepath']['tmp_name'] != null) {

                $path = "../images/users/" . $_FILES['imagepath']['name'];
                move_uploaded_file($_FILES['imagepath']['tmp_name'], $path);
            } else {
                $id = $_POST['id'];
                $user_props = Admin::outInfoUsers($id);
                $path = $user_props['imagepath'];
            }

            if ($_POST['id'] != null) {

                $edit = new Editing(trim($_POST['login']), $_POST['namefirst'], $_POST['namelast'], $_POST['email'], $_POST['age'], $_POST['gender'], $path, $_POST['id']);
                $edit->updateToDb(trim($_POST['login']), $_POST['namefirst'], $_POST['namelast'], $_POST['email'], $_POST['age'], $_POST['gender'], $path, $_POST['id']);

                echo "<script>
    $(document).ready(function(){
        $('#hide').removeClass('d-none');
        $('#text_notification').text('User Updated');
        window.setTimeout(function(){   
        $('#hide').addClass('d-none');
        let baseUrl = window.location.href.split('?')[0];
        window.history.pushState('name', '', baseUrl);
        },5000);});</script>";
            }
        }

        // script for make active button 'delete user'
        echo "<script>
    $(document).ready(function(){
        $('#user_name').on('change', function() {
         $('#user_num input[type=submit]').prop('disabled', false);
        }); });</script>";

        // draw the form for delete users


        echo "<script>
    $(document).ready(function(){
        $('#del_user').click(function(){
          return confirm('Do you want to Delete ?');
            });
        });</script>";    //Clicking on Yes returns true, No returns false;      


        //by pressing button 'del_user',  make request to delete row from db 
        if (isset($_POST['del_user'])) {
            $id = $_POST['user_name'];
            Admin::deleteUser($id);

            // script for notification about succesfull update user

            echo "<script>
    $(document).ready(function(){
        $('#hide').removeClass('d-none');
        $('#text_notification').text('User Deleted');
        window.setTimeout(function(){   
        $('#hide').addClass('d-none');
        let baseUrl = window.location.href.split('?')[0];
        window.history.pushState('name', '', baseUrl);
        },5000);});</script>";
        }
        //displaying the select for delete
        //select to delete user 
        Admin::drawDeleteUser();

        ?>
    </div>

<?php
}
?>