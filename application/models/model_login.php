<?php session_start();

class Model_Login extends Model
{

    public function get_data()
    {

        $login = $_POST['login'];
        $password = $_POST['password'];
        $sql = DB::run("SELECT salt,pass,roleid FROM `users` WHERE `login` = :login", array('login' => $login));
        $salt_row = $sql->fetch(PDO::FETCH_ASSOC);
        if ($salt_row != false) {
            $hashed_password = $salt_row['pass'];
            $salt_one = $salt_row['salt'];
            // select salt and pass from DB , for further verification users
            $ps = DB::instance()->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = :login");
            $ps->bindParam(':login', $login);
            $ps->execute();
            $row_count = $ps->fetchColumn();
            if ($row_count == 1 && hash_equals($hashed_password, crypt($password, $salt_one)))   // if table `users` has this login and hash password matches the entered password, user come in site
            {
                if ($salt_row['roleid'] === '1') {
                    // if roleid in the table 1 user is SuperAdministrator can see new section 'Admin Forms' and he can update, delete and add users in the DB
                    $_SESSION['superadmin'] =  $admin;
                } else {
                    $_SESSION['register'] = $login;  // SESSION[register] - simple user (roleid = 2, it's default setting) can see the table with data list
                }
                $result = [
                    "status" => true

                ];
            } else {

                $result = [
                    "status" => false,
                    "message" => "Password is invalid!"
                ];
            }
        } else {
            $result = [
                "status" => false,
                "message" => "User not found!"
            ];
        }

        echo json_encode($result);
    }
}
