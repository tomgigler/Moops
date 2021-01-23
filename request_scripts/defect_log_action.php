<?php

require_once "../Program.php";
require_once "../Level.php";
require_once "../Defect.php";
 
   session_start();
   if(!isset($_SESSION['USER']) || !isset($_GET['prog'])) exit;
   $program = new Program();
   $program = $program->get_program($_GET['prog']);
   if($program->get_username() != $_SESSION['USER']) exit;

   $defect = new Defect();

   if(isset($_GET['defectid']))
   {
      $defect = $defect->get_defect($_GET['defectid']);
      if($defect->program_id != $program->get_id()) exit;
   }

   print "<xml>";

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

   switch($_GET['op'])
   {
      case "create":
         $id = $program->create_defect_row($_GET['date'], $_GET['defect_type'], $_GET['inject_phase'], 
                          $_GET['remove_phase'], $_GET['fix_time'], $_GET['fix_ref'], $_GET['description']);
         $defect = $defect->get_defect($id);
         print "<fixref>".$defect->fixref."</fixref>";
         break;

      case "update":
         $old_defect = $defect->get_defect($_GET['defectid']);
         $program->update_defect_row($_GET['defectid'], $_GET['date'], $_GET['defect_type'], $_GET['inject_phase'], 
                          $_GET['remove_phase'], $_GET['fix_time'], $_GET['fix_ref'], $_GET['description']);
         $defect = $defect->get_defect($_GET['defectid']);
         print "<fixref>".$defect->fixref."</fixref>";
         break;

      case "get_row":
         $defect = $defect->get_defect($_GET['defectid']);
         print "<fixref>".$defect->fixref."</fixref>";
         break;

      case "delete":
         $program->delete_defect_row($_GET['defectid']);
         $all = $defect->get_all_program_defects($_GET['prog']);
         foreach($all as $x)
         {
            print "<fixref>".$x->fixref."</fixref>";
         }
         break;

   }
   print "<id>".$defect->id."</id>";
   print "<programid>".$defect->program_id."</programid>";
   print "<date>".$defect->date."</date>";
   print "<number>".$defect->number."</number>";
   print "<type>".$defect->type."</type>";
   print "<inject_phase>".ucwords($defect->inject_phase)."</inject_phase>";
   print "<remove_phase>";
   if($defect->remove_phase == "postmortem") print "After Development";
   else print ucwords($defect->remove_phase);
   print "</remove_phase>";
   print "<fixtime>".$defect->fixtime."</fixtime>";
   print "<description>".$defect->description."</description>";
   if(isset($old_defect))
   {
      print "<old_date>".$old_defect->date."</old_date>";
      print "<old_number>".$old_defect->number."</old_number>";
      print "<old_type>".$old_defect->type."</old_type>";
      print "<old_inject_phase>".ucwords($old_defect->inject_phase)."</old_inject_phase>";
      print "<old_remove_phase>";
      if($old_defect->remove_phase == "postmortem") print "After Development";
      else print ucwords($old_defect->remove_phase);
      print "</old_remove_phase>";
      print "<old_fixtime>".$old_defect->fixtime."</old_fixtime>";
      print "<old_fixref>".$old_defect->fixref."</old_fixref>";
      print "<old_description>".$old_defect->description."</old_description>";
   }
   print "</xml>";
?>
