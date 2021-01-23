<?php

require_once "DBConnection.php";

class Defect {
   var $id;
   var $program_id;
   var $date;
   var $number;
   var $type;
   var $inject_phase;
   var $remove_phase;
   var $fixtime;
   var $fixref;
   var $description;

   function update_row($id, $d, $t, $i, $r, $ft, $fr, $c)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE defect set date='".$d."', type='".$t."', inject_phase='".$i."', remove_phase='".$r."', fixtime='".$ft."', fixref='".$fr."', description='".mysql_escape_string($c)."' WHERE id=".$id);
      // a fixref of 0 is invalid, set it to null
      $result = $db->run_query("UPDATE defect set fixref=NULL WHERE id=".$id." AND fixref=0");
      $db->close();
   }

   function create_row($p, $d, $t, $i, $r, $ft, $fr, $ds)
   {
      // create a new defect for program p

      // connect to the database
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      // select the highest number defect for this program
      $result = $db->run_query("SELECT MAX(number) FROM defect WHERE programid='".$p."'");
      $row = $db->fetch_row($result);

      // the new number is the highest + 1
      $number = $row[0] + 1;

      // if there is no fix_ref for this defect set it to null
      if($fr == 0) $fr = "NULL";

      // insert the defect
      $result = $db->run_query("INSERT INTO defect ( programid, date, number, type, inject_phase, remove_phase, fixtime, fixref, description ) VALUES ( '".$p."', '".$d."', '".$number."', '".$t."', '".$i."', '".$r."', '".$ft."', ".$fr.", '".mysql_escape_string($ds)."')");

      // get the new defect id
      $row_id = $db->insert_id();

      // if user entered an invalid date change the date to today
      $result = $db->run_query("UPDATE defect SET date=DATE(NOW()) WHERE date=0 AND id = ".$row_id);

      // close the database and return the id of the inserted defect
      $db->close();
      return $row_id;
   }

   function get_last_defect_date($program_id)
   {
      // get the date of the most recent defect for this program

      // connect to the database
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      // select the date of the defect for this program with the largest number
      $result = $db->run_query("SELECT date FROM defect WHERE programid=".$program_id." AND number = ( SELECT MAX(number) FROM defect WHERE programid=".$program_id.")");
      $row = $db->fetch_row($result);

      // if there are no defects for this program just use the current date
      if(!$row[0])
      {
         $result = $db->run_query("SELECT CURDATE()");
         $row = $db->fetch_row($result);
      }

      // close the database and return the date
      $db->close();
      return $row[0];
   }

   function delete_row($defect_id)
   {
      // delete the defect with the given id

      // connect to the database
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      // get the programid and number for this defect
      $result = $db->run_query("SELECT programid, number FROM defect WHERE id='".$defect_id."'");
      $row = $db->fetch_row($result);
      $progid = $row[0];
      $num = $row[1];

      // find all defects whose fixref points to the defect we are deleting
      $result = $db->run_query("SELECT id FROM defect WHERE fixref='".$num."'");
      $row = $db->fetch_row($result);

      // set the fixref for them to null
      while($row)
      {
         $db->run_query("UPDATE defect SET fixref=NULL WHERE id=".$row[0]);
         $row = $db->next_row($result);
      }

      // delete the defect
      $result = $db->run_query("DELETE FROM defect WHERE id='".$defect_id."'");

      // select id and number for all defects in number order, we will renumber them
      $result = $db->run_query("SELECT id, number FROM defect WHERE programid='".$progid."' ORDER BY number");
      $row = $db->fetch_row($result);
      for($x = 1 ; $row ; $x++)
      {
         // the current defect is now number x, update it and all references to it
         $db->run_query("UPDATE defect SET number=".$x." WHERE id=".$row[0]);
         $db->run_query("UPDATE defect SET fixref=".$x." WHERE fixref=".$row[1]);
         $row = $db->next_row($result);
      }
      $db->close();
   }

   function delete_all_for_program($program_id)
   {
      // delete all defects for program

      // connect to the database
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      // delete all defects whose programid is $program_id
      $result = $db->run_query("DELETE FROM defect WHERE programid='".$program_id."'");
      $db->close();
   }

   function get_actual_injected($program_id)
   {
      $sql = "SELECT phase.name, COUNT(defect.id) FROM defect, program, phase WHERE defect.programid = program.id AND phase.programid = program.id AND phase.name=defect.inject_phase AND program.id=".$program_id." GROUP BY phase.name ORDER BY phase.number";
      // connect to the database and run query
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      // fetch result and close database
      $total = 0;
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      while($row)
      {
         $list[$row[0]] = $row[1];
         $total += $row[1];
         $row = $db->fetch_row($result);
      }
      $db->close();
      $list["Total"] = $total;
      return $list;
   }

   function get_to_date_injected($programid)
   {
      $sql = "SELECT phase.name, COUNT(defect.id) FROM defect, program, phase WHERE defect.programid = program.id AND phase.programid = program.id AND phase.name=defect.inject_phase AND program.username=( SELECT username FROM program WHERE id=".$programid.") AND program.number <= ( SELECT number FROM program WHERE id=".$programid.") GROUP BY defect.inject_phase";

      // connect to the database
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      // fetch result and close database
      $total = 0;
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      while($row)
      {
         $list[$row[0]] = $row[1];
         $total += $row[1];
         $row = $db->fetch_row($result);
      }
      $db->close();
      $list["Total"] = $total;
      return $list;
   }

   function get_to_date_injected_percent($username, $number, $phase)
   {
      // return the percent of total defects to date in this phase

      $total = $this->get_to_date_injected($username, $number);
      if(!$total) return 0;
      $this_phase = $this->get_to_date_injected($username, $number, $phase);
      return $this_phase/$total*100;
   }

   function get_actual_removed($program_id)
   {
      $sql = "SELECT phase.name, COUNT(defect.id) FROM defect, program, phase WHERE defect.programid = program.id AND phase.programid = program.id AND phase.name=defect.remove_phase AND program.id=".$program_id." GROUP BY phase.name ORDER BY phase.number";
      // connect to the database and run query
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      // fetch result and close database
      $total = 0;
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      while($row)
      {
         $list[$row[0]] = $row[1];
         $total += $row[1];
         $row = $db->fetch_row($result);
      }
      $db->close();
      $list["Total"] = $total;
      return $list;
   }

   function get_to_date_removed($programid)
   {
      $sql = "SELECT phase.name, COUNT(defect.id) FROM defect, program, phase WHERE defect.programid = program.id AND phase.programid = program.id AND phase.name=defect.remove_phase AND program.username=( SELECT username FROM program WHERE id=".$programid.") AND program.number <= ( SELECT number FROM program WHERE id=".$programid.") GROUP BY defect.remove_phase";

      // connect to the database
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      // fetch result and close database
      $total = 0;
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      while($row)
      {
         $list[$row[0]] = $row[1];
         $total += $row[1];
         $row = $db->fetch_row($result);
      }
      $db->close();
      $list["Total"] = $total;
      return $list;
   }

   function get_to_date_removed_percent($username, $number, $phase)
   {
      $total = $this->get_to_date_removed($username, $number);
      if(!$total) return 0;
      $this_phase = $this->get_to_date_removed($username, $number, $phase);
      return $this_phase/$total*100;
   }

   function get_defect($id)
   {
      // get the defect with id = id
 
      // connect to the database
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT * FROM defect where id='".$id."'");
      $row = $db->fetch_row($result);
      $d = new Defect();
      $d->id = $row[0];
      $d->program_id = $row[1];
      $d->date = $row[2];
      $d->number = $row[3];
      $d->type = $row[4];
      $d->inject_phase = $row[5];
      $d->remove_phase = $row[6];
      $d->fixtime = $row[7];
      $d->fixref = $row[8];
      $d->description = $row[9];

      $db->close();
      return $d;
   }

   function get_all_program_defects($program_id)
   {
      // get all defects for this program
 
      // connect to the database
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT * FROM defect where programid='".$program_id."' ORDER BY number");
      $row = $db->fetch_row($result);
      while($row)
      {
         $d = new Defect();
         $d->id = $row[0];
         $d->program_id = $row[1];
         $d->date = $row[2];
         $d->number = $row[3];
         $d->type = $row[4];
         $d->inject_phase = $row[5];
         $d->remove_phase = $row[6];
         $d->fixtime = $row[7];
         $d->fixref = $row[8];
         $d->description = $row[9];
         $list[] = $d;
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }
}//Defect
?>
