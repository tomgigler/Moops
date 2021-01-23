<?php

   require_once "User.php";

   session_start();
   $host = $_SERVER['HTTP_HOST'];
   $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
   if (!isset($_SESSION['USER']) || $_SESSION['USER'] != "admin") 
   {
      header("Location: http://$host$uri/index.php");
      exit;
   }

   print "<html>\n";
   print "   <head>\n";
   print "      <link rel=stylesheet type=text/css href=\"style.css\"/>\n";
   print "   <script language='JavaScript' src='javascripts/ajax.js'></script>\n";
   print "   <script language='JavaScript' src='javascripts/admin.js'></script>\n";
   print "      <title>Moops</title>\n";
   print "   </head>\n";
   print "   <body>\n";

   include "header.inc";

   print "      <center>\n";
   print "         <h2>Create Users</h2>\n";
   print "            <table border=1>\n";
   print "               <tr>\n";
   print "                  <td>\n";
   print "                     <b>Username:</b>\n";
   print "                  </td>\n";
   print "               </tr>\n";
   print "               <tr>\n";
   print "                  <td>\n";
   print "                     <input id='input_username' type='text'/>\n";
   print "                  </td>\n";
   print "                  <td>\n";
   print "                     <button onClick='create_user()'>\n";
   print "                        Create User\n";
   print "                     </button>\n";
   print "                  </td>\n";
   print "               </tr>\n";
   print "            </table>\n";
   print "      </center>\n";

   print "      <center>\n";
   print "         <h2>Users</h2>\n";

   $user = new User();
   $all = $user->get_all_users();

   print "         <table id='user_table' border=1>\n";
   for($x = 0 ; $x < sizeof($all) ; $x++)
   {
      if($all[$x]->username != 'admin')
      {
         print "         <tr id='user_".$all[$x]->username."'>\n";
         print "            <td width=40%>\n";
         print "               ".$all[$x]->username."\n";
         print "            </td>\n";
         print "            <td>\n";
         print "               <button onClick='reset_pass(\"".$all[$x]->username."\")'>\n";
         print "                  Reset Password\n";
         print "               </button>\n";
         print "            </td>\n";
         print "            <td>\n";
         print "               <button onClick='delete_user(\"".$all[$x]->username."\")'>\n";
         print "                  Delete\n";
         print "               </button>\n";
         print "            </td>\n";
         print "         </tr>\n";
      }
   }

   print "         </table>\n";
   print "      </center>\n";

   include "footer.inc";

   print "   </body>\n";
   print "</html>";

?> 
