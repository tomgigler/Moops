<?php
   session_start();
   if (isset($_SESSION['USER']) || isset($_SESSION['PASS']))
   {
      $message = "    <font color='green'><b>You have been successfully logged out.</b></font>\n";
   }
   $_SESSION = array();
   if (isset($_COOKIE[session_name()]))
     setcookie(session_name(), '', time()-42000, '/');
   session_destroy();

   // used in header.inc
   $logging_out=1;
   include "header.inc";

   if(isset($message))
   {
      print $message;
      unset($message);
   }

   include "footer.inc";

   print " </body>\n";
   print "</html>";
   exit;
?>


