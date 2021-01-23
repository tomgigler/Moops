<?php

require_once "User.php";
require_once "Login.php";

   session_start();
   $host = $_SERVER['HTTP_HOST'];
   $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
   if (!isset($_SESSION['USER'])) 
   {
      header("Location: http://$host$uri/index.php");
      exit;
   }

   if(isset($_POST['CURRENT_PASS']))
   {
      $log = new Login();
      if(!$log->verify($_SESSION['USER'], $_POST['CURRENT_PASS']))
      {
         $_SESSION['message'] = "<br><br><font color='red'><b>--Incorrect password--</b></font><br>\n";
      }
      else if($_POST['NEW_PASS'] != $_POST['CONFIRM_PASS'])
      {
         $_SESSION['message'] = "<br><br><font color='red'><b>--Passwords do not match--</b></font><br>\n";
      }
      else
      {
         $user = new User();
         $user->change_password($_SESSION['USER'], $_POST['NEW_PASS']);
         $_SESSION['message'] = "<br><br><font color='green'><b>Changed password for user ".$_SESSION['USER']."</b></font><br>\n";
      }
   }


   print "<html>\n";
   print "<head>\n";
   print "   <link rel=stylesheet type=text/css href=\"style.css\"/>\n";
   print "   <title>Moops</title>\n";
   print "</head>\n";
   print "<body>\n";

   include "header.inc";

   print "      <center>\n";
   print "      <h2>Change Password</h2>\n";
   print "      <form name='form' method='POST' enctype='multipart/form-data'>\n";
   print "      <table border=1>\n";
   print "      <tr>\n";
   print "      <td align=right>\n";
   print "      <b>Current Password:</b>\n";
   print "      </td>\n";
   print "      <td>\n";
   print "      <input type='password' name='CURRENT_PASS'/>\n";
   print "      </td>\n";
   print "      </tr>\n";
   print "      <tr>\n";
   print "      <td align=right>\n";
   print "      <b>New Password:</b>\n";
   print "      </td>\n";
   print "      <td>\n";
   print "      <input type='password' name='NEW_PASS'/>\n";
   print "      </td>\n";
   print "      </tr>\n";
   print "      <tr>\n";
   print "      <td align=right>\n";
   print "      <b>Confirm Password:</b>\n";
   print "      </td>\n";
   print "      <td>\n";
   print "      <input type='password' name='CONFIRM_PASS'/>\n";
   print "      </td>\n";
   print "      </tr>\n";
   print "      <tr>\n";
   print "      <td>\n";
   print "      </td>\n";
   print "      <td>\n";
   print "      <input type='submit' value='Change Password'/>\n";
   print "      </td>\n";
   print "      </tr>\n";
   print "      </table>\n";
   print "      </form>\n";
   print "      </center>\n";

   include "footer.inc";

   print "</body>\n";
   print "</html>";

?> 
