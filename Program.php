<?php

require_once "DBConnection.php";
require_once "Time.php";
require_once "Task.php";
require_once "Defect.php";
require_once "Object.php";
require_once "Level.php";
require_once "Phase.php";

class Program {
   var $id;

   var $cached_values;

   var $time;
   var $task;
   var $defect;
   var $level_obj;
   var $object;
   var $phase;

   function Program()
   {
      $this->time = new Time();
      $this->task = new Task();
      $this->defect = new Defect();
      $this->level_obj = new Level();
      $this->object = new Object();
      $this->phase = new Phase();
$this->using_cache = 1;
$this->count = 0;
   }

   function get_id()
   {
      return $this->id;
   }

   function get_db_value($v)
   {
      $this = $this->get_program($this->get_id());
      return $this->cached_values[$v];
   }

   function get_level()
   {
if($this->using_cache)
      if(isset($this->cached_values["level"]))
         return $this->cached_values["level"];
      return $this->get_db_value("level");
   }

   function get_username()
   {
if($this->using_cache)
      if(isset($this->cached_values["username"]))
         return $this->cached_values["username"];
      return $this->get_db_value("username");
   }

   function get_number()
   {
if($this->using_cache)
      if(isset($this->cached_values["number"]))
         return $this->cached_values["number"];
      return $this->get_db_value("number");
   }

