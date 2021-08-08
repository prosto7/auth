<?php 
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

?>