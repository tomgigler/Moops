<?php

require_once "DBConnection.php";

class Task {
   var $id;
   var $number;
   var $name;
   var $minutes;
   var $plan_date;
   var $actual_date;
   var $programid;

   var $planned_value;
   var $cumulative_minutes_value;
   var $cumulative_planned_value;
   var $earned_value;
   var $cumulative_earned_value;

   // for sched planning template
   var $actual_minutes;
   var $cumulative_actual_minutes;

   function get_planned_time($programid, $name, $id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $sql = "SELECT SUM(minutes) FROM task WHERE programid='".$programid."' AND name='".$name."'";
      if($id) $sql .= " AND id != ".$id;
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      $db->close();
      return $row[0];
   }

   function task_exists($programid, $name, $plan_date)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT id FROM task WHERE programid='".$programid."' AND name='".$name."' AND plan_date='".$plan_date."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $row[0];
   }

   function get_next_number($pid)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT MAX(number) + 1 FROM task WHERE programid=".$pid);
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return 1;
      return $row[0];
   }

   function renumber_tasks()
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      // select id for all tasks in number order, we will renumber them
      $result = $db->run_query("SELECT id FROM task, phase  WHERE task.programid='".$this->programid."' AND phase.programid='".$this->programid."' AND task.name=phase.name ORDER BY plan_date, phase.number, task.number");
      $row = $db->fetch_row($result);
      for($x = 1 ; $row ; $x++)
      {
         $db->run_query("UPDATE task SET number=".$x." WHERE id=".$row[0]);
         $row = $db->next_row($result);
      }
      $db->close();
   }
   function delete_task($id)
   {
      $task = $this->get_task($id);
      $this->programid = $task->programid;
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("DELETE FROM task WHERE id=".$id);
      $db->close();
      $this->renumber_tasks();
   }

   function update_task($id, $n, $m, $pd, $ad)
   {
      $task = $this->get_task($id);
      $this->programid = $task->programid;
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      if($ad) $ad = "'".$ad."'";
      else $ad = "NULL";
      $result = $db->run_query("UPDATE task SET name='".$n."', minutes=".$m.", plan_date='".$pd."', actual_date=".$ad." WHERE id=".$id);
      $db->close();
      $this->renumber_tasks();
   }

   function create_task($pid, $n, $m, $pd, $ad)
   {
      $this->programid = $pid;
      $next_num = $this->get_next_number($pid);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      if($ad) $ad = "'".$ad."'";
      else $ad = "NULL";
      $sql = "INSERT INTO task ( number, name, minutes, plan_date, programid, actual_date ) VALUES ( ".$next_num.", '".$n."', ".$m.", '".$pd."', ".$pid.", ".$ad." )";
      $result = $db->run_query($sql);
      $id = $db->insert_id();
      $db->close();
      $this->renumber_tasks();
      return $id;
   }

   function get_task($id)
   {
      $p = new Program();
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT * FROM task WHERE id=".$id);
      $row = $db->fetch_row($result);
      $t = new Task();
      $t->id = $row[0];
      $t->number = $row[1];
      $t->name = $row[2];
      $t->minutes = $row[3];
      $t->plan_date = $row[4];
      $t->actual_date = $row[5];
      $t->programid = $row[6];
      $db->close();
      return $t;
   }

   function get_all_program_tasks($program_id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT id FROM task where programid='".$program_id."' ORDER BY number");
      $row = $db->fetch_row($result);
      while($row)
      {
         $list[] = $this->get_task($row[0]);
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }

   function get_all_program_schedule_tasks($program_id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT SUM(minutes), plan_date FROM task where programid='".$program_id."' GROUP BY plan_date ORDER BY plan_date");
      $row = $db->fetch_row($result);
      $number = 1;
      $cumulative_minutes = 0;
      while($row)
      {
         $t = new Task();
         $t->number = $number++;
         $t->minutes = $row[0];
         $cumulative_minutes += $row[0];
         $t->cumulative_minutes = $cumulative_minutes;
         $t->plan_date = $row[1];
         $list[] = $t;
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }

} //Task
?>
