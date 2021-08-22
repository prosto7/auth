<div class="container table mt-5">
    <h2 class='mb-3'>Sign In</h2>
    <hr>
    <?php

    if ($data !== null) {
        $errors = $data[0];
        $values = $data[1];
        if (isset($errors) && is_array($errors)) : ?>
            <ul>
                <?php
                foreach ($errors as $error) : ?>
                    <li> - <?= $error; ?></li>
            <?php endforeach;
                $values = $data[1];
            endif;
            ?>
            </ul>
        <?php
    } else {
        $values = array(
            'login' => null,
            'email' => null,
            'pass' => null,
            'pass2' => null,
            'namefirst' => null,
            'namelast' => null,
            'birthday' => null,
            'gender' => null,
        );
    }
        ?>
        <form class="registration_form" action="<?php echo htmlspecialchars('/register'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="login">Login:
                    <input type="text" class="form-control" name="login" id="login" value="<?php echo $values['login'] ?>" autocomplete="on">

                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="pass1">Password:
                    <input type="password" class="form-control" name="pass1" id="pass1" value="<?= $values['pass'] ?>">

                </label>
                <br><br>
            </div>
            <div class=" form-group">
                <label for="pass2">Password confirm:
                    <input type="password" class="form-control" name="pass2" id="pass2" value="<?= $values['pass2'] ?>">
                </label>
                <br><br>

            </div>
            <div class="form-group">
                <label for="email">Email:
                    <input type="email" class="form-control" name="email" id="email" value="<?= $values['email'] ?>">

                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="first_name">First Name:
                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $values['namefirst'] ?>">

                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:
                    <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $values['namelast'] ?>">

                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:
                    <input type="date" class="form-control" name="birthday" id="birthday" value="<?= $values['birthday'] ?>">

                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="gender">Sex:</label>
                <select class="form-control" id="gender" name="gender" value="<?= $values['gender'] ?>">
                    <option selected disabled>Select sex</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <br><br>
            </div>
            <div class="form-group">
                <label for="imagepath">Upload image:
                    <input type="file" class="form-control" name="imagepath" id="imagepath">
                </label>
            </div>
            <input type="submit" name="regbtn" class="btn btn-primary" value="Register">
        </form>
</div>