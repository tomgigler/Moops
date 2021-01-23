<?php

   require_once "../User.php";

   session_start();
   if (!isset($_SESSION['USER']) || $_SESSION['USER'] != "admin") exit;

   $user = new User();

   switch($_GET['op'])
   {
      case "create_user":
         if($user->exists($_GET['username']))
            print "<xml><result>0</result><message color='red'>--User ".$_GET['username']." already exists--</message></xml>";
         else
         {
            $user->create($_GET['username']);
            print "<xml><result>1</result><message color='green'>--Added user ".$_GET['username']."--</message></xml>";
         }
         break;

      case "delete_user":
         $user->delete($_GET['username']);
         print "<xml><result>1</result><message color='green'>--Deleted user ".$_GET['username']."--</message></xml>";
         break;

      case "reset_pass":
         $user->reset_password($_GET['username']);
         print "<xml><result>1</result><message color='green'>--Reset password for user  ".$_GET['username']."--</message></xml>";
         break;
   }

?> 
