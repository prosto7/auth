<?php 

class Validation {

  
  public static function checkForNumber($str) {
    $i = strlen($str); 
    while ($i--) {
      if (is_numeric($str[$i])) return true;
    }
    return false;
  }


  public static function checkLogin($login) {
     if (strlen($login)>=6 && strlen($login)<=25 ) 
    {
     return true; 
    } 
      return false;
      
    }
  

  public static function checkPass($pass) {
    if (strlen($pass)>=6 &&  self::checkForNumber($pass)) 
    {
     
    return true; 
    } 
    return false;
    }
      
  public static function checkEmail($email) {

    if  (filter_var($email,FILTER_VALIDATE_EMAIL))
    {
      return true; 
      } 
      return false;
      }
      
  public static function checkNonEmpty($name) {
    if ($name) 
    {
      return true; 
      } 
      return false;
      }


  public static function checkName($name) {
    if ($name) 
    {
      return true; 
      } 
     
      return false;
      
      }

  public static function checkDate($date) {
    echo $date;
    $newd = date('Y-m-d');
    
    if  ($date < date('Y-m-d')) 
    {
      return true; 
      } 
     
      return false;
      
      }

  public static function checkConfirmPass($pass,$pass1) {
    if ($pass === $pass1) 
    {
      return true; 
      } 
     
      return false;
      
      }

  public static function checkEmailExists($email) {

   
    $db = DB::instance()->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
    $db->bindParam(':email',$email, PDO::PARAM_STR);
    $db->execute();
    if ($db->fetchColumn() == 0) : return true;
    else : return false;
    endif;
      }
      

  public static function checkDataExists($data){

    $result = DB::run("SELECT COUNT(*) FROM `users` WHERE login = '" . $data . "'");
    $count = $result->fetchColumn();
    if ($count == 0) : return true;
    else : return false;
    endif;
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