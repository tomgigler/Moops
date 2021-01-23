<?php

require_once "../Program.php";
require_once "../Level.php";
require_once "../Time.php";
 
   session_start();

   if(isset($_SESSION['program']) && $_SESSION['program']) $program =& $_SESSION['program'];
   else exit;
   $time = new Time();
   if(isset($_GET['timeid']))
   {
      $time= $time->get_time($_GET['timeid']);
      if($time->get_program_id() != $program->get_id()) exit;
   }

   print "<xml>\n";

   // validate date
   if(isset($_GET['date']))
   {
      // require date format to be m/d or m-d or y/m/d or y-m-d
      $date = $_GET['date'];
      if(!preg_match("/^\s*[0-1]?[0-9][\/-][0-3]?[0-9]\s*$/", $date) && !preg_match("/^\s*[0-9][0-9][0-9][0-9][\/-][0-1]?[0-9][\/-][0-3]?[0-9]\s*$/", $date))
      {
         if($_GET['op'] == "create")
            print "<alert>Invalid date!</alert><focus>input_date</focus></xml>\n";
         else
            print "<alert>Invalid date!</alert><focus>input_edit_date</focus></xml>\n";
         exit;
      }
      // if date id m/d or m-d change it to 2007-m/d or 2007-m-d
      if(preg_match("/^\s*[0-1]?[0-9][\/-][0-3]?[0-9]\s*$/", $date))
         $date = "2007-".$date;
   }

   // change times like 234 to 2:34
   if(isset($_GET['start_time']))
   {
      $start_time = $_GET['start_time'];
      if(preg_match("/^\s*[0-2]?[0-9][0-5][0-9]\s*$/", $start_time))
      {
         $ar = preg_split("/(\s*[0-2]?[0-9])([0-5][0-9])/", $start_time, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
         $start_time = "$ar[0]:$ar[1]";
      }
   }

   if(isset($_GET['stop_time']))
   {
      $stop_time = $_GET['stop_time'];
      if(preg_match("/^\s*[0-2]?[0-9][0-5][0-9]\s*$/", $stop_time))
      {
         $ar = preg_split("/(\s*[0-2]?[0-9])([0-5][0-9])/", $stop_time, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
         $stop_time = "$ar[0]:$ar[1]";
      }
   }

   if($_GET['op'] == "create" || $_GET['op'] == "update")
   {
      if(!preg_match("/^\s*[0-2]?[0-9]:[0-5][0-9]\s*$/", $start_time))
      {
         if($_GET['op'] == "create")
            print "<alert>Invalid start time!</alert><focus>input_start_time</focus></xml>\n";
         else
            print "<alert>Invalid start time!</alert><focus>input_edit_start_time</focus></xml>\n";
         exit;
      }
      if(!preg_match("/^\s*[0-2]?[0-9]:[0-5][0-9]\s*$/", $stop_time))
      {
         if($_GET['op'] == "create")
            print "<alert>Invalid stop time!</alert><focus>input_stop_time</focus></xml>\n";
         else
            print "<alert>Invalid stop time!</alert><focus>input_edit_stop_time</focus></xml>\n";
         exit;
      }
   }


   switch ($_GET['op'])
   {
      case "delete":
         $program->delete_time_row($_GET['timeid']);
         break;
      case "create":
         $id = $program->create_time_row($date, $start_time, $stop_time, 
                          $_GET['int_time'], $_GET['phase'], $_GET['comments']);
         $time = $time->get_time($id);
         print "   <old_date></old_date>\n";
         print "   <old_starttime></old_starttime>\n";
         print "   <old_stoptime></old_stoptime>\n";
         print "   <old_int_time></old_int_time>\n";
         print "   <old_phase></old_phase>\n";
         print "   <old_comments>some meaningless value that doesnt exist</old_comments>\n";
         print "   <old_delta></old_delta>\n";
         $all = $program->get_all_program_times();
         break;
      case "update":
         $time = $time->get_time($_GET['timeid']);
         print "   <old_date>".$time->get_date()."</old_date>\n";
         print "   <old_starttime>".$time->get_starttime()."</old_starttime>\n";
         print "   <old_stoptime>".$time->get_stoptime()."</old_stoptime>\n";
         print "   <old_int_time>".$time->get_int_time()."</old_int_time>\n";
         print "   <old_phase>".ucwords($time->get_phase())."</old_phase>\n";
         print "   <old_comments>".$time->get_comments()."</old_comments>\n";
         print "   <old_delta>".round($time->get_delta_time())."</old_delta>\n";
         print "   <old_total>".round($time->get_actual_time($_GET['prog']))."</old_total>\n"; 
         $program->update_time_row($_GET['timeid'], $date, $start_time, $stop_time, 
                          $_GET['int_time'], $_GET['phase'], $_GET['comments']);
         $time = $time->get_time($_GET['timeid']);
         $all = $program->get_all_program_times();
         break;
     case "get_row":
         $time=$time->get_time($_GET['timeid']);
         break;
   }
   print "   <id>".$time->get_id()."</id>\n";
   print "   <date>".$time->get_date()."</date>\n";
   print "   <starttime>".$time->get_starttime()."</starttime>\n";
   print "   <stoptime>".$time->get_stoptime()."</stoptime>\n";
   print "   <int_time>".$time->get_int_time()."</int_time>\n";
   print "   <phase>".ucwords($time->get_phase())."</phase>\n";
   print "   <comments>".$time->get_comments()."</comments>\n";
   print "   <delta>".round($time->get_delta_time())."</delta>\n";
   print "   <total>".$time->get_actual_time($_GET['prog'])."</total>\n"; 

   // if we did a create or update return the new index of the row
   if(isset($all))
   {
      print "   <index>\n";
      for($x = 0 ; $x < sizeof($all) ; $x++)
         if($all[$x]->get_id() == $time->get_id())
            print "         ".++$x."\n";
      print "   </index>\n";
   }
   print "</xml>\n";

?>
