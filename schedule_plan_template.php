<?php

   require_once "Program.php";

   session_start();

   include "verify.inc";

   $title = "Schedule Planning Template";

   include "header.inc";

   $task = new Task();
   if($program)
      $all = $program->get_all_schedule_tasks();
   print "  <div id='div_schedule_plan_template'";
   if(sizeof($all) == 0 && !isset($print_mode)) print " style='display:none'";
   print ">\n";
   print "<br><br>\n";
   print "   <center>\n";
   print "   <table id='table_task_plan' border=1>\n";

   // Table Header Row
   print "      <tr>\n";
   print "         <th colspan=2>\n";
   print "         </th>\n";
   print "         <th colspan=3>\n";
   print "            Plan\n";
   print "         </th>\n";
   print "         <th colspan=3>\n";
   print "            Actual\n";
   print "         </th>\n";
   print "      </tr>\n";
   print "      <tr>\n";
   print "         <th>\n";
   print "            No.\n";
   print "         </th>\n";
   print "         <th>\n";
   print "            Date\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Direct Minutes\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Cumulative Minutes\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Cumulative Planned Value\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Direct Minutes\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Cumulative Minutes\n";
   print "         </th>\n";
   print "         <th width=20>\n";
   print "            Cumulative Earned Value\n";
   print "         </th>\n";
   print "      </tr>\n";

   // Data Display Rows
   for($x = 0 ; $x < sizeof($all) ; $x++)
   {
      print "      <tr>\n";
      print "         <td>\n";
      print "            ".$all[$x]->number."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".$all[$x]->plan_date."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".round($all[$x]->minutes)."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".round($all[$x]->cumulative_minutes)."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".round($all[$x]->cumulative_planned_value, 1)."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".round($all[$x]->actual_minutes)."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".$all[$x]->cumulative_actual_minutes."\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            ".round($all[$x]->cumulative_earned_value,1)."\n";
      print "         </td>\n";
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
            for($y = 0 ; $y < 8 ; $y++) print "<td>&nbsp;</td>\n"; 
            print "</tr>\n";
         }
      }
   }
   print "   </table>\n";
   print "   </center>\n";
   print "   </div>\n";

   include "footer.inc";

?> 
