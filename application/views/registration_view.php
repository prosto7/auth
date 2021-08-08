
    <div class="container table mt-5">
        <h2 class='mb-3'>Sign In</h2>

        <hr>
        <form class="registration_form" action="<?php echo htmlspecialchars('/register');?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="login">Login:
                    <input type="text" class="form-control" name="login" id="login" value="" autocomplete="off">
            
                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="pass1">Password:
                    <input type="password" class="form-control" name="pass1" id="pass1" value="">
               
                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="pass2">Password confirm:
                    <input type="password" class="form-control" name="pass2" id="pass2" value="">
                </label>
                <br><br>
                
            </div>
            <div class="form-group">
                <label for="email">Email:
                    <input type="email" class="form-control" name="email" id="email" value="">
                   
                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="first_name">First Name:
                    <input type="text" class="form-control" name="first_name" id="first_name" value="">
              
                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:
                    <input type="text" class="form-control" name="last_name" id="last_name" value="">
                  
                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:
                    <input type="date" class="form-control" name="birthday" id="birthday" value="">
                   
                </label>
                <br><br>
            </div>
            <div class="form-group">
                <label for="gender">Sex:</label>
                <select class="form-control" id="gender" name="gender" value="">
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