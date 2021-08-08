<?php 

class Validation {

  
  public static function checkLogin($login) {
      (strlen($login)>=6 && strlen($login)<=25) ? true  : false ;
    }
  

  public static function checkPass($pass) {
      (strlen($pass)>=6 && ctype_digit($pass)) ?  true :  false;
    }
      
  public static function checkEmail($email) {
      (filter_var($email,FILTER_VALIDATE_EMAIL)) ?  true :  false;
    }
      
  public static function checkNonEmpty($name) {
    ($name) ? true : false;
  } 


  public static function checkName($name) {
    (strlen($name) < 128) ? true : false;
  } 

  public static function checkDate($date) {
    ($date < date('d.m.Y')) ? true : false;
  } 

  public static function checkConfirmPass($pass,$pass1) {
    ($pass === $pass1) ? true : false;
  } 

  public static function checkEmailExists($email) {

   
    $db = DB::instance()->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
    $db->bindParam(':email',$email, PDO::PARAM_STR);
    $db->execute();
    ($db->fetchColumn()) ? true : false;

  }

  public static function checkDataExists($data){

    $result = DB::run("SELECT COUNT(*) FROM `users` WHERE login = '" . $data . "'");
    $count = $result->fetchColumn();
    return $count;
  }
        // define variables and set to empty values


        public static function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
      
    }
    




    
?>