<?php

class Rules
{

    static public function fillValidationErrors($data)
    {
      
        $errors = false;
        
        if (!Validation::checkLogin($data['login'])) {
            $errors[] = "Name is required and it must has min six symbols and max 25 symbols";
        }
        if (!Validation::checkDataExists($data['login'])) {
            $errors[] =  'This User Already Exists';
        }
        if (!Validation::checkPass($data['pass'])) {
            $errors[] = "Password is required, it must has min six symbols and contain letters and numbers";
        }
        if (!Validation::checkConfirmPass($data['pass'], $data['pass2'])) {
            $errors[] = "Passwords mismatch";
        }        
        if (!Validation::checkEmail($data['email'])) {
            $errors[] = "Email is required";
        }
        if (!Validation::checkEmailExists($data['email'])){
            $errors[] = "Email is already used";
        }
        if (!Validation::checkName($data['namefirst'])) {
            $errors[] = "Firstname is required";
        }
        if (!Validation::checkName($data['namelast'])) {
            $errors[] = "Lastname is required";
        }
        if (!Validation::checkDate($data['birthday'])) {
            $errors[] = "Date is uncorretly";
        }
        if (!Validation::checkNonEmpty($data['gender'])) {
            $errors[] = "Gender is required";
        }
            if ($errors == false) {
            
                
                $login = Validation::test_input($_POST["login"]);
                $pass = Validation::test_input($_POST["pass1"]);
                $email = Validation::test_input($_POST["email"]);
                $firstName = Validation::test_input($_POST["first_name"]);
                $lastName = Validation::test_input($_POST["last_name"]);
                $birthday = Validation::test_input($_POST["birthday"]);
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
       
             return [$errors,$data];
        
        }
  
}