   function get_total_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["total_loc"]))
         return $this->cached_values["total_loc"];
      return $this->get_db_value("total_loc");
   }

   function get_base_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["base_loc"]))
         return $this->cached_values["base_loc"];
      return $this->get_db_value("base_loc");
   }

   function get_est_base_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["est_base_loc"]))
         return $this->cached_values["est_base_loc"];
      return $this->get_db_value("est_base_loc");
   }

   function get_deleted_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["deleted_loc"]))
         return $this->cached_values["deleted_loc"];
      return $this->get_db_value("deleted_loc");
   }

   function get_est_deleted_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["est_deleted_loc"]))
         return $this->cached_values["est_deleted_loc"];
      return $this->get_db_value("est_deleted_loc");
   }

   function get_modified_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["modified_loc"]))
         return $this->cached_values["modified_loc"];
      return $this->get_db_value("modified_loc");
   }

   function get_est_modified_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["est_modified_loc"]))
         return $this->cached_values["est_modified_loc"];
      return $this->get_db_value("est_modified_loc");
   }

   function get_reused_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["reused_loc"]))
         return $this->cached_values["reused_loc"];
      return $this->get_db_value("reused_loc");
   }

   function get_plan_newchg_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_newchg_loc"]))
         return $this->cached_values["plan_newchg_loc"];
      return $this->get_db_value("plan_newchg_loc");
   }

   function get_category_groups()
   {
if($this->using_cache)
      if(isset($this->cached_values["category_groups"]))
         return $this->cached_values["category_groups"];
      return $this->get_db_value("category_groups");
   }

   function get_probe_method_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["probe_method_loc"]))
         return $this->cached_values["probe_method_loc"];
      return $this->get_db_value("probe_method_loc");
   }

   function get_probe_method_time()
   {
if($this->using_cache)
      if(isset($this->cached_values["probe_method_time"]))
         return $this->cached_values["probe_method_time"];
      return $this->get_db_value("probe_method_time");
   }

   function create_object_row($n, $t, $m, $rs, $l, $r, $nb)
   {
      unset($this->cached_values);
      return $this->object->create_row($this->get_id(), $n, $t, $m, $rs, $l, $r, $nb);
   }

   function update_object_row($id, $n, $t, $m, $rs, $l, $r)
   {
      unset($this->cached_values);
      return $this->object->update_row($id, $n, $t, $m, $rs, $l, $r);
   }

   function delete_object_row($id)
   {
      unset($this->cached_values);
      $this->object->delete_row($id);
   }

   function create_task($n, $m, $pd, $ad)
   {
      unset($this->cached_values);
      return $this->task->create_task($this->get_id(), $n, $m, $pd, $ad);
   }

   function update_task($id, $n, $m, $pd, $ad)
   {
      unset($this->cached_values);
      $this->task->update_task($id, $n, $m, $pd, $ad);
   }

   function delete_task($id)
   {
      unset($this->cached_values);
      $this->task->delete_task($id);
   }


   function get_all_defects()
   {
if($this->using_cache)
      if(isset($this->cached_values["all_defects"]))
         return $this->cached_values["all_defects"];
      return $this->cached_values["all_defects"] = $this->defect->get_all_program_defects($this->get_id());
   }

   function update_defect_row($id, $d, $t, $i, $r, $ft, $fr, $c)
   {
      unset($this->cached_values);
      $this->defect->update_row($id, $d, $t, $i, $r, $ft, $fr, $c);
   }

   function create_defect_row($d, $t, $i, $r, $ft, $fr, $ds)
   {
      unset($this->cached_values);
      return $this->defect->create_row($this->get_id(), $d, $t, $i, $r, $ft, $fr, $ds);
   }

   function delete_defect_row($defect_id)
   {
      unset($this->cached_values);
      $this->defect->delete_row($defect_id);
   }

   function get_all_program_defects()
   {
if($this->using_cache)
      if(isset($this->cached_values["all_program_defects"]))
         return $this->cached_values["all_program_defects"];
      return $this->cached_values["all_program_defects"] = $this->defect->get_all_program_defects($this->get_id());
   }

   function delete_time_row($time_id)
   {
      unset($this->cached_values);
      return $this->time->delete_row($time_id);
   }

   function update_time_row($id, $d, $s, $st, $i, $ph, $c)
   {
      unset($this->cached_values);
      return $this->time->update_row($id, $d, $s, $st, $i, $ph, $c);
   }

   function create_time_row($d, $s, $st, $i, $ph, $c)
   {
      unset($this->cached_values);
      return $this->time->create_row($this->get_id(), $d, $s, $st, $i, $ph, $c);
   }

   function get_all_program_times()
   {
if($this->using_cache)
      if(isset($this->cached_values["all_program_times"]))
         return $this->cached_values["all_program_times"];
      return $this->cached_values["all_program_times"] = $this->time->get_all_program_times($this->get_id());
   }

   function get_all_phases()
   {
if($this->using_cache)
      if(isset($this->cached_values["all_phases"]))
         return $this->cached_values["all_phases"];
      return $this->cached_values["all_phases"] = $this->phase->get_all_program_phases($this->get_id());
   }

   function get_estimated_object_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["estimated_object_loc"]))
         return $this->cached_values["estimated_object_loc"];
      return $this->cached_values["estimated_object_loc"] = $this->get_plan_total_new_base("base") + $this->get_plan_total_new_base("new") + $this->get_est_modified_loc();
   }

   function get_percent_plan_new_reuse()
   {
if($this->using_cache)
      if(isset($this->cached_values["percent_plan_new_reuse"]))
         return $this->cached_values["percent_plan_new_reuse"];
      if($this->get_plan_newchg_loc() == 0) return $this->cached_values["percent_plan_new_reuse"] = 0;
      return $this->cached_values["percent_plan_new_reuse"] = $this->get_est_total_new_reuse()/$this->get_plan_newchg_loc()*100;
   }

   function get_percent_new_reuse()
   {
if($this->using_cache)
      if(isset($this->cached_values["percent_new_reuse"]))
         return $this->cached_values["percent_new_reuse"];
      if($this->get_newchg_loc() == 0) return $this->cached_values["percent_new_reuse"] = 0;
      return $this->cached_values["percent_new_reuse"] = $this->get_total_new_reuse()/$this->get_newchg_loc()*100;
   }

   function get_to_date_percent_new_reuse()
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_percent_new_reuse"]))
         return $this->cached_values["to_date_percent_new_reuse"];
      if($this->get_to_date_newchg_loc() == 0) return $this->cached_values["to_date_percent_new_reuse"] = 0;
      return $this->cached_values["to_date_percent_new_reuse"] = $this->get_to_date_new_reuse()/$this->get_to_date_newchg_loc()*100;
   }

   function get_percent_plan_reused_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["percent_plan_reused_loc"]))
         return $this->cached_values["percent_plan_reused_loc"];
      if($this->get_plan_total_loc() == 0) return $this->cached_values["percent_plan_reused_loc"] = 0;
      return $this->cached_values["percent_plan_reused_loc"] = $this->get_total_plan_reused_loc()/$this->get_plan_total_loc()*100;
   }

   function get_percent_reused_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["percent_reused_loc"]))
         return $this->cached_values["percent_reused_loc"];
      if($this->get_plan_total_loc() == 0) return $this->cached_values["percent_reused_loc"] = 0;
      return $this->cached_values["percent_reused_loc"] = $this->get_reused_loc()/$this->get_total_loc()*100;
   }
 
   function get_to_date_percent_reused_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_percent_reused_loc"]))
         return $this->cached_values["to_date_percent_reused_loc"];
      if($this->get_to_date_total_loc() == 0) return $this->cached_values["to_date_percent_reused_loc"] = 0;
      return $this->cached_values["to_date_percent_reused_loc"] = $this->get_to_date_reused_loc()/$this->get_to_date_total_loc()*100;
   }

   function get_CPI()
   {
if($this->using_cache)
      if(isset($this->cached_values["CPI"]))
         return $this->cached_values["CPI"];
      return $this->cached_values["CPI"] = $this->get_to_date_plan_time()/$this->get_to_date_time();
   }

   function get_probe_plan_newchg_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["probe_plan_newchg_loc"]))
         return $this->cached_values["probe_plan_newchg_loc"];
      if($this->get_probe_method_loc() == "D") return $this->cached_values["probe_plan_newchg_loc"] = $this->get_plan_newchg_loc();
      return $this->cached_values["probe_plan_newchg_loc"] = $this->get_b0_size() + $this->get_b1_size() * $this->get_estimated_object_loc();
   }

   function get_probe_plan_total_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["probe_plan_total_loc"]))
         return $this->cached_values["probe_plan_total_loc"];
      if($this->get_probe_method_loc() == "D")
         return $this->cached_values["probe_plan_total_loc"] = $this->get_plan_newchg_loc() + $this->get_est_base_loc() - $this->get_est_modified_loc() - $this->get_est_deleted_loc() + $this->get_total_plan_reused_loc();
      return $this->cached_values["probe_plan_total_loc"] = $this->get_probe_plan_newchg_loc() + $this->get_est_base_loc() - $this->get_est_modified_loc() - $this->get_est_deleted_loc() + $this->get_total_plan_reused_loc();
   }

   function get_upper_interval_size()
   {
if($this->using_cache)
      if(isset($this->cached_values["upper_interval_size"]))
         return $this->cached_values["upper_interval_size"];
      return $this->cached_values["upper_interval_size"] = $this->get_probe_plan_newchg_loc() + $this->get_range_size();
   }

   function get_upper_interval_time()
   {
if($this->using_cache)
      if(isset($this->cached_values["upper_interval_time"]))
         return $this->cached_values["upper_interval_time"];
      return $this->cached_values["upper_interval_time"] = $this->get_probe_plan_time() + $this->get_range_time();
   }

   function get_lower_interval_size()
   {
if($this->using_cache)
      if(isset($this->cached_values["lower_interval_size"]))
         return $this->cached_values["lower_interval_size"];
      return $this->cached_values["lower_interval_size"] = $this->get_probe_plan_newchg_loc() - $this->get_range_size();
   }

   function get_lower_interval_time()
   {
if($this->using_cache)
      if(isset($this->cached_values["lower_interval_time"]))
         return $this->cached_values["lower_interval_time"];
      return $this->cached_values["lower_interval_time"] = $this->get_probe_plan_time() - $this->get_range_time();
   }

   function get_probe_plan_size()
   {
if($this->using_cache)
      if(isset($this->cached_values["probe_plan_size"]))
         return $this->cached_values["probe_plan_size"];
      if($this->get_probe_method_loc() == "D") return $this->cached_values["probe_plan_size"] = 0;
      return $this->cached_values["probe_plan_size"] = "";
   }

   function get_probe_plan_time()
   {
if($this->using_cache)
      if(isset($this->cached_values["probe_plan_time"]))
         return $this->cached_values["probe_plan_time"];
      if($this->get_probe_method_time() == "D") return $this->cached_values["probe_plan_time"] = $this->get_plan_time();
      return $this->cached_values["probe_plan_time"] = $this->get_b0_time() + $this->get_b1_time() * $this->get_estimated_object_loc();
   }

   function get_range_size()
   {
if($this->using_cache)
      if(isset($this->cached_values["range_size"]))
         return $this->cached_values["range_size"];

      if($this->get_probe_method_loc() == "D" || $this->get_probe_method_loc() == "C")
      {
         return $this->cached_values["range_size"] = $this->get_db_value("range_size");
      }
      return $this->cached_values["range_size"] = "";
   }

   function get_range_time()
   {
if($this->using_cache)
      if(isset($this->cached_values["range_time"]))
         return $this->cached_values["range_time"];
      if($this->get_probe_method_time() == "D" || $this->get_probe_method_time() == "C")
      {
         return $this->cached_values["range_time"] = $this->get_db_value("range_time");
      }

      return $this->cached_values["range_time"] = "";
   }

   function get_b0_size()
   {
if($this->using_cache)
      if(isset($this->cached_values["b0_size"]))
         return $this->cached_values["b0_size"];
      if($this->get_probe_method_loc() == "D") return $this->cached_values["b0_size"] = "-";
      if($this->get_probe_method_loc() == "C") return $this->cached_values["b0_size"] = "0";
      return $this->cached_values["b0_size"] = "";
   }

   function get_b0_size_display()
   {
if($this->using_cache)
      if(isset($this->cached_values["b0_size_display"]))
         return $this->cached_values["b0_size_display"];
      if($this->get_probe_method_loc() == "D") return $this->cached_values["b0_size_display"] = "-";
      return $this->cached_values["b0_size_display"] = round($this->get_b0_size(), 2);
   }

   function get_b1_size()
   {
if($this->using_cache)
      if(isset($this->cached_values["b1_size"]))
         return $this->cached_values["b1_size"];
      if($this->get_probe_method_loc() == "D") return $this->cached_values["b1_size"] = "-";

      if($this->get_probe_method_loc() == "C")
      {
         $db = new DBConnection() or die('There was an error connecting to the database.');
         $db->connect();
         $result = $db->run_query("SELECT id FROM program WHERE username='".$this->get_username()."' AND number < ".$this->get_number()." AND level > 1");
         $row = $db->fetch_row($result);
         $total_loc = 0;
         $total_est_loc = 0;
         while($row)
         {
            $p = $this->get_program($row[0]);
            if($p->get_newchg_loc() && $p->get_estimated_object_loc())
            {
               $total_loc += $p->get_newchg_loc();
               $total_est_loc += $p->get_estimated_object_loc();
            }
            $row = $db->next_row($result);
         }
         $db->close();
// TODO: if($total_est_loc == 0 || $total_loc == 0) handle error
         return $this->cached_values["b1_size"] = $total_loc/$total_est_loc;
      }

      return $this->cached_values["b1_size"] = "";
   }

   function get_b1_size_display()
   {
if($this->using_cache)
      if(isset($this->cached_values["b1_size_display"]))
         return $this->cached_values["b1_size_display"];
      if($this->get_probe_method_loc() == "D") return $this->cached_values["b1_size_display"] = "-";
      return $this->cached_values["b1_size_display"] = round($this->get_b1_size(), 2);
   }

   function get_b0_time()
   {
if($this->using_cache)
      if(isset($this->cached_values["b0_time"]))
         return $this->cached_values["b0_time"];
      if($this->get_probe_method_time() == "D") return $this->cached_values["b0_time"] = "-";
      if($this->get_probe_method_time() == "C") return $this->cached_values["b0_time"] = "0";
      return $this->cached_values["b0_time"] = "";
   }

   function get_b0_time_display()
   {
if($this->using_cache)
      if(isset($this->cached_values["b0_time_display"]))
         return $this->cached_values["b0_time_display"];
      if($this->get_probe_method_time() == "D") return $this->cached_values["b0_time_display"] = "-";
      return $this->cached_values["b0_time_display"] = round($this->get_b0_time(), 2);
   }

   function get_b1_time()
   {
if($this->using_cache)
      if(isset($this->cached_values["b1_time"]))
         return $this->cached_values["b1_time"];
      if($this->get_probe_method_time() == "D") return $this->cached_values["b1_time"] = "-";

      if($this->get_probe_method_time() == "C")
      {
         $db = new DBConnection() or die('There was an error connecting to the database.');
         $db->connect();
         $result = $db->run_query("SELECT id FROM program WHERE username='".$this->get_username()."' AND number < ".$this->get_number()." AND level > 1");
         $row = $db->fetch_row($result);
         $total_time = 0;
         $total_est_loc = 0;
         while($row)
         {
            $p = $this->get_program($row[0]);
            if($p->get_actual_time() && $p->get_estimated_object_loc())
            {
               $total_time += $p->get_actual_time();
               $total_est_loc += $p->get_estimated_object_loc();
            }
            $row = $db->next_row($result);
         }
         $db->close();
// TODO: if($total_est_loc == 0 || $total_time == 0) handle error
         return $this->cached_values["b1_time"] = $total_time/$total_est_loc;
      }

      return $this->cached_values["b1_time"] = "";
   }

   function get_b1_time_display()
   {
if($this->using_cache)
      if(isset($this->cached_values["b1_time_display"]))
         return $this->cached_values["b1_time_display"];
      if($this->get_probe_method_time() == "D") return $this->cached_values["b1_time_display"] = "-";
      return $this->cached_values["b1_time_display"] = round($this->get_b1_time(), 2);
   }

   function set_range_size($r)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET range_size='".$r."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT range_size FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["range_size"] = $row[0];
   }

   function set_range_time($r)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET range_time='".$r."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT range_time FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["range_time"] = $row[0];
   }

   function set_probe_method_loc($cg)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET probe_method_loc='".$cg."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT probe_method_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["probe_method_loc"] = $row[0];
   }

   function set_probe_method_time($cg)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET probe_method_time='".$cg."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT probe_method_time FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["probe_method_time"] = $row[0];
   }

   function set_category_groups($cg)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET category_groups='".$cg."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT category_groups FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["category_groups"] = $row[0];
   }

   function get_plan_DRL($phase1, $phase2)
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_DRL_".$phase1."_".$phase2]))
         return $this->cached_values["plan_DRL_".$phase1."_".$phase2];
      $denominator = $this->get_plan_defects_per_hour($phase2);
      if($denominator == 0) $denominator = $this->get_to_date_defects_per_hour($phase2);
      if($denominator == 0) return $this->cached_values["plan_DRL_".$phase1."_".$phase2] = 0;
      return $this->cached_values["plan_DRL_".$phase1."_".$phase2] = $this->get_plan_defects_per_hour($phase1) / $denominator;
   }

   function get_actual_DRL($phase1, $phase2)
   {
if($this->using_cache)
      if(isset($this->cached_values["actual_DRL_".$phase1."_".$phase2]))
         return $this->cached_values["actual_DRL_".$phase1."_".$phase2];
      $denominator = $this->get_actual_defects_per_hour($phase2);
      if($denominator == 0) $denominator = $this->get_to_date_defects_per_hour($phase2);
      if($denominator == 0) return $this->cached_values["actual_DRL_".$phase1."_".$phase2] = 0;
      return $this->cached_values["actual_DRL_".$phase1."_".$phase2] = $this->get_actual_defects_per_hour($phase1) / $denominator;
   }

   function get_to_date_DRL($phase1, $phase2)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_DRL_".$phase1."_".$phase2]))
         return $this->cached_values["to_date_DRL_".$phase1."_".$phase2];
      $denominator = $this->get_to_date_defects_per_hour($phase2);
      if($denominator == 0) $denominator = $this->get_to_date_defects_per_hour($phase2);
      if($denominator == 0) return $this->cached_values["to_date_DRL_".$phase1."_".$phase2] = 0;
      return $this->cached_values["to_date_DRL_".$phase1."_".$phase2] = $this->get_to_date_defects_per_hour($phase1) / $denominator;
   }

   function get_plan_yield()
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_yield"]))
         return $this->cached_values["plan_yield"];
      // 100 * defects removed before first compile / defects injected before first compile
      $phases = $this->get_all_phases();
      $defects_removed = 0;
      $defects_injected = 0;
      foreach($phases as $p)
      {
         // we may allow users to remove the compile phase, so use test if compile not found
         if($p == "Compile" || $p == "Test") break;
         $defects_removed += $this->get_plan_remove($p);
         $defects_injected += $this->get_plan_injected($p);
      }
      if($defects_injected == 0) return $this->cached_values["plan_yield"] = 0;
      return $this->cached_values["plan_yield"] = 100 * $defects_removed / $defects_injected;
   }

   function get_actual_yield()
   {
if($this->using_cache)
      if(isset($this->cached_values["actual_yield"]))
         return $this->cached_values["actual_yield"];
      // 100 * defects removed before first compile / defects injected before first compile
      $phases = $this->get_all_phases();
      $defects_removed = 0;
      $defects_injected = 0;
      foreach($phases as $p)
      {
         // we may allow users to remove the compile phase, so use test if compile not found
         if($p == "Compile" || $p == "Test") break;
         $defects_removed += $this->get_actual_removed($p);
         $defects_injected += $this->get_actual_injected($p);
      }
      if($defects_injected == 0) return $this->cached_values["actual_yield"] = 0;
      return $this->cached_values["actual_yield"] = 100 * $defects_removed / $defects_injected;
   }

   function get_to_date_yield()
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_yield"]))
         return $this->cached_values["to_date_yield"];
      // 100 * defects removed before first compile / defects injected before first compile
      $phases = $this->get_all_phases();
      $defects_removed = 0;
      $defects_injected = 0;
      foreach($phases as $p)
      {
         // we may allow users to remove the compile phase, so use test if compile not found
         if($p == "Compile" || $p == "Test") break;
         $defects_removed += $this->get_to_date_removed($p);
         $defects_injected += $this->get_to_date_injected($p);
      }
      if($defects_injected == 0) return $this->cached_values["to_date_yield"] = 0;
      return $this->cached_values["to_date_yield"] = 100 * $defects_removed / $defects_injected;
   }

   function get_plan_defects_per_hour($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["get_plan_defects_per_hour_$phase"]))
         return $this->cached_values["get_plan_defects_per_hour_$phase"];

      // 60 * defects removed in phase / time of phase
      return $this->cached_values["get_plan_defects_per_hour_$phase"] = 60 * $this->get_plan_remove($phase) / $this->get_plan_time($phase);
   }

   function get_actual_defects_per_hour($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["get_actual_defects_per_hour_$phase"]))
         return $this->cached_values["get_actual_defects_per_hour_$phase"];

      // 60 * defects removed in phase / time of phase
      return $this->cached_values["get_actual_defects_per_hour_$phase"] = 60 * $this->get_actual_removed($phase) / $this->get_actual_time($phase);
   }

   function get_to_date_defects_per_hour($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["get_to_date_defects_per_hour_$phase"]))
         return $this->cached_values["get_to_date_defects_per_hour_$phase"];

      // 60 * defects removed in phase / time of phase
      return $this->cached_values["get_to_date_defects_per_hour_$phase"] = 60 * $this->get_to_date_removed($phase) / $this->get_to_date_time($phase);
   }

   function get_plan_defects_per_kloc($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_defects_per_kloc_".$phase]))
         return $this->cached_values["plan_defects_per_kloc_".$phase];
      return $this->cached_values["plan_defects_per_kloc_".$phase] = 1000 * $this->get_plan_remove($phase) / $this->get_plan_newchg_loc();
   }

   function get_defects_per_kloc($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["defects_per_kloc_".$phase]))
         return $this->cached_values["defects_per_kloc_".$phase];
      return $this->cached_values["defects_per_kloc_".$phase] = 1000 * $this->get_actual_removed($phase) / $this->get_newchg_loc();
   }

   function get_to_date_defects_per_kloc($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_defects_per_kloc_".$phase]))
         return $this->cached_values["to_date_defects_per_kloc_".$phase];
      return $this->cached_values["to_date_defects_per_kloc_".$phase] = 1000 * $this->get_to_date_removed($phase) / $this->get_to_date_newchg_loc();
   }

   function &get_previous_program()
   {
if($this->using_cache)
      if(isset($this->cached_values["previous_program"]))
         return $this->cached_values["previous_program"];

      // get id of previous program
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT id FROM program WHERE username='".$this->get_username()."' AND number < ".$this->get_number()." ORDER BY number DESC");
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return $this->cached_values["previous_program"] = 0;
      return $this->cached_values["previous_program"] = &$this->get_program($row[0]);
   }

   function get_plan_injected($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_injected_".$phase]))
         return $this->cached_values["plan_injected_".$phase];

      if($this->get_number() == 1) return $this->cached_values["plan_injected_".$phase] = 0;

      return $this->cached_values["plan_injected_".$phase] = ($this->get_to_date_injected($phase) - $this->get_actual_injected($phase)) / ($this->get_to_date_newchg_loc() - $this->get_newchg_loc()) * $this->get_plan_newchg_loc();
   }

   function get_actual_injected($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["actual_injected_".$phase]))
         return $this->cached_values["actual_injected_".$phase];
      $list = $this->defect->get_actual_injected($this->get_id());
      $phases = $this->get_all_phases();
      foreach($phases as $p)
         if(isset($list[$p])) $this->cached_values["actual_injected_".$p] = $list[$p];
         else $this->cached_values["actual_injected_".$p] = 0;
      $this->cached_values["actual_injected_"] = $list["Total"];
      return $this->cached_values["actual_injected_".$phase];
   }

   function get_to_date_injected($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_injected_".$phase]))
         return $this->cached_values["to_date_injected_".$phase];
      $list = $this->defect->get_to_date_injected($this->get_id());
      $phases = $this->get_all_phases();
      foreach($phases as $p)
         if(isset($list[$p])) $this->cached_values["to_date_injected_".$p] = $list[$p];
         else $this->cached_values["to_date_injected_".$p] = 0;
      $this->cached_values["to_date_injected_"] = $list["Total"];
      return $this->cached_values["to_date_injected_".$phase];
   }

   function get_to_date_injected_percent($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_injected_percent_".$phase]))
         return $this->cached_values["to_date_injected_percent_".$phase];
      return $this->cached_values["to_date_injected_percent_".$phase] = 100 * $this->get_to_date_injected($phase) / $this->get_to_date_injected();
   }

   function get_plan_remove($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_remove_".$phase]))
         return $this->cached_values["plan_remove_".$phase];

      // if there is no previous program
      if($this->get_number() == 1) return $this->cached_values["plan_remove_".$phase] = 0;

      return $this->cached_values["plan_remove_".$phase] = ($this->get_to_date_removed($phase) - $this->get_actual_removed($phase)) / ($this->get_to_date_newchg_loc() - $this->get_newchg_loc()) * $this->get_plan_newchg_loc();
   }

   function get_actual_removed($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["actual_removed_".$phase]))
         return $this->cached_values["actual_removed_".$phase];
      $list = $this->defect->get_actual_removed($this->get_id());
      $phases = $this->get_all_phases();
      foreach($phases as $p)
         if(isset($list[$p])) $this->cached_values["actual_removed_".$p] = $list[$p];
         else $this->cached_values["actual_removed_".$p] = 0;
      $this->cached_values["actual_removed_"] = $list["Total"];
      return $this->cached_values["actual_removed_".$phase];
   }

   function get_to_date_removed($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_removed_".$phase]))
         return $this->cached_values["to_date_removed_".$phase];
      $list = $this->defect->get_to_date_removed($this->get_id());
      $phases = $this->get_all_phases();
      foreach($phases as $p)
         if(isset($list[$p])) $this->cached_values["to_date_removed_".$p] = $list[$p];
         else $this->cached_values["to_date_removed_".$p] = 0;
      $this->cached_values["to_date_removed_"] = $list["Total"];
      return $this->cached_values["to_date_removed_".$phase];
   }

   function get_to_date_removed_percent($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_removed_percent_".$phase]))
         return $this->cached_values["to_date_removed_percent_".$phase];
      return $this->cached_values["to_date_removed_percent_".$phase] = 100 * $this->get_to_date_removed($phase) / $this->get_to_date_removed();
   }


   function get_to_date_percent($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_percent_".$phase]))
         return $this->cached_values["to_date_percent_".$phase];
      return $this->cached_values["to_date_percent_".$phase] = 100 * $this->get_to_date_time($phase) / $this->get_to_date_time();
   }

   function get_to_date_percent_for_program($number, $phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_percent_for_program_".$number."_".$phase]))
         return $this->cached_values["to_date_percent_for_program_".$number."_".$phase];
      return $this->cached_values["to_date_percent_for_program_".$number."_".$phase] = 100 * $this->get_to_date_time_for_program($number, $phase) / $this->get_to_date_time_for_program($number);
   }

   function get_to_date_time($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_time_".$phase]))
         return $this->cached_values["to_date_time_".$phase];
      $list = $this->time->get_to_date_time($this->get_username(), $this->get_number());
      foreach(array_keys($list) as $k)
         if($k == "Total") $this->cached_values["to_date_time_"] = $list[$k];
         else $this->cached_values["to_date_time_".$k] = $list[$k];
      return $this->cached_values["to_date_time_".$phase];
   }

   function get_to_date_time_for_program($number, $phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_time_for_program_".$number."_".$phase]))
         return $this->cached_values["to_date_time_for_program_".$number."_".$phase];
      $list = $this->time->get_to_date_time($this->get_username(), $number);
      foreach(array_keys($list) as $k)
         if($k == "Total") $this->cached_values["to_date_time_for_program_".$number."_"] = $list[$k];
         else $this->cached_values["to_date_time_for_program_".$number."_".$k] = $list[$k];
      return $this->cached_values["to_date_time_for_program_".$number."_".$phase];
   }

   function get_actual_time($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["actual_time_".$phase]))
         return $this->cached_values["actual_time_".$phase];
      return $this->cached_values["actual_time_".$phase] = $this->time->get_actual_time($this->get_id(), $phase);
   }

   function get_level_name()
   {
if($this->using_cache)
      if(isset($this->cached_values["level_name"]))
         return $this->cached_values["level_name"];
      return $this->cached_values["level_name"] = $this->level_obj->get_level_name($this->get_level());
   }

   function get_object_category_sizes($type)
   {
if($this->using_cache)
      if(isset($this->cached_values["object_category_sizes_".$type]))
         return $this->cached_values["object_category_sizes_".$type];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $sql = "SELECT AVG(loc/methods) - 2 * STDDEV(loc/methods), AVG(loc/methods) - STDDEV(loc/methods), AVG(loc/methods), AVG(loc/methods) + STDDEV(loc/methods), AVG(loc/methods) + 2 * STDDEV(loc/methods) FROM object WHERE programid IN ( SELECt id FROM program WHERE username='".$this->get_username()."' AND number < ".$this->get_number().")";
      if($type) $sql .= " AND type='".$type."'";
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["object_category_sizes_".$type] = $row;
   }

   function &get_all_objects($new_base)
   {
if($this->using_cache)
      if(isset($this->cached_values["all_objects_".$new_base]))
         return $this->cached_values["all_objects_".$new_base];
      $list = $this->object->get_all_program_objects($this->get_id());
      $this->cached_values["all_objects_new"] = $list["new"];
      $this->cached_values["all_objects_base"] = $list["base"];
      return $this->cached_values["all_objects_".$new_base];
   }

   function get_object_category_sizes_ln($type)
   {
if($this->using_cache)
      if(isset($this->cached_values["object_category_sizes_ln_".$type]))
         return $this->cached_values["object_category_sizes_ln_".$type];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $sql = "SELECT EXP(AVG(LN(loc/methods)) - 2 * STDDEV(LN(loc/methods))), EXP(AVG(LN(loc/methods)) - STDDEV(LN(loc/methods))), EXP(AVG(LN(loc/methods))), EXP(AVG(LN(loc/methods)) + STDDEV(LN(loc/methods))), EXP(AVG(LN(loc/methods)) + 2 * STDDEV(LN(loc/methods))) FROM object WHERE programid IN ( SELECt id FROM program WHERE username='".$this->get_username()."' AND number < ".$this->get_number().")";
      if($type) $sql .= " AND type='".$type."'";
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["object_category_sizes_ln_".$type] = $row;
   }

   function get_programs_reusing_objects()
   {
if($this->using_cache)
      if(isset($this->cached_values["programs_reusing_objects"]))
         return $this->cached_values["programs_reusing_objects"];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT DISTINCT programid FROM reuse WHERE objectid IN ( SELECT id FROM object WHERE programid=".$this->get_id()." )");
      $row = $db->fetch_row($result);
      while($row)
      {
         $list[] = $row[0];
         $row = $db->next_row($result);
      }
      $db->close();
      return $this->cached_values["programs_reusing_objects"] = $list;
   }

   function get_plan_total_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_total_loc"]))
         return $this->cached_values["plan_total_loc"];
      return $this->cached_values["plan_total_loc"] = $this->get_plan_newchg_loc() + $this->get_est_base_loc() - $this->get_est_modified_loc() - $this->get_est_deleted_loc() + $this->get_total_plan_reused_loc();
   }

   function get_total_actual_reused_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["total_actual_reused_loc"]))
         return $this->cached_values["total_actual_reused_loc"];
      $total = 0;
      $objects = $this->get_all_reused_objects();
      foreach($objects as $o)
        $total += $o->get_actual_reused_loc();
      return $this->cached_values["total_actual_reused_loc"] = $total;
   }

   function get_total_plan_reused_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["total_plan_reused_loc"]))
         return $this->cached_values["total_plan_reused_loc"];
      return $this->cached_values["total_plan_reused_loc"] = $this->object->get_total_plan_reused_loc($this->get_id());
   }

   function get_actual_reused_loc($objectid)
   {
if($this->using_cache)
      if(isset($this->cached_values["actual_reused_loc_".$objectid]))
         return $this->cached_values["actual_reused_loc_".$objectid];
      return $this->cached_values["actual_reused_loc_".$objectid] = $this->object->get_actual_reused_loc($this->get_id(), $objectid);
   }

   function delete_reuse($objectid)
   {
      unset($this->cached_values);
      $this->object->delete_reuse($this->get_id(), $objectid);
      $this->chached_values["reused_loc"] = $this->get_total_actual_reused_loc();
      $this->set_reused_loc($this->get_reused_loc());
   }

   function delete_all_reuse()
   {
      unset($this->cached_values);
      $this->object->delete_all_reuse($this->get_id());
      $this->cached_values["reused_loc"] = $this->get_total_actual_reused_loc();
      $this->set_reused_loc($this->get_reused_loc());
   }

   function update_reuse_object($objectid, $loc)
   {
      unset($this->cached_values);
      $this->object->update_reuse($this->get_id(), $objectid, $loc);
      $this->cached_values["reused_loc"] = $this->get_total_actual_reused_loc();
      $this->set_reused_loc($this->get_reused_loc());
   }

   function reuse_object($objectid, $loc)
   {
      unset($this->cached_values);
      $this->object->reuse($this->get_id(), $objectid, $loc);
      $this->cached_values["reused_loc"] = $this->get_total_actual_reused_loc();
      $this->set_reused_loc($this->get_reused_loc());
   }

   function get_all_reused_objects()
   {
if($this->using_cache)
      if(isset($this->cached_values["all_reused_objects"]))
         return $this->cached_values["all_reused_objects"];
      return $this->cached_values["all_reused_objects"] = $this->object->get_all_reused_objects($this->get_id());
   }

   function get_all_reusable_objects()
   {
if($this->using_cache)
      if(isset($this->cached_values["all_reusable_objects"]))
         return $this->cached_values["all_reusable_objects"];
      return $this->cached_values["all_reusable_objects"] = $this->object->get_all_reusable_objects($this->get_username(), $this->get_id(), $this->get_number());
   }

   function get_all_tasks()
   {
if($this->using_cache)
      if(isset($this->cached_values["all_tasks"]))
         return $this->cached_values["all_tasks"];
      $tasks = $this->task->get_all_program_tasks($this->get_id());
      for($x = 0 ; $x < sizeof($tasks) ; $x++)
      {
         if($this->get_plan_time() != 0)
            $tasks[$x]->planned_value = $tasks[$x]->minutes/$this->get_plan_time()*100;
         else
            $tasks[$x]->planned_value = 0;
         $tasks[$x]->cumulative_planned_value = $tasks[$x]->planned_value + $tasks[$x - 1]->cumulative_planned_value;
         $tasks[$x]->cumulative_minutes = $tasks[$x]->minutes + $tasks[$x - 1]->cumulative_minutes;

         $phase_count[$tasks[$x]->name]++;
         if($this->time->get_actual_date($this->get_id(), $tasks[$x]->name, $phase_count[$tasks[$x]->name]))
         {
            $tasks[$x]->actual_date = $this->time->get_actual_date($this->get_id(), $tasks[$x]->name, $phase_count[$tasks[$x]->name]);
            $tasks[$x]->earned_value = $tasks[$x]->planned_value;
            $tasks[$x]->cumulative_earned_value = $tasks[$x]->earned_value + $tasks[$x - 1]->cumulative_earned_value;
         }
      }
      return $this->cached_values["all_tasks"] = $tasks;
   }

   function get_all_schedule_tasks()
   {
if($this->using_cache)
      if(isset($this->cached_values["all_schedule_tasks"]))
         return $this->cached_values["all_schedule_tasks"];
      $sched_tasks = $this->task->get_all_program_schedule_tasks($this->get_id());
      $tasks = $this->get_all_tasks();

      foreach($tasks as $t)
      {
         $found = 0;
         for($x = 0 ; $x < sizeof($sched_tasks) ; $x++)
         {
            if($sched_tasks[$x]->plan_date == $t->actual_date)
            {
               $sched_tasks[$x]->earned_value += $t->earned_value;
               $found = 1;
            }
         }
         if(!$found && $t->actual_date)
         {
            $s = new Task();
            $s->plan_date = $t->actual_date;
            $s->earned_value += $t->earned_value;
            $s->number = sizeof($sched_tasks) + 1;
            $sched_tasks[] = $s;
         }
      }

      for($x = 0 ; $x < sizeof($sched_tasks) ; $x++) 
      {
         $sched_tasks[$x]->cumulative_earned_value = $sched_tasks[$x]->earned_value + $sched_tasks[$x - 1]->cumulative_earned_value;
         $sched_tasks[$x]->actual_minutes = $this->time->get_total_time_for_date($this->get_id(), $sched_tasks[$x]->plan_date);
         $sched_tasks[$x]->cumulative_actual_minutes = $sched_tasks[$x]->actual_minutes + $sched_tasks[$x - 1]->cumulative_actual_minutes;
         if($this->get_plan_time() != 0)
            $sched_tasks[$x]->cumulative_planned_value = $sched_tasks[$x]->minutes/$this->get_plan_time()*100 + $sched_tasks[$x - 1]->cumulative_planned_value;
         else
            $sched_tasks[$x]->cumulative_planned_value = 0;
      }

      return $this->cached_values["all_schedule_tasks"] = $sched_tasks;
   }

   function get_plan_time($phase)
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_time_".$phase]))
         return $this->cached_values["plan_time_".$phase];

      // if phase is not set, just return plan_time
      if(!$phase) return $this->cached_values["plan_time_".$phase] = $this->get_db_value("plan_time");

      $phases = $this->get_all_phases();

      // if there is no history
      if($this->get_to_date_percent_for_program($this->get_number() - 1) == 0) return $this->cached_values["plan_time_".$phase] = $this->get_plan_time() / sizeof($phases);

      $new_phases = $this->get_new_phases();

      // if there are not new phases
      if(sizeof($new_phases) == 0)
        return $this->cached_values["plan_time_".$phase] = $this->get_plan_time() * $this->get_to_date_percent_for_program($this->get_number() - 1, $phase)/100;

      // there are new phases
      // find the median value
      foreach($phases as $p)
         if(!in_array($p, $new_phases)) $percents[] = $this->get_to_date_percent_for_program($this->get_number() - 1, $p);
      sort($percents);
      if (sizeof($percents) % 2) $median = $percents[floor(sizeof($percents)/2)]; 
      else $median = ($percents[sizeof($percents)/2] + $percents[sizeof($percents)/2 - 1]) / 2; 

      // adjust meadian for new number of phases
      $median = $median * (sizeof($phases) - sizeof($new_phases)) / sizeof($phases);

      // if this phase is a new phase
      if(in_array($phase, $new_phases)) return $this->cached_values["plan_time_".$phase] = $this->get_plan_time() * $median / 100;

      return $this->cached_values["plan_time_".$phase] = ($this->get_plan_time() * (1 - sizeof($new_phases) * $median / 100)) * $this->get_to_date_percent_for_program($this->get_number() - 1, $phase)/100;
   }

   function get_new_phases()
   {
if($this->using_cache)
      if(isset($this->cached_values["new_phases"]))
         return $this->cached_values["new_phases"];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT name FROM phase WHERE programid=".$this->get_id()." AND name NOT IN ( SELECT DISTINCT name FROM phase WHERE programid IN (SELECT id FROM program WHERE username='".$this->get_username()."' AND number < ".$this->get_number()." ) )");
      $row = $db->fetch_row($result);
      $list = array();
      while($row)
      {
         $list[] = $row[0];
         $row = $db->next_row($result);
      }
      $db->close();
      $this->cached_values["new_phases"] = $list;
      return $this->cached_values["new_phases"] = $list;
   }

   function get_to_date_plan_time()
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_plan_time"]))
         return $this->cached_values["to_date_plan_time"];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT sum(plan_time) FROM program WHERE username='".$this->get_username()."' AND number <= ".$this->get_number());
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return $this->cached_values["to_date_plan_time"] = 0;
      return $this->cached_values["to_date_plan_time"] = $row[0];
   }

   function get_newchg_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["newchg_loc"]))
         return $this->cached_values["newchg_loc"];
      return $this->cached_values["newchg_loc"] = $this->get_total_loc() - $this->get_base_loc() + $this->get_deleted_loc() - $this->get_reused_loc() + $this->get_modified_loc();
   }

   function get_to_date_newchg_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_newchg_loc"]))
         return $this->cached_values["to_date_newchg_loc"];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT sum(total_loc) - sum(base_loc) + sum(deleted_loc) - sum(reused_loc) + sum(modified_loc) FROM program WHERE username='".$this->get_username()."' AND number <= ".$this->get_number());
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return $this->cached_values["to_date_newchg_loc"] = 0;
      return $this->cached_values["to_date_newchg_loc"] = $row[0];
   }
   
   function get_added_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["added_loc"]))
         return $this->cached_values["added_loc"];
      return $this->cached_values["added_loc"] = $this->get_total_loc() - $this->get_base_loc() + $this->get_deleted_loc() - $this->get_reused_loc();
   }

   function get_plan_loc_per_hour()
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_loc_per_hour"]))
         return $this->cached_values["plan_loc_per_hour"];
      if($this->get_plan_time() == 0) return $this->cached_values["plan_loc_per_hour"] = "-";

      return $this->cached_values["plan_loc_per_hour"] = $this->get_plan_newchg_loc()*60/$this->get_plan_time();
   }

   function get_loc_per_hour()
   {
if($this->using_cache)
      if(isset($this->cached_values["loc_per_hour"]))
         return $this->cached_values["loc_per_hour"];
      if($this->get_actual_time() == 0) return $this->cached_values["loc_per_hour"] = "-";
      return $this->cached_values["loc_per_hour"] = ($this->get_total_loc() - $this->get_base_loc() + $this->get_deleted_loc() - $this->get_reused_loc() + $this->get_modified_loc())*60/$this->get_actual_time();
   }

   function get_to_date_loc_per_hour()
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_loc_per_hour"]))
         return $this->cached_values["to_date_loc_per_hour"];
      if(!$this->get_to_date_time()) return $this->cached_values["to_date_loc_per_hour"] = "-";
      return $this->cached_values["to_date_loc_per_hour"] = ($this->get_to_date_newchg_loc() * 60 / $this->get_to_date_time());
   }

   function get_total_new_base($new_base)
   {
if($this->using_cache)
      if(isset($this->cached_values["total_new_base_".$new_base]))
         return $this->cached_values["total_new_base_".$new_base];
      $total = 0;
      $objects = $this->get_all_objects($new_base);
      foreach($objects as $o)
        $total += $o->get_loc();
      return $this->cached_values["total_new_base_".$new_base] = $total;
   }

   function get_plan_total_new_base($new_base)
   {
if($this->using_cache)
      if(isset($this->cached_values["plan_total_new_base_".$new_base]))
         return $this->cached_values["plan_total_new_base_".$new_base];
      if(!isset($this->cached_values["all_objects_".$new_base]))
         return $this->cached_values["plan_total_new_base_".$new_base] = $this->object->get_plan_total_new_base($this->get_username(), $this->get_id(), $new_base, $this->get_number()); 
      $total = 0;
      foreach($this->cached_values["all_objects_".$new_base] as $o)
         $total += $o->get_est_loc();
      return $total;
   }

   function get_total_new_reuse()
   {
if($this->using_cache)
      if(isset($this->cached_values["total_new_reuse"]))
         return $this->cached_values["total_new_reuse"];
      $total = 0;
      $objects = $this->get_all_objects("new");
      foreach($objects as $o)
         if($o->get_reuse() == 1)
           $total += $o->get_loc();
      return $this->cached_values["total_new_reuse"] = $total;
   }

   function get_est_total_new_reuse()
   {
if($this->using_cache)
      if(isset($this->cached_values["est_total_new_reuse"]))
         return $this->cached_values["est_total_new_reuse"];
      $total = 0;
      $objects = $this->get_all_objects("new");
      foreach($objects as $o)
         if($o->get_reuse() == 1)
           $total += $o->get_est_loc();
      return $this->cached_values["est_total_new_reuse"] = $total;
   }

   function get_name($id)
   {
      if(!$id)
      {
if($this->using_cache)
         if(isset($this->cached_values["name"]))
            return $this->cached_values["name"];
         return $this->get_db_value("name");
      }
if($this->using_cache)
      if(isset($this->cached_values["name_".$id]))
         return $this->cached_values["name_".$id];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT name FROM program WHERE id=".$id);
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["name_".$id] = $row[0];
   }

   function get_to_date_new_reuse()
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_new_reuse"]))
         return $this->cached_values["to_date_new_reuse"];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT SUM(loc) FROM object WHERE new_base='new' AND reuse=1 AND programid IN ( SELECT id FROM program WHERE username='".$this->get_username()."' AND number<=".$this->get_number()." )");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["to_date_new_reuse"] = $row[0];
   }
   
   function get_to_date_total_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_total_loc"]))
         return $this->cached_values["to_date_total_loc"];
      $sql = "SELECT SUM(total_loc) FROM program WHERE username='".$this->get_username()."' AND program.number <= ".$this->get_number();
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return $this->cached_values["to_date_total_loc"] = 0;
      return $this->cached_values["to_date_total_loc"] = $row[0];
   }

   function get_to_date_reused_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["to_date_reused_loc"]))
         return $this->cached_values["to_date_reused_loc"];
      $sql = "SELECT SUM(reused_loc) FROM program WHERE username='".$this->get_username()."' AND program.number <= ".$this->get_number();
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return $this->cached_values["to_date_reused_loc"] = 0;
      return $this->cached_values["to_date_reused_loc"] = $row[0];
   }

   function set_plan_newchg_loc($loc)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET plan_newchg_loc='".$loc."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT plan_newchg_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["plan_newchg_loc"] = $row[0];
   }

   function set_reused_loc($loc)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET reused_loc='".$loc."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT reused_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["reused_loc"] = $row[0];
   }

   function set_est_modified_loc($loc)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET est_modified_loc='".$loc."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT est_modified_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["est_modified_loc"] = $row[0];
   }

   function set_modified_loc($loc)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET modified_loc='".$loc."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT modified_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["modified_loc"] = $row[0];
   }

   function set_deleted_loc($loc)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET deleted_loc='".$loc."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT deleted_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["deleted_loc"] = $row[0];
   }

   function set_est_deleted_loc($loc)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET est_deleted_loc='".$loc."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT est_deleted_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["est_deleted_loc"] = $row[0];
   }

   function set_base_loc($loc)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET base_loc='".$loc."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT base_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["base_loc"] = $row[0];
   }

   function set_est_base_loc($loc)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET est_base_loc='".$loc."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT est_base_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["est_base_loc"] = $row[0];
   }

   function set_total_loc($loc)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET total_loc='".$loc."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT total_loc FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["total_loc"] = $row[0];
   }

   function set_plan_time($time)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE program SET plan_time='".$time."' WHERE id='".$this->get_id()."'");
      $result = $db->run_query("SELECT plan_time FROM program WHERE id='".$this->get_id()."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["plan_time_"] = $row[0];
   }

   function exists($username, $name)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT id FROM program WHERE username='".$username."' AND name='".$name."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $row[0];
   }

   function create($username, $name, $level)
   {
      unset($this->cached_values);
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT MAX(number) FROM program WHERE username='".$username."'");
      $row = $db->fetch_row($result);
      $number = $row[0] + 1;
      $result = $db->run_query("INSERT INTO program ( level, username, name, number, probe_method_loc, probe_method_time ) VALUES ( ".$level.", '".$username."', '".$name."', ".$number.", 'D', 'D')");
      $row = $db->insert_id();
      $db->close();
      $this->phase->create_program_phases($row, $level);
      return $row;
   }

   function delete($id)
   {
      unset($this->cached_values);
      // delete this program

      // delete time log for this program
      $this->time->delete_all_for_program($id);

      // delete defect log for this program
      $this->defect->delete_all_for_program($id);

      // delete all objects for this program
      $this->object->delete_all_for_program($id);

      // delete all phases for this program
      $this->phase->delete_all_for_program($id);

      $this->delete_all_reuse();

      // we need to get the program we are going to delete so we can get the username
      $program = new Program();
      $program = $program->get_program($id);

      // connect to the database
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      // delete program
      $result = $db->run_query("DELETE FROM program WHERE id = '".$id."'");

      // select id for all of this user's programs in number order, we will renumber them
      $result = $db->run_query("SELECT id FROM program WHERE username = '".$program->username."' ORDER BY number");
      $row = $db->fetch_row($result);
      for($x = 1 ; $row ; $x++)
      {
         // the current program is now number x
         $db->run_query("UPDATE program SET number=".$x." WHERE id=".$row[0]);
         $row = $db->next_row($result);
      }

      $db->close();
   }

   function get_program($id)
   {
if($this->using_cache)
      if(isset($this->cached_values["program_".$id]))
         return $this->cached_values["program_".$id];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT * FROM program WHERE id='".$id."'");
      $row = $db->fetch_row($result);
      $p = new Program();
      if($row)
      {
         $p->id = $row[0];
         $p->cached_values["level"] = $row[1];
         $p->cached_values["username"] = $row[2];
         $p->cached_values["name"] = $row[3];
         $p->cached_values["number"] = $row[4];
         $p->cached_values["plan_time_"] = $row[5];
         $p->cached_values["total_loc"] = $row[6];
         $p->cached_values["base_loc"] = $row[7];
         $p->cached_values["est_base_loc"] = $row[8];
         $p->cached_values["deleted_loc"] = $row[9];
         $p->cached_values["est_deleted_loc"] = $row[10];
         $p->cached_values["modified_loc"] = $row[11];
         $p->cached_values["est_modified_loc"] = $row[12];
         $p->cached_values["reused_loc"] = $row[13];
         $p->cached_values["plan_newchg_loc"] = $row[14];
         $p->cached_values["category_groups"] = $row[15];
         $p->cached_values["probe_method_loc"] = $row[16];
         $p->cached_values["probe_method_time"] = $row[17];
         $p->cached_values["range_size"] = $row[18];
         $p->cached_values["range_time"] = $row[19];
      }
      $db->close();
      return $this->cached_values["program_".$id] = $p;
   }

   function get_all_user_programs($username)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT * FROM program where username='".$username."' ORDER BY number DESC");
      $row = $db->fetch_row($result);
      while($row)
      {
         $p = new Program();
         $p->id = $row[0];
         $p->cached_values["level"] = $row[1];
         $p->cached_values["username"] = $row[2];
         $p->cached_values["name"] = $row[3];
         $p->cached_values["number"] = $row[4];
         $p->cached_values["plan_time_"] = $row[5];
         $p->cached_values["total_loc"] = $row[6];
         $p->cached_values["base_loc"] = $row[7];
         $p->cached_values["est_base_loc"] = $row[8];
         $p->cached_values["deleted_loc"] = $row[9];
         $p->cached_values["est_deleted_loc"] = $row[10];
         $p->cached_values["modified_loc"] = $row[11];
         $p->cached_values["est_modified_loc"] = $row[12];
         $p->cached_values["reused_loc"] = $row[13];
         $p->cached_values["plan_newchg_loc"] = $row[14];
         $p->cached_values["category_groups"] = $row[15];
         $p->cached_values["probe_method_loc"] = $row[16];
         $p->cached_values["probe_method_time"] = $row[17];
         $p->cached_values["range_size"] = $row[18];
         $p->cached_values["range_time"] = $row[19];
         $list[] = $p;
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }
}//Program
?>
