<?php

require_once "../Program.php";
 
   session_start();

   if(isset($_SESSION['program']) && $_SESSION['program'] && $_SESSION['program']->get_id() == $_GET['prog']) $program =& $_SESSION['program'];
   else exit;

   $task = new Task();
   if(isset($_GET['taskid']))
   {
      $task= $task->get_task($_GET['taskid']);
      if($task->programid != $program->get_id()) exit;
   }

   print "<xml>\n";

   // validate date
   if(isset($_GET['plan_date']))
   {
      // require date format to be m/d or m-d or y/m/d or y-m-d
      $plan_date = $_GET['plan_date'];
      if(!preg_match("/^\s*[0-1]?[0-9][\/-][0-3]?[0-9]\s*$/", $plan_date) && !preg_match("/^\s*[0-9][0-9][0-9][0-9][\/-][0-1]?[0-9][\/-][0-3]?[0-9]\s*$/", $plan_date))
      {
         print "<alert>Invalid date!</alert>\n";
         if($_GET['op'] == "create")
            print "<highlight>input_plan_date</highlight><focus>input_plan_date</focus></xml>\n";
         else
            print "<highlight>input_edit_plan_date</highlight><focus>input_edit_plan_date</focus></xml>\n";
         exit;
      }
      // if date id m/d or m-d change it to 2007-m/d or 2007-m-d
      if(preg_match("/^\s*[0-1]?[0-9][\/-][0-3]?[0-9]\s*$/", $plan_date))
         $plan_date = "2007-".$plan_date;
   }

   if(isset($_GET['minutes']) && ( !preg_match("/^\s*[0-9][0-9]*\s*$/", $_GET['minutes'])))
   {
         print "<alert>Minutes must be an integer!</alert>\n";
         print "<highlight>input_edit_minutes</highlight><focus>input_edit_minutes</focus></xml>\n";
         exit;
   }

   // save all the previous values for all rows
   $all = $program->get_all_tasks();
   $cumulative_ev = 0;
   for($x = 0 ; $x < sizeof($all) ; $x++)
   {
      $all_old[$all[$x]->id]["number"] = $all[$x]->number;
      $all_old[$all[$x]->id]["name"] = $all[$x]->name;
      $all_old[$all[$x]->id]["minutes"] = $all[$x]->minutes;
      $all_old[$all[$x]->id]["planned_value"] = $all[$x]->planned_value;
      $all_old[$all[$x]->id]["cumulative_minutes"] = $all[$x]->cumulative_minutes;
      $all_old[$all[$x]->id]["cumulative_planned_value"] = $all[$x]->cumulative_planned_value;
      $all_old[$all[$x]->id]["plan_date"] = $all[$x]->plan_date;
      $all_old[$all[$x]->id]["actual_date"] = $all[$x]->actual_date;
      if($all[$x]->actual_date)
      {
         $all_old[$all[$x]->id]["earned_value"] = round($all[$x]->minutes/$program->get_plan_time()*100,1);
         $cumulative_ev += $all[$x]->minutes/$program->get_plan_time()*100;
      }
      else
         $all_old[$all[$x]->id]["earned_value"] = 0;
      $all_old[$all[$x]->id]["cumulative_earned_value"] = round($cumulative_ev,1);
   }
   $old_total_minutes = $all[sizeof($all) - 1]->cumulative_minutes;
   $old_total_planned_value = $all[sizeof($all) - 1]->cumulative_planned_value;

   // validate input
   if($_GET['op'] == "create" || $_GET['op'] == "update")
   {   
      if($_GET['op'] == "create")
         $minutes = $program->get_plan_time($_GET['name']) - $task->get_planned_time($program->get_id(), $_GET['name']);
      else
         $minutes = $program->get_plan_time($_GET['name']) - $task->get_planned_time($program->get_id(), $_GET['name'], $_GET['taskid']);
      if($minutes <= 0.001)
      {
         print "<alert>Already have enough time scheduled for ".ucwords($_GET['name'])."!</alert></xml>\n";
         exit;
      }
      if(($exist_id = $task->task_exists($program->get_id(), $_GET['name'], $plan_date)) && $exist_id != $_GET['taskid'])
      {
         print "<alert>Already have time scheduled for ".ucwords($_GET['name'])." on ".$plan_date;
         print "!</alert><highlight>tr_task_id_".$exist_id."</highlight><focus>input_plan_date</focus></xml>\n";
         exit;
      }
   }   

   // perform the operation
   switch ($_GET['op'])
   {
      case "delete":
         $program->delete_task($_GET['taskid']);
         break;
      case "create":
         $id = $program->create_task($_GET['name'], $minutes, $plan_date);
         print "   <id>".$id."</id>\n";
         break;
      case "update":
         $minutes = $_GET['minutes'];
         if($minutes > $program->get_plan_time($_GET['name']) - $task->get_planned_time($program->get_id(), $_GET['name'], $_GET['taskid'])
            || $program->get_plan_time($_GET['name']) - $task->get_planned_time($program->get_id(), $_GET['name'], $_GET['taskid']) - $minutes < 0.5
            || $minutes == 0)
            $minutes = $program->get_plan_time($_GET['name']) - $task->get_planned_time($program->get_id(), $_GET['name'], $_GET['taskid']);
         $program->update_task($_GET['taskid'], $_GET['name'], $minutes, $plan_date);
         $task = $task->get_task($_GET['taskid']);
         print "   <update_name>".ucwords($task->name)."</update_name>\n";
         print "   <update_minutes>".round($task->minutes)."</update_minutes>\n";
         print "   <update_plan_date>".$task->plan_date."</update_plan_date>\n";
         break;
     case "get_task":
         $id = $_GET['taskid'];
         break;
   }

   // compare the current values to the previous values
   $all = $program->get_all_tasks();
   $cumulative_ev = 0;
   for($x = 0 ; $x < sizeof($all) ; $x++)
   {
      $empty_str = "   <task id='".$all[$x]->id."'>\n   </task>\n";
      $str = "   <task id='".$all[$x]->id."'>\n";
      if($all_old[$all[$x]->id]["number"] != $all[$x]->number || $all[$x]->id == $id)
         $str .= "      <number>".$all[$x]->number."</number>\n";
      if($all_old[$all[$x]->id]["name"] != $all[$x]->name || $all[$x]->id == $id)
         $str .= "      <name>".ucwords($all[$x]->name)."</name>\n";
      if($all_old[$all[$x]->id]["minutes"] != $all[$x]->minutes || $all[$x]->id == $id)
         $str .= "      <minutes>".round($all[$x]->minutes)."</minutes>\n";
      if($all_old[$all[$x]->id]["planned_value"] != $all[$x]->planned_value || $all[$x]->id == $id)
         $str .= "      <planned_value>".round($all[$x]->minutes/$program->get_plan_time()*100,1)."</planned_value>\n";
      if($all_old[$all[$x]->id]["cumulative_minutes"] != $all[$x]->cumulative_minutes || $all[$x]->id == $id)
         $str .= "      <cumulative_minutes>".round($all[$x]->cumulative_minutes)."</cumulative_minutes>\n";
      if($all_old[$all[$x]->id]["cumulative_planned_value"] != $all[$x]->cumulative_planned_value || $all[$x]->id == $id)
         $str .= "      <cumulative_planned_value>".round($all[$x]->cumulative_planned_value,1)."</cumulative_planned_value>\n";
      if($all_old[$all[$x]->id]["plan_date"] != $all[$x]->plan_date || $all[$x]->id == $id)
         $str .= "      <plan_date>".$all[$x]->plan_date."</plan_date>\n";
      if($all_old[$all[$x]->id]["actual_date"] != $all[$x]->actual_date || $all[$x]->id == $id)
         $str .= "      <actual_date>".$all[$x]->actual_date."</actual_date>\n";

      if($all[$x]->actual_date)
      {
            $ev = round($all[$x]->minutes/$program->get_plan_time()*100,1);
            $cumulative_ev += $all[$x]->minutes/$program->get_plan_time()*100;
      }
      else $ev = 0;

      if($all_old[$all[$x]->id]["earned_value"] != $ev || $all[$x]->id == $id)
         $str .= "      <earned_value>".$ev."</earned_value>\n";
      if($all_old[$all[$x]->id]["cumulative_earned_value"] != round($cumulative_ev,1) || $all[$x]->id == $id)
         $str .= "      <cumulative_earned_value>".round($cumulative_ev,1)."</cumulative_earned_value>\n";
      $str .= "   </task>\n";
      if($str != $empty_str) print $str;
   }

   if(sizeof($all) != 0)
   {
      if($old_total_minutes != $all[sizeof($all) - 1]->cumulative_minutes)
         print "   <total_minutes>".round($all[sizeof($all) - 1]->cumulative_minutes)."</total_minutes>\n";
      if($old_total_planned_value != $all[sizeof($all) - 1]->cumulative_planned_value)
         print "   <total_planned_value>".round($all[sizeof($all) - 1]->cumulative_planned_value,1)."</total_planned_value>\n";
   }

   print "</xml>\n";

?>
