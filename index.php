<?php
require_once "DBConnection.php";
require_once "Login.php";

   session_start();
   
   if (isset($_POST['USER']) && isset($_POST['PASS']))
   {
      $log = new Login();
      if($log->verify($_POST['USER'], $_POST['PASS']))
      {
         $_SESSION['USER'] = $_POST['USER'];
      } 
      else
      {
         $message = "<br><br><font color='red'><b>--Incorrect username or password--</b></font><br>\n";
      }
   }
   
   if (!isset($_SESSION['USER'])) 
   {
      print "<html>\n";
      print "   <head>\n";
      print "      <link rel=stylesheet type=text/css href=\"style.css\"/>\n";
      print "      <title>Moops</title>\n";
      print "   </head>\n";
      print "   <body>\n";

      include "header.inc";

      if (isset($message))
      {
         print $message;
         unset($message);
      }

      print "      <form name='form' method='POST' enctype='multipart/form-data' autocomplete='off'>\n";
      print "         <pre>\n";
      print "   <b>Username:</b>   <input type='text' name='USER'/><br>\n";
      print "   <b>Password:</b>   <input type='password' name='PASS'/><br>\n";
      print "   <input type='submit' value='Login'/>\n";
      print "         </pre>\n";
      print "      </form>\n";
      include "footer.inc";
      print "   </body>\n";
      print "</html>";   
   } 
   else
   {
      $host = $_SERVER['HTTP_HOST'];
      $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      header("Location: http://$host$uri/home.php");
      exit;
   }
?> 
