<?php

require_once "DBConnection.php";

class Time {
   var $id;
   var $cached_values;

   function get_id()
   {
      return $this->id;
   }

   function get_db_value($v)
   {
      $this = $this->get_time($this->get_id());
      return $this->cached_values[$v];
   }

   function get_program_id()
   {
      if(isset($this->cached_values["program_id"]))
         return $this->cached_values["program_id"];
      return $this->get_db_value("program_id");
   }

   function get_date()
   {
      if(isset($this->cached_values["date"]))
         return $this->cached_values["date"];
      return $this->get_db_value("date");
   }

   function get_starttime()
   {
      if(isset($this->cached_values["starttime"]))
         return $this->cached_values["starttime"];
      return $this->get_db_value("starttime");
   }

   function get_stoptime()
   {
      if(isset($this->cached_values["stoptime"]))
         return $this->cached_values["stoptime"];
      return $this->get_db_value("stoptime");
   }

   function get_int_time()
   {
      if(isset($this->cached_values["int_time"]))
         return $this->cached_values["int_time"];
      return $this->get_db_value("int_time");
   }

   function get_phase()
   {
      if(isset($this->cached_values["phase"]))
         return $this->cached_values["phase"];
      return $this->get_db_value("phase");
   }

   function get_comments()
   {
      if(isset($this->cached_values["comments"]))
         return $this->cached_values["comments"];
      return $this->get_db_value("comments");
   }

   function get_delta_time()
   {
      if(isset($this->cached_values["delta_time"]))
         return $this->cached_values["delta_time"];
      return $this->get_db_value("delta_time");
   }


