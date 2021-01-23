<?php

   require_once "Program.php"; 

   session_start();

   include "verify.inc";

   $title = "Task Planning Template";

   include "header.inc";

   print "   <script language='JavaScript' src='javascripts/task_plan_template.js'></script>\n";

   if(!isset($print_mode))
   {
      // Data Input Rows
      print "   <center>\n";
      print "   <table border=1>\n";
      print "      <tr>\n";
      print "         <td>\n";
      print "            <b>Name</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Date</b>\n";
      print "         </td>\n";
      print "      </tr>\n";

      print "      <tr>\n";
      print "         <td>\n";
      print "            <select id='select_name' onkeypress='capture_keypress(event, create_task, 0, 0, 0, ".$program->get_id().")'>\n";
      $phases = $program->get_all_phases();
      foreach($phases as $p)
         print "               <option value='".$p."'>".$p."</option>\n";
      print "            </select>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <input id='input_plan_date' onkeypress='capture_keypress(event, create_task, 0, 0, 0, ".$program->get_id().")'/>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <button id='button_submit' onClick='create_task(".$program->get_id().")'>\n";
      print "               Submit\n";
      print "            </button>\n";
      print "         </td>\n";
      print "      </table>\n";
      print "   </center>\n";

      $all = $program->get_all_tasks();
   }

   print "  <div id='div_task_plan_template'";
   if(sizeof($all) == 0 && !isset($print_mode)) print " style='display:none'";
   print ">\n";
   if(!isset($print_mode))
      print "<br><br>\n";
   print "   <center>\n";
   print "   <table id='table_task_plan' border=1>\n";

   // Table Header Row
   print "      <tr>\n";
   print "         <th colspan=2>\n";
   print "            Task\n";
   print "         </th>\n";
   print "         <th colspan=5>\n";
   print "            Plan\n";
   print "         </th>\n";
   print "         <th colspan=3>\n";
   print "            Actual\n";
   print "         </th>\n";
   print "      </tr>\n";
   print "      <tr>\n";
   print "         <th>\n";
   print "            &nbsp;#&nbsp;\n";
   print "         </th>\n";
   print "         <th>\n";
   print "            Name\n";
   print "         </th>\n";
   print "         <th>\n";
   print "            Minutes\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Planned Value\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Cumulative Minutes\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Cumulative Planned Value\n";
   print "         </th>\n";
   print "         <th>\n";
   print "            Date\n";
   print "         </th>\n";
   print "         <th>\n";
   print "            Date\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Earned Value\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Cumulative Earned Value\n";
   print "         </th>\n";
   print "      </tr>\n";

   // Data Display Rows
   $cumulative_ev= 0;
   for($x = 0 ; $x < sizeof($all) ; $x++)
   {
      print "      <tr id='tr_task_id_".$all[$x]->id."'>\n";
      print "         <td id='td_task_number_".$all[$x]->id."'>\n";
      print "            ".$all[$x]->number."\n";
      print "         </td>\n";
      print "         <td id='td_task_name_".$all[$x]->id."'>\n";
      print "            ".ucwords($all[$x]->name)."\n";
      print "         </td>\n";
      print "         <td id='td_task_minutes_".$all[$x]->id."'>\n";
      print "            ".round($all[$x]->minutes)."\n";
      print "         </td>\n";
      print "         <td id='td_task_planned_value_".$all[$x]->id."'>\n";
      print "            ".round($all[$x]->planned_value,1)."\n";
      print "         </td>\n";
      print "         <td id='td_task_cumulative_minutes_".$all[$x]->id."'>\n";
      print "            ".round($all[$x]->cumulative_minutes)."\n";
      print "         </td>\n";
      print "         <td id='td_task_cumulative_planned_value_".$all[$x]->id."'>\n";
      print "            ".round($all[$x]->cumulative_planned_value, 1)."\n";
      print "         </td>\n";
      print "         <td id='td_task_plan_date_".$all[$x]->id."'>\n";
      print "            ".$all[$x]->plan_date."\n";
      print "         </td>\n";
      print "         <td id='td_task_actual_date_".$all[$x]->id."'>\n";
      if($all[$x]->actual_date)
      {
         print "            ".$all[$x]->actual_date."\n";
         $cumulative_ev += $earned_value=$all[$x]->minutes/$program->get_plan_time()*100;
      }
      else
      {
         print "            &nbsp;\n";
         $earned_value=0;
      }
      print "         </td>\n";
      print "         <td id='td_task_earned_value_".$all[$x]->id."'>\n";
      print "            ".round($earned_value,1)."\n";
      print "         </td>\n";
      print "         <td id='td_task_cumulative_earned_value_".$all[$x]->id."'>\n";
      print "            ".round($cumulative_ev,1)."\n";
      print "         </td>\n";
      if(!isset($print_mode))
      {
         print "         <td>\n";
         print "            <button onClick='edit_task(".$program->get_id().",".$all[$x]->id.")'>\n";
         print "               Edit\n";
         print "            </button>\n";
         print "         </td>\n";
      }
      print "         </td>\n";
      if(!isset($print_mode))
      {
         print "         <td>\n";
         print "            <button onClick='delete_task(".$program->get_id().",".$all[$x]->id.")'>\n";
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
            for($y = 0 ; $y < 10 ; $y++) print "<td>&nbsp;</td>\n"; 
            print "</tr>\n";
         }
      }
   }
   print "      <tr>\n";
   print "         <th colspan=2>\n";
   print "            Totals\n";
   print "         </th>\n";
   print "         <td id='td_total_minutes'>\n";
   print "            ".round($all[sizeof($all) - 1]->cumulative_minutes)."\n";
   print "         </td>\n";
   print "         <td id='td_total_planned_value'>\n";
   print "            ".round($all[sizeof($all) - 1]->cumulative_planned_value, 1)."\n";
   print "         </td>\n";
   print "      </tr>\n";
   print "   </table>\n";
   print "   </center>\n";
   print "   </div>\n";

   include "footer.inc";

?> 
