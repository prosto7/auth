<?php

class Rules
{

    static public function fillValidationErrors($data)
    {

        $errors = null;
        switch (false) {
            case (Validation::checkLogin($data['login'])):
                $errors[] = "Name is required and it must has min six symbols and max 25 symbols";
    
            case (Validation::checkDataExists($data['login'])):
                $errors[] =  'This User Already Exists';
            case (Validation::checkPass($data['pass'])):
                $errors[] = "Password is required, it must has min six symbols and contain letters and numbers";

            case (Validation::checkConfirmPass($data['pass'], $data['pass2'])):
                $errors[] = "Confirm your password";

            case (Validation::checkEmail($data['email'])):
                $errors[] = "Email is required";
            case (Validation::checkEmailExists($data['email'])):
                $errors[] = "Email is required";
            case (Validation::checkName($data['namefirst'])):
                $errors[] = "Firstname is required";
            case (Validation::checkName($data['namelast'])):
                $errors[] = "Lastname is required";

            case (!Validation::checkDate($data['gender'])):
                $errors[] = "Date is uncorretly";
            case (!Validation::checkNonEmpty($data['gender'])):
                $errors[] = "Gender is required";
        }

        var_dump($errors);

        if ($errors == false) {

            $login = Validation::test_input($_POST["login"]);
            $pass = Validation::test_input($_POST["pass1"]);
            $email = Validation::test_input($_POST["email"]);
            $firstName = Validation::test_input($_POST["first_name"]);
            $lastName = Validation::test_input($_POST["last_name"]);
            $date = Validation::test_input($_POST["birthday"]);
            $gender = Validation::test_input($_POST["gender"]);
            $salt = Salt::generate_salt();
            $pass = crypt($pass, $salt);
            $data = array(
                ':login' => $login,
                ':email' => $email,
                ':pass' => $pass,
                ':namefirst' => $firstName,
                ':namelast' => $lastName,
                ':birthday' => $birthday,
                ':gender' => $gender,
                ':salt' => $salt
            );
        }
    }
}
