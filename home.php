<?php

require_once "Program.php";
require_once "Level.php";
 
   session_start();
   $host = $_SERVER['HTTP_HOST'];
   $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
   if (!isset($_SESSION['USER'])) 
   {
      header("Location: http://$host$uri/index.php");
      exit;
   }
   if (strtoupper($_SESSION['USER']) == "ADMIN")
   {
      header("Location: http://$host$uri/admin.php");
      exit;
   }

   include "header.inc";

   print "   <script language='JavaScript' src='javascripts/home.js'></script>\n";

   print "      <center>\n";
   print "         <h2>Create Program</h2>\n";
   print "            <table border=1>\n";
   print "               <tr>\n";
   print "                  <td>\n";
   print "                     <b>Program Name:</b>\n";
   print "                  </td>\n";
   print "                  <td>\n";
   print "                     <input type='text' id='input_program_name' onkeypress='capture_keypress(event, create_program, 0, 0, 0, \"".$_SESSION['USER']."\")'/>\n";
   print "                  </td>\n";
   print "               </tr>\n";
   print "               <tr>\n";
   print "                  <td>\n";
   print "                     <b>PSP Level:</b>\n";
   print "                  </td>\n";
   print "                  <td>\n";
   print "                     <select id='select_psp_level' onkeypress='capture_keypress(event, create_program, 0, 0, 0, \"".$_SESSION['USER']."\")'>\n";
   $level = new Level();
   $levels = $level->get_levels();
   for($x = 0 ; $x < sizeof($levels) ; $x++)
   {
      print "                        <option value='".$x."'>".$levels[$x]."</option>\n";
   }
   print "                     </select>\n";
   print "                  </td>\n";
   print "               </tr>\n";
   print "               <tr>\n";
   print "                  <td>\n";
   print "                  </td>\n";
   print "                  <td>\n";
   print "                     <button id='button_create_program' onClick='create_program(\"".$_SESSION['USER']."\")'>\n";
   print "                        Create Program\n";
   print "                     </button>\n"; 
   print "                  </td>\n";
   print "               </tr>\n";
   print "            </table>\n";
   print "      </center>\n";

   $program = new Program();

   $all = $program->get_all_user_programs($_SESSION['USER']);
   print "  <div id='div_programs'";
   if(sizeof($all) == 0 && !isset($print_mode)) print " style='display:none'";
   print ">\n";
      print "      <center>\n";
      print "         <h2>My Programs</h2>\n";
      print "      <table id='table_programs' border=1>\n";
      print "         <tr>\n";
      print "            <td>\n";
      print "               Name\n";
      print "            </td>\n";
      print "            <td>\n";
      print "               Number\n";
      print "            </td>\n";
      print "            <td>\n";
      print "               Level\n";
      print "            </td>\n";
      print "         </tr>\n";
   for($x = 0 ; $x < sizeof($all) ; $x++)
   {
      print "<tr id='tr_program_".$all[$x]->get_id()."'>\n";
      print "   <td>\n";
      print "      <a href=summary.php?prog=".$all[$x]->get_id().">".$all[$x]->get_name()."</a>\n";
      print "   </td>\n";
      print "   <td align=center>\n";
      print $all[$x]->get_number()."\n";
      print "   </td>\n";
      print "   <td align=center>\n";
      print $level->get_level_name($all[$x]->get_level())."\n";
      print "   </td>\n";
      print "   <td>\n";
      print "      <button onClick='delete_program(".$all[$x]->get_id().",\"".$all[$x]->get_name()."\")'>\n";
      print "         Delete\n";
      print "      </button>\n"; 
      print "   </td>\n";
      print "</tr>\n";
   }
   print "      </table>\n";
   print "      </center>\n";
   print "   </div>\n";

   include "footer.inc";

   print "</body>\n";
   print "</html>";

?> 
