<?php

class RegistrationController
{
     public function checkUser($email,$password){
          $check = new RegistrationData();
          $userid = $check->checkUser($email,$password);
          if($userid){
               $_SESSION['userid']=$userid;
               return $userid;
          }
                    return false;
     }

     public function registrationUser($email,$password){
          $reg = new RegistrationData();
          $reg->registrationUser($email,$password);
     }
}