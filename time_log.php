<?php

require_once "Program.php";

   session_start();

   include "verify.inc";

   $title = "Time Recording Log";

   include "header.inc";

   print "   <script language='JavaScript' src='javascripts/time_log.js'></script>\n";

   $time = new Time();

   if(!isset($print_mode))
   {
      $all = $program->get_all_program_times();

      // Data Input Rows
      print "   <center>\n";
      print "   <table border=1>\n";
      print "      <tr>\n";
      print "         <td>\n";
      print "            <b>Date</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Start</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Stop</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Int. Time</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Phase</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Comments</b>\n";
      print "         </td>\n";
      print "      </tr>\n";

      $today = $time->get_current_date();
      $now = $time->get_current_time();
      $phases = $program->get_all_phases();

      print "      <tr>\n";
      print "         <td>\n";
      print "            <input id='input_date' size=8 value='".$today."' onkeypress='capture_keypress(event, create_row, 0, 0, 0, ".$program->get_id().")'/>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <input id='input_start_time' size=6 value='".$now."' onkeypress='capture_keypress(event, create_row, 0, 0, 0, ".$program->get_id().")'/>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <input id='input_stop_time' size=6 onkeypress='capture_keypress(event, create_row, 0, 0, 0, ".$program->get_id().")'/>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <input id='input_int_time' size=4 value='0' onkeypress='capture_keypress(event, create_row, 0, 0, 0, ".$program->get_id().")'/>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <select id='select_phase' onkeypress='capture_keypress(event, create_row, 0, 0, 0, ".$program->get_id().")'>\n";
      foreach($phases as $p)
         print "               <option value='".$p."'>".$p."</option>\n";
      print "            </select>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <input id='input_comments' size=50 onkeypress='capture_keypress(event, create_row, 0, 0, 0, ".$program->get_id().")'/>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <button id='button_submit' onClick='create_row(".$program->get_id().")'>\n";
      print "               Submit\n";
      print "            </button>\n";
      print "         </td>\n";
      print "      </table>\n";
      print "   </center>\n";
   }

   print "  <div id='div_time_log'";
   if(sizeof($all) == 0 && !isset($print_mode)) print " style='display:none'";
   print ">\n";
   if(!isset($print_mode))
      print "<br><br>\n";
   print "   <center>\n";
   print "   <table id='table_time_log' border=1>\n";

   // Table Header Row
   print "      <tr>\n";
   print "         <td>\n";
   print "            <b>Date</b>\n";
   print "         </td>\n";
   print "         <td>\n";
   print "            <b>Start</b>\n";
   print "         </td>\n";
   print "         <td>\n";
   print "            <b>Stop</b>\n";
   print "         </td>\n";
   print "         <td>\n";
   print "            <b>Int. Time</b>\n";
   print "         </td>\n";
   print "         <td>\n";
   print "            <b>Delta Time</b>\n";
   print "         </td>\n";
   print "         <td>\n";
   print "            <b>Phase</b>\n";
   print "         </td>\n";
   print "         <td>\n";
   print "            <b>Comments</b>\n";
   print "         </td>\n";
   print "      </tr>\n";

   // Data Display Rows
   for($x = 0 ; $x < sizeof($all) ; $x++)
   {
      print "      <tr id='time_id_".$all[$x]->get_id()."'>\n";
      print "         <td>\n";
      print "            ".$all[$x]->get_date()."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".$all[$x]->get_starttime()."\n";
      print "         </td>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".$all[$x]->get_stoptime()."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".$all[$x]->get_int_time()."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".round($all[$x]->get_delta_time())."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".ucwords($all[$x]->get_phase())."\n";
      print "         </td>\n";
      print "         <td>\n";
      if($all[$x]->get_comments())
         print "            ".$all[$x]->get_comments()."\n";
      else
         print "            &nbsp;\n";
      if(!isset($print_mode))
      {
         print "         <td>\n";
         print "            <button onClick='edit_row(".$program->get_id().",".$all[$x]->get_id().")'>\n";
         print "               Edit\n";
         print "            </button>\n";
         print "         </td>\n";
      }
      print "         </td>\n";
      if(!isset($print_mode))
      {
         print "         <td>\n";
         print "            <button onClick='delete_row(".$program->get_id().",".$all[$x]->get_id().")'>\n";
         print "               Delete\n";
         print "            </button>\n";
         print "         </td>\n";
      }
         print "      </tr>\n";
   }
   // in print mode display at least 20 rows
   if(isset($print_mode))
   {
      if(sizeof($all) < 20)
      {
         for($x = 0 ; $x < 20 - sizeof($all) ; $x++)
         {
            print "<tr>\n";
            for($y = 0 ; $y < 7 ; $y++) print "<td>&nbsp;</td>\n"; 
            print "</tr>\n";
         }
      }
   }
   print "   </table>\n";
   print "      <br><br>\n";
   print "         <div id='total'><b>Total:   ".$program->get_actual_time()."</b></div>";
   print "   </center>\n";
   print "   </div>\n";

   include "footer.inc";

?> 
