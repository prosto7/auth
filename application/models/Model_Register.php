<?php



class Model_Register extends Model
{

    public function check_user($login, $login)
    {
        $result = DB::run("SELECT * FROM `users` WHERE login = '" . $login . "' OR email_id = '" . $email . "'");
        $count = count($result);
        return $count;
    }
    public function insert_user($data)
    {
        $this->db->insert('register', $data);
    }
}
