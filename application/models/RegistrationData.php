<?php

class RegistrationData extends Data
{
     public $db;

     function checkUser($email,$password){

      $res = $this->db->prepare("SELECT `id`, `email`, `password` FROM `users` WHERE `email` = :email
      and `password` = :password");

          $res->execute(array('email' => $email,'password'=>$password));
          $rezult = $res->fetchAll(PDO::FETCH_ASSOC);

          return $rezult[0]['id'];
     }
     function registrationUser($email,$password){

          $res = $this->db->prepare("INSERT INTO `users`(`email`, `password`) 
        VALUES (?,?)");
          $res->execute(array($email,$password));
     }
     function loginUser($id){

     }
     function logoutUser(){

     }
}