   function get_actual_date($program_id, $phase, $count)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT DISTINCT date FROM time WHERE phase='".$phase."' AND programid=".$program_id." ORDER BY date;");
      $row = $db->fetch_row($result);
      $true_count = 0;
      while($row)
      {
         $true_count++; 
         if($count == $true_count) break;
         $row = $db->next_row($result);
      }
      $db->close();
      if($count == $true_count)
         return $row[0];
      return 0;
   }

   function get_current_date()
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT DATE(NOW())");
      $row = $db->fetch_row($result);
      $db->close();
      return $row[0];
   }

   function get_current_time()
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT TIME_FORMAT(NOW(), '%k:%i')");
      $row = $db->fetch_row($result);
      $db->close();
      return $row[0];
   }

   function create_row($p, $d, $s, $st, $i, $ph, $c)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("INSERT INTO time ( programid, date, starttime, stoptime, int_time, phase, comments ) VALUES ( '".$p."', '".$d."', '".$s."', '".$st."', '".$i."', '".$ph."', '".mysql_escape_string($c)."')");
      $row = $db->insert_id();
      $db->close();
      return $row;
   }

   function update_row($id, $d, $s, $st, $i, $ph, $c)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE time set date='".$d."', starttime='".$s."', stoptime='".$st."', int_time='".$i."', phase='".$ph."', comments='".mysql_escape_string($c)."' WHERE id=".$id); 
      $db->close();
   }

   function get_last_time_time($program_id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT TIME_FORMAT(stoptime,'%k:%i') FROM time WHERE programid=".$program_id." AND stoptime = ( SELECT MAX(stoptime) FROM time WHERE programid=".$program_id.")");
      $row = $db->fetch_row($result);
      if(!$row[0])
      {
         $result = $db->run_query("SELECT TIME_FORMAT(CURTIME(),'%k:%i')");
         $row = $db->fetch_row($result);
      }
      $db->close();
      return $row[0];
   }

   function get_last_time_date($program_id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT date FROM time WHERE programid=".$program_id." AND date = ( SELECT MAX(date) FROM time WHERE programid=".$program_id.")");
      $row = $db->fetch_row($result);
      if(!$row[0])
      {
         $result = $db->run_query("SELECT CURDATE()");
         $row = $db->fetch_row($result);
      }
      $db->close();
      return $row[0];
   }

   function delete_row($time_id)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("DELETE FROM time WHERE id='".$time_id."'");
      $db->close();
   }

   function delete_all_for_program($program_id)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("DELETE FROM time WHERE programid='".$program_id."'");
      $db->close();
   }

   function get_actual_time($program_id, $phase)
   {
      if(isset($this->cached_values["actual_time_".$phase]))
         return $this->cached_values["actual_time_".$phase];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT phase, SUM(TIME_TO_SEC(TIMEDIFF(stoptime, starttime))/60 - int_time + 1440 * ( stoptime < starttime)) AS delta FROM time, phase WHERE time.programid = ".$program_id." AND phase.programid = ".$program_id." AND time.phase = phase.name GROUP BY phase ORDER BY phase.number");
      $row = $db->fetch_row($result);
      $this->cached_values["actual_time_"] = 0;
      while($row)
      {
         $this->cached_values["actual_time_".$row[0]] = $row[1];
         $this->cached_values["actual_time_"] += $row[1];
         $row = $db->next_row($result);
      }
      $db->close();
      return $this->cached_values["actual_time_".$phase];
   }

   function get_to_date_time($username, $number)
   {
      $sql = "SELECT phase.name, SUM(TIME_TO_SEC(TIMEDIFF(stoptime, starttime))/60 - int_time + 1440 * ( stoptime < starttime)) AS delta FROM time, phase WHERE time.phase = phase.name AND time.programid=phase.programid AND time.programid IN ( SELECT id FROM program WHERE username='".$username."' AND number <= ".$number." ) GROUP BY phase ORDER BY phase.number";
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      $total = 0;
      while($row)
      {
         $total += $row[1];
         $list[$row[0]] = $row[1];
         $row = $db->next_row($result);
      }
      $list["Total"] = $total;
      $db->close();
      return $list;
   }

   function get_to_date_percent($username, $number, $phase)
   {
      $total = $this->get_to_date_time($username, $number);
      $this_phase = $this->get_to_date_time($username, $number, $phase);
      return $this_phase/$total*100;
   }

   function get_total_time_for_date($programid, $date)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT TIME_TO_SEC(TIMEDIFF(stoptime, starttime))/60 - int_time FROM time WHERE programid=".$programid." AND date='".$date."'");
      $row = $db->fetch_row($result);
      $total = 0;
      while($row)
      {
         if($row[0] <= 0) $total += $row[0] + 1440;
         else $total += $row[0];
         $row = $db->next_row($result);
      }
      $db->close();
      return $total;
   }

   function get_time($id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT id, programid, date, TIME_FORMAT(starttime,'%k:%i'), TIME_FORMAT(stoptime,'%k:%i'), int_time, phase, comments, time_to_sec(timediff(stoptime, starttime))/60 - int_time + 1440 * ( stoptime < starttime) FROM time WHERE id=".$id);
      $row = $db->fetch_row($result);
      $t = new Time();
      $t->id = $row[0];
      $t->cached_values["program_id"] = $row[1];
      $t->cached_values["date"] = $row[2];
      $t->cached_values["starttime"] = $row[3];
      $t->cached_values["stoptime"] = $row[4];
      $t->cached_values["int_time"] = $row[5];
      $t->cached_values["phase"] = $row[6];
      $t->cached_values["comments"] = $row[7];
      $t->cached_values["delta_time"] = $row[8];
      $db->close();
      return $t;
   }

   function get_all_program_times($program_id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT id, programid, date, TIME_FORMAT(starttime,'%k:%i'), TIME_FORMAT(stoptime,'%k:%i'), int_time, phase, comments, time_to_sec(timediff(stoptime, starttime))/60 - int_time + 1440 * ( stoptime < starttime) FROM time WHERE programid='".$program_id."' ORDER BY date, starttime");
      $row = $db->fetch_row($result);
      $this->cached_values["actual_time_"] = 0;
      while($row)
      {
         $t = new Time();
         $t->id = $row[0];
         $t->cached_values["program_id"] = $row[1];
         $t->cached_values["date"] = $row[2];
         $t->cached_values["starttime"] = $row[3];
         $t->cached_values["stoptime"] = $row[4];
         $t->cached_values["int_time"] = $row[5];
         $t->cached_values["phase"] = $row[6];
         $t->cached_values["comments"] = $row[7];
         $t->cached_values["delta_time"] = $row[8];
         $this->cached_values["actual_time_"] += $row[8];
         $list[] = $t;
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }

}//Time
?>
