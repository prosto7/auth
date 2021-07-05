<?php

// all classes with fucntions (connect DB, registration, auth, add, update and delete users)

class Tools
{

    // the main connection to db we will use PDO
    static function connect($host = "127.0.0.1", $user = 'root', $pass = '', $dbname = 'sibers') //config connect DB 
    {
        $cs = "mysql:host=$host;dbname=$dbname;charset=utf8";

        // options PDO
        $options =
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ];
        try {
            $pdo = new PDO($cs, $user, $pass, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //alternative connect to DB with mysqli connect, because i will use method mysqli_real_escape_string, and i don't know how i can use PDO with this method
    static function alternativeConnect()
    {
        $con = mysqli_connect($host = "127.0.0.1", $user = 'root', $pass = '', $dbname = 'sibers');
        return $con;
        // Check connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}
// class for strong hash generation
class Salt
{

    // generate salt for password SHA-256

    static function generate_salt($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return  '$5$rounds=5000$' . substr(str_shuffle($chars), 0, $length);
    }
}

class User
{

    // declare object properties

    public $id;
    public $login;
    public $pass;
    public $roleid;
    public $email;
    public $namefirst;
    public $namelast;
    public $age;
    public $gender;
    public $imagepath;
    public $salt;

    function __construct($login, $pass, $email, $namefirst, $namelast, $age, $gender, $imagepath, $id = 0)
    {
        $this->salt = Salt::generate_salt();  // salt for password 
        $this->login = trim($login);
        $this->pass = crypt($pass, $this->salt);   // hash the password
        $this->email = trim($email);
        $this->namefirst = $namefirst;
        $this->namelast = $namelast;
        $this->age = $age;
        $this->gender = $gender;
        $this->imagepath = $imagepath;
        $this->id = $id;
        $this->roleid = 2;  // simple user, hasn't extended rights , user SuperAdministrator with extended rights is created in in the DB directly      
    }

    // function for registration simple user
    function register()
    {
        if ($this->login === '') {
            echo "<h3 class='text-danger'>Enter login</h3>";
            Form::createFormReg();  //this method drawes form for registration
            return false;
        }
        if ($this->pass === '') {
            echo "<h3 class='text-danger'>Enter password</h3>";
            Form::createFormReg();
            return false;
        }
        if ($this->email === '' || $this->gender === '' || $this->birthday === '' || $this->first_name === '' || $this->last_name === '') {
            echo "<h3 class='text-danger'>Enter all data</h3>";
            Form::createFormReg();
            return false;
        }

        if (strlen($this->login) < 6 || strlen($this->login) > 32 || strlen($this->pass) < 6 || strlen($this->pass) > 128) {
            echo "<h3 class='text-danger'>Incorrect fields length</h3>";
            Form::createFormReg();
            return false;
        }

        $this->intoDb();

        return true;
    }

    //  this function adds the received data in table  
    function intoDb()
    {
        try {

            $pdo = Tools::connect();
            $checker = $pdo->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = :login");
            $checker->bindParam(':login', $login);
            $checker->execute();
            $row_count = $checker->fetchColumn();
            if ($row_count !== 1) {   // if table `users` has this login and hash password matches the entered password, user come in site


                $ps = $pdo->prepare("INSERT INTO users (login, pass, roleid, email, namefirst, namelast, age, gender,imagepath,salt) VALUES (:login, :pass, :roleid, :email,:namefirst, :namelast, :age, :gender, :imagepath,:salt)");

                // naming an object this, and transform to array
                $ar = (array)$this;
                array_shift($ar);
                // delete first element array  :id
                // ar = :login, :pass, :roleid, :email, :namefirst, :namelast ,:age, :gender,:imagepath          
                $ps->execute($ar);

                $result = true;
            } else {
                $result = false;
                $ps = null;
                $pdo = null;
                $checker = null;
                return false;
            }
        } catch (PDOException $e) {
            echo '<div class="container table mt-4"><h4 class="text-warning">Login is already use, please select other login.</h4></div>';
        }
        $ps = null;
        $pdo = null;
        return $result;
    }

    //  function for check users at the entrance to the site
    static function checkUser($login, $pass)
    {
        try {
            $pdo = Tools::connect();
            $sql = $pdo->prepare("SELECT * FROM `users` WHERE `login` = :login");
            $sql->execute(array('login' => $login));
            $salt_row = $sql->fetch(PDO::FETCH_ASSOC);
            $salt_one = $salt_row['salt'];
            $hashed_password = $salt_row['pass'];   // select salt and pass from DB , for further verification users
            $ps = $pdo->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = :login");
            $ps->bindParam(':login', $login);
            $ps->execute();
            $row_count = $ps->fetchColumn();
            if ($row_count == 1 && hash_equals($hashed_password, crypt($pass, $salt_one)))   // if table `users` has this login and hash password matches the entered password, user come in site
            {
                if ($salt_row['roleid'] === '1') {                 // if roleid in the table 1 user is SuperAdministrator can see new section 'Admin Forms' and he can update, delete and add users in the DB
                    $admin = $salt_row['login'];
                    echo "<h5 class='text-primary mb-3'>Hello, SuperAdministrator " .  $admin . "</h5>";
                    $_SESSION['superadmin'] =  $admin;
                } else {
                    echo "<h5 class='text-success mb-3'>Hello, " . $login . "</h5>";
                    $_SESSION['register'] = $login;  // SESSION[register] - simple user (roleid = 2, it's default setting) can see the table with data list
                }
                $result = true;
                return true;
            } else {
                $result = false;
                echo "<h5 class='text-danger mb-3'>Login or Password are Invalid</h5>";
                return false;
            }
        } catch (PDOException $e) {
            die("Secured");
        }
        $ps = null;
        $pdo = null;
        return $result;
    }
}

//class drawes form output on registration page 
class Form
{

    static function createFormReg()
    {

        echo '<form class="registration_form" action="" method="post" enctype="multipart/form-data">
           <div class="form-group">
               <label for="login">Login:
                   <input type="text" class="form-control" name="login" id="login" autocomplete="off">
               </label>
           </div>
           <div class="form-group">
               <label for="pass1">Password:
                   <input type="password" class="form-control" name="pass1" id="pass1">
               </label>
           </div>
           <div class="form-group">
               <label for="pass2">Password confirm:
                   <input type="password" class="form-control" name="pass2" id="pass2">
               </label>
           </div>
           <div class="form-group">
               <label for="email">Email:
                   <input type="email" class="form-control" name="email" id="email">
               </label>
           </div>
           <div class="form-group">
               <label for="first_name">First Name:
                   <input type="text" class="form-control" name="first_name" id="first_name">
               </label>
           </div>
           <div class="form-group">
               <label for="last_name">Last Name:
                   <input type="text" class="form-control" name="last_name" id="last_name">
               </label>
           </div>
           <div class="form-group">
               <label for="birthday">Birthday:
                   <input type="date" class="form-control" name="birthday" id="birthday">
               </label>
           </div>
           <div class="form-group">
                           <label for="gender">Sex:</label>
                           <select class="form-control" id="gender" name="gender">
                               <option selected disabled>Select sex</option>    
                               <option>Male</option>
                               <option>Female</option>
                           </select>
                       </div>
            <div class="form-group">
               <label for="imagepath">Upload image:
                   <input type="file" class="form-control" name="imagepath" id="imagepath">
               </label>
           </div>
           <input type="submit" name="regbtn" class="btn btn-primary" value="Register">
       </form>';
    }

    static function createAdminForm()
    {

        echo '<div class="container table mt-5">
                    <h4 class="mb-2">Add user</h4>
                <form class="admin-form" action="" method="post" enctype="multipart/form-data">
                    <label for="login">Login:
                        <input type="text" class="form-control" name="login" id="login" autocomplete="off">
                    </label>  
                    <label for="pass1">Password:
                        <input type="password" class="form-control" name="pass1" id="pass1">
                    </label>
                    <label for="pass2">Password confirm:
                        <input type="password" class="form-control" name="pass2" id="pass2">
                    </label>
                    <label for="email">Email:
                        <input type="email" class="form-control" name="email" id="email">
                    </label>  
                    <label for="first_name">First Name:
                        <input type="text" class="form-control" name="first_name" id="first_name">
                    </label>
                    <label for="last_name">Last Name:
                        <input type="text" class="form-control" name="last_name" id="last_name">
                    </label>
                    <label for="birthday">Birthday:
                        <input type="date" class="form-control" name="birthday" id="birthday">
                    </label>
                     <label for="gender">Sex:</label>
                     <select class="form-control" id="gender_add" name="gender">
                    <option selected disabled>Select sex</option>    
                    <option>Male</option>
                    <option>Female</option>
                    </select>
                    <label class="mt-4" for="imagepath">Upload image:
                        <input type="file" class="form-control" name="imagepath" id="imagepath">
                    </label>
                <input type="submit" name="regbtn" class="btn btn-primary" value="Add">
            </form></div>';
    }
}

//new class Admin make the administrator who will have suoer rights 
class Admin extends User
{

    function addUser()
    {

        if ($this->login === '') {
            echo "<div class='container table mt-3'><h3 class='text-danger'>Enter login</h3></div>";
            Form::createAdminForm();
            return false;
        }
        if ($this->pass === '') {
            echo "<div class='container table mt-3'><h3 class='text-danger'>Enter password</h3></div>";
            Form::createAdminForm();
            return false;
        }
        if ($this->email === '' || $this->gender === '' || $this->birthday === '' || $this->first_name === '' || $this->last_name === '') {
            echo "<div class='container table mt-3'><h3 class='text-danger'>Enter all data</h3></div>";
            Form::createAdminForm();
            return false;
        }

        if (strlen($this->login) < 6 || strlen($this->login) > 32 || strlen($this->pass) < 6 || strlen($this->pass) > 128) {
            echo "<div class='container table mt-3'><h3 class='text-danger'>Incorrect fields length</h3></div>";
            Form::createAdminForm();
            return false;
        }

        $this->intoDb();

        return true;
    }

    // function for delete user from table
    static function deleteUser($id)
    {
        try {
            $pdo = Tools::connect();
            $ps = $pdo->prepare("DELETE FROM `users` WHERE id = :id");
            $ps->bindParam(':id', $id);
            $ps->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function drawDeleteUser()
    {

        echo '<div class="container table mt-4 mb-4 p-0">';
        echo '<h4>Delete user</h4>';
        echo '<form id="user_num" action="" method="post" enctype="multipart/form-data">';
        echo '<div class="form-group"><label for="user">
                    <select name="user_name" id="user_name">';
        echo '<option selected disabled>Select user</option>';
        $pdo = Tools::connect();
        $ps = $pdo->query("SELECT * FROM users");
        while ($row = $ps->fetch()) {
            echo "<option value='{$row["id"]}'>'{$row["login"]}' : '{$row["namefirst"]}' : '{$row["namelast"]}' : '{$row["email"]}'</option>";
        }
        echo '</select>';
        echo '</div>';
        echo '<input type="submit" name="del_user"  id="del_user" value="Удалить" value="Удалить" class="btn btn-sm btn-danger" disabled>';
        echo '</form>';
        echo '</div>';
        echo '<br>';
    }

    static function outInfoUsers($id)
    {
        try {
            $pdo = Tools::connect();
            $ps = $pdo->prepare("SELECT * FROM `users` WHERE id = :id");
            $ps->bindParam(':id', $id);
            $ps->execute();
            $one = $ps->fetch(PDO::FETCH_ASSOC);

            return $one;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function drawUpdateUser()
    {

        echo '<div class="">';
        echo '<h5>Select user</h5>';
        echo '<form id="user_update" action="" method="post" enctype="multipart/form-data">';
        echo '<div class="form-group"><label for="user">
                    <select name="user_name_update" id="user_name_update">';
        echo '<option selected disabled>Select user</option>';
        $pdo = Tools::connect();
        $ps = $pdo->query("SELECT * FROM users");
        while ($row = $ps->fetch()) {
            echo "<option value='{$row["id"]}'>'{$row["login"]}' : '{$row["namefirst"]}' : '{$row["namelast"]}' : '{$row["email"]}'</option>";
        }
        echo '</select>';
        echo '</div>';
        echo '<input type="submit" name="change_user" value="Select" class="btn btn-sm btn-info" disabled>';
        echo '</form>';
        echo '</div>';
        echo '<br>';
    }
}

// class Editing for edit users
class Editing
{

    public $login;
    public $namefirst;
    public $namelast;
    public $email;
    public  $age;
    public $gender;
    public  $imagepath;
    public $id;
    function __construct($login, $email, $namefirst, $namelast, $age, $gender, $imagepath, $id)
    {
        $this->login = trim($login);
        $this->email = trim($email);
        $this->namefirst = $namefirst;
        $this->namelast = $namelast;
        $this->age = $age;
        $this->gender = $gender;
        $this->imagepath = $imagepath;
        $this->id = $id;
    }

    // func updateToDb() is draw and edit rows in the DB
    function updateToDb($login, $namefirst, $namelast, $email, $age, $gender, $imagepath, $id)
    {

        if ($age != null && $gender !== null) {
            $pdo = Tools::connect();
            $sql = "UPDATE `users` SET `login`=:login, `namefirst`=:namefirst, `namelast`=:namelast, `email`=:email,`age`=:age,`gender`=:gender,`imagepath` =:imagepath WHERE `id`=:id ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':namefirst', $namefirst);
            $stmt->bindParam(':namelast', $namelast);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':imagepath', $imagepath);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        // conditions for changing the date of birth and gender fields correctly
        if ($age == null && $gender !== null) {
            $pdo = Tools::connect();
            $sql = "UPDATE `users` SET `login`=:login, `namefirst`=:namefirst, `namelast`=:namelast, `email`=:email,`gender`=:gender,`imagepath` =:imagepath WHERE `id`=:id ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':namefirst', $namefirst);
            $stmt->bindParam(':namelast', $namelast);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':imagepath', $imagepath);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        if ($age != null && $gender === null) {

            $pdo = Tools::connect();
            $sql = "UPDATE `users` SET `login`=:login, `namefirst`=:namefirst, `namelast`=:namelast, `email`=:email,`age`=:age,`imagepath` =:imagepath WHERE `id`=:id ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':namefirst', $namefirst);
            $stmt->bindParam(':namelast', $namelast);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':imagepath', $imagepath);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } else {

            $pdo = Tools::connect();
            $sql = "UPDATE `users` SET `login`=:login, `namefirst`=:namefirst, `namelast`=:namelast, `email`=:email,`imagepath` =:imagepath WHERE `id`=:id ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':namefirst', $namefirst);
            $stmt->bindParam(':namelast', $namelast);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':imagepath', $imagepath);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
    }
}
