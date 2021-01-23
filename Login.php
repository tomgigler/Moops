<?php

class Login {

   var $db;

   function Login(){

   }//Login

   function verify($user, $pass){
      $this->db = new DBConnection();
      $this->db->connect() or die('There was an error connecting to the database.');
      $result = $this->db->set_query("select * from user where username='".$user."' and password=PASSWORD('".$pass."')") or die('There was an error connecting to the database.');
      $ret = $this->db->num_rows($result);
      $this->db->close();
      return $ret;

   }//verify

}//Login

?>
