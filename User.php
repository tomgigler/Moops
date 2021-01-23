<?php

require_once "DBConnection.php";

class User {
   var $username;

   function exists($user)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT username FROM user WHERE username = '".$user."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $row[0];
   }

   function create($user)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("insert into user values ('".$user."',password('changeme'))");
      $db->close();
   }

   function reset_password($user)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE user SET password=PASSWORD('changeme') WHERE username='".$user."'");
      $db->close();
   }

   function change_password($user, $password)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE user SET password=PASSWORD('".$password."') WHERE username='".$_SESSION['USER']."'");
      $db->close();
   }

   function delete($user)
   {
/* TO DO:  Delete other user info from DB!!! */
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("DELETE FROM user WHERE username = '".$user."'");
      $db->close();
   }

   function get_all_users()
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT username FROM user");
      $row = $db->fetch_row($result);
      while($row)
      {
         $u = new User();
         $u->username = $row[0];
         $list[] = $u;
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }
}//User
?>
