<?php

require_once "DBConnection.php";

class Phase {

   function create_program_phases($programid, $level)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      if($level < 4)
         $phases = array("Planning", "Design", "Code", "Compile", "Test", "Postmortem");
      else
         $phases = array("Planning", "Design", "Design Review", "Code", "Code Review", "Compile", "Test", "Postmortem");
      for($x = 0 ; $x < sizeof($phases) ; $x++)
         $result = $db->run_query("INSERT INTO phase values ( '".$phases[$x]."', ".$x.", ".$programid." )");
      $db->close();
   }

   function delete_all_for_program($program_id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("DELETE FROM phase WHERE programid='".$program_id."'");
      $db->close();
   }

   function get_all_program_phases($programid)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT name FROM phase where programid=".$programid." ORDER BY number");
      $row = $db->fetch_row($result);
      while($row)
      {
         $list[] = $row[0];
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }

} // Phase
?>
