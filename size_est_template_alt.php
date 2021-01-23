<?php

require_once "Program.php";
require_once "Level.php";
require_once "Time.php";
 
   session_start();
   $host = $_SERVER['HTTP_HOST'];
   $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
   if (!isset($_SESSION['USER'])) 
   {
      header("Location: http://$host$uri/index.php");
      exit;
   }

   if (!isset($_GET['prog'])) 
   {
      header("Location: http://$host$uri/home.php");
      exit;
   }

   $level = new Level();
   $program = new Program();
   $program = $program->get_program($_GET['prog']);
   if($program->get_username() != $_SESSION['USER'])
   {
      header("Location: http://$host$uri/home.php");
      exit;
   }

   print "<html>\n";
   print "<head>\n";
   print "   <link rel=stylesheet type=text/css href=\"style.css\"/>\n";
   print "   <title>Moops - " . $program->get_name() . "</title>\n";
   print "</head>\n";
   print "<body>\n";

   if(!isset($_GET['print']))
   {
      include "header.inc";
   }

   print "   <center>\n";
   print "      <h2>" . $program->get_name() . " - Size Estimating Template</h2>\n";
   print "      <h3>PSP Level: " . $level->get_level_name($program->get_level()) . "</h3>\n";
   print "   </center>\n";

   print "   <center>\n";
   print "      <table class=table_size_est_temp width=80%>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b>BASE PROGRAM</b>\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp; BASE SIZE (B)\n";
   print "            </td>\n";
   print "            <td COLSPAN=7>\n";
   print "               => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp;\n";
   print "            </td>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp; LOC DELETED (D)\n";
   print "            </td>\n";
   print "            <td COLSPAN=7>\n";
   print "               => &nbsp;=> &nbsp;  => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp;\n";
   print "            </td>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp; LOC MODIFIED (M)\n";
   print "            </td>\n";
   print "            <td COLSPAN=7>\n";
   print "               => &nbsp;=> &nbsp;  => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; =>\n";
   print "            </td>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               $nbsp\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b>PROJECTED LOC (P)</b>\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td class=td_centered>\n";
   print "               BASE ADDITIONS\n";
   print "            </td>\n";
   print "            <td>&nbsp;</td>\n";
   print "            <td class=td_centered>\n";
   print "               TYPE\n";
   print "            </td>\n";
   print "            <td>&nbsp;</td>\n";
   print "            <td class=td_centered>\n";
   print "               METHODS\n";
   print "            </td>\n";
   print "            <td>&nbsp;</td>\n";
   print "            <td class=td_centered>\n";
   print "               RELATIVE SIZE\n";
   print "            </td>\n";
   print "            <td>&nbsp;</td>\n";
   print "            <td class=td_centered>\n";
   print "               LOC\n";
   print "            </td>\n";
   print "            <td>&nbsp;</td>\n";
   print "         </tr>\n";
   for($x = 0 ; $x < 4 ; $x++)
   {
   print "         <tr>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   }
   print "         <tr>\n";
   print "            <td class=td_centered COLSPAN=3>\n";
   print "               &nbsp;&nbsp; TOTAL BASE ADDITIONS (BA)\n";
   print "            </td>\n";
   print "            <td class=td_centered COLSPAN=5>\n";
   print "               => &nbsp;=> &nbsp;  => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; =>\n";
   print "            </td>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td COLSPAN=8/>\n";
   print "            <td class=td_centered>\n";
   print "               LOC\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td class=td_centered>\n";
   print "               NEW OBJECTS (NO)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_centered>\n";
   print "               TYPE<sup>1</sup>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_centered>\n";
   print "               METHODS\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_centered>\n";
   print "               RELATIVE SIZE\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_centered>\n";
   print "               (New Reused*)\n";
   print "            </td>\n";
   print "         </tr>\n";

   for($x = 0 ; $x < 6 ; $x++)
   {
   print "         <tr>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   }

   print "         <tr>\n";
   print "            <td class=td_centered COLSPAN=3>\n";
   print "               &nbsp;&nbsp; TOTAL NEW OJBECTS (NO)\n";
   print "            </td>\n";
   print "            <td class=td_centered COLSPAN=5>\n";
   print "               => &nbsp;=> &nbsp;=> &nbsp;   => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; =>\n";
   print "            </td>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td COLSPAN=8/>\n";
   print "            <td class=td_centered>\n";
   print "               LOC\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b>REUSED OBJECTS</b>\n";
   print "            </td>\n";
   print "         </tr>\n";

   for($x = 0 ; $x < 4 ; $x++)
   {
   print "         <tr>\n";
   print "            <td class=td_underscore COLSPAN=7>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   }

   print "         <tr>\n";
   print "            <td class=td_centered COLSPAN=3>\n";
   print "               &nbsp;&nbsp; REUSED TOTAL (R)\n";
   print "            </td>\n";
   print "            <td class=td_centered COLSPAN=5>\n";
   print "               => &nbsp; => &nbsp; => &nbsp; => &nbsp; => &nbsp; =>\n";
   print "            </td>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <tr>&nbsp;</tr>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Projected LOC (P):\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "               P=BA+NO\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Regression Parameter:\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "               &#946<sub>0</sub>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Regression Parameter:\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "               &#946<sub>1</sub>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Estimated New and Changed LOC (N):\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "               N=&#946<sub>0</sub>+&#946<sub>1</sub>*(P+M)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Estimated Total LOC (T):\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "               T=N+B-D-M+R\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Estimated Total New Reused (sum of * LOC):\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Prediction Range:\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "               Range\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Upper Prediction Interval:\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "               UPI=N+Range\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Lower Prediction Interval:\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "               LPI=N-Range\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=3>\n";
   print "               &nbsp; Prediction Interval Percent:\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td COLSPAN=3>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td COLSPAN=9>\n";
   print "               <sup>1</sup>L=Logic, I=I/O, C=Calculation, T=Text, D=Data, S=Set-up\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "      </table>\n";
   print "   </center>\n";

   if(!isset($_GET['print']))
   {
      include "footer.inc";
   }
   print "</body>\n";
   print "</html>";

?> 
