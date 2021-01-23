<?php

require_once "DBConnection.php";

class Object {
   var $id;

   var $cached_values;

   function Object()
   {
$this->using_cache = 1;
   }

   function get_id()
   {
      return $this->id;
   }

   function get_db_value($v)
   {
      $this = $this->get_object($this->get_id());
      return $this->cached_values[$v];
   }

   function get_programid()
   {
if($this->using_cache)
      if(isset($this->cached_values["programid"]))
         return $this->cached_values["programid"];
      return $this->get_db_value("programid");
   }

   function get_name($id)
   {
      if(isset($id))
      {
         $db = new DBConnection() or die('There was an error connecting to the database.');
         $db->connect();
         $result = $db->run_query("SELECT name FROM object WHERE id=".$id);
         $row = $db->fetch_row($result);
         $db->close();
         return $row[0];
      }
if($this->using_cache)
      if(isset($this->cached_values["name"]))
         return $this->cached_values["name"];
      return $this->get_db_value("name");
   }

   function get_type()
   {
if($this->using_cache)
      if(isset($this->cached_values["type"]))
         return $this->cached_values["type"];
      return $this->get_db_value("type");
   }

   function get_methods()
   {
if($this->using_cache)
      if(isset($this->cached_values["methods"]))
         return $this->cached_values["methods"];
      return $this->get_db_value("methods");
   }

   function get_rel_size()
   {
if($this->using_cache)
      if(isset($this->cached_values["rel_size"]))
         return $this->cached_values["rel_size"];
      return $this->get_db_value("rel_size");
   }

   function get_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["loc"]))
         return $this->cached_values["loc"];
      return $this->get_db_value("loc");
   }

   function get_reuse()
   {
if($this->using_cache)
      if(isset($this->cached_values["reuse"]))
         return $this->cached_values["reuse"];
      return $this->get_db_value("reuse");
   }

   function get_new_base()
   {
if($this->using_cache)
      if(isset($this->cached_values["new_base"]))
         return $this->cached_values["new_base"];
      return $this->get_db_value("new_base");
   }

   function get_username()
   {
if($this->using_cache)
      if(isset($this->cached_values["username"]))
         return $this->cached_values["username"];
      $this = $this->get_object($this->get_id());
      return $this->cached_values["username"];
   }

   function get_program_number()
   {
if($this->using_cache)
      if(isset($this->cached_values["program_number"]))
         return $this->cached_values["program_number"];
      $this = $this->get_object($this->get_id());
      return $this->cached_values["program_number"];
   }

   function get_program_name()
   {
if($this->using_cache)
      if(isset($this->cached_values["program_name"]))
         return $this->cached_values["program_name"];
      $this = $this->get_object($this->get_id());
      return $this->cached_values["program_name"];
   }


   function get_est_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["est_loc"]))
         return $this->cached_values["est_loc"];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $row = $db->fetch_row($result);
      $sql = "SELECT ".$this->get_methods()." * (";
      if($this->get_rel_size() == "V. Small")
         $sql .= "avg(loc/methods) - 2 * stddev(loc/methods) ";
      else if($this->get_rel_size() == "Small")
         $sql .= "avg(loc/methods) - stddev(loc/methods) ";
      else if($this->get_rel_size() == "Medium")
         $sql .= "avg(loc/methods) ";
      else if($this->get_rel_size() == "Large")
         $sql .= "avg(loc/methods) + stddev(loc/methods) ";
      else if($this->get_rel_size() == "V. Large")
         $sql .= "avg(loc/methods) + 2 * stddev(loc/methods) ";
      $sql .= ") FROM object WHERE programid IN ( SELECT id FROM program WHERE username='".$this->get_username()."' AND number < ".$this->get_program_number().")"; 
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);

      // if the result is < 0, use logarithm for calculation
      if($row[0] < $this->get_methods())
      {
         $sql = "SELECT ".$this->get_methods()." * (";
         if($this->get_rel_size() == "V. Small")
            $sql .= "exp(avg(ln(loc/methods)) - 2 * stddev(ln(loc/methods))) ";
         else if($this->get_rel_size() == "Small")
            $sql .= "exp(avg(ln(loc/methods)) - stddev(ln(loc/methods))) ";
         else if($this->get_rel_size() == "Medium")
            $sql .= "exp(avg(ln(loc/methods))) ";
         else if($this->get_rel_size() == "Large")
            $sql .= "exp(avg(ln(loc/methods)) + stddev(ln(loc/methods))) ";
         else if($this->get_rel_size() == "V. Large")
            $sql .= "exp(avg(ln(loc/methods)) + 2 * stddev(ln(loc/methods))) ";
         $sql .= ") FROM object WHERE programid IN ( SELECT id FROM program WHERE username='".$username."' AND number < ".$prog_num.")"; 
         $result = $db->run_query($sql);
         $row = $db->fetch_row($result);
      }
      $db->close();
      $this->cached_values["est_loc"] = $row[0];
      return $this->cached_values["est_loc"] = $row[0];
   }

   function get_programs_reusing($objectid)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT programid FROM reuse WHERE objectid=".$objectid);
      $row = $db->fetch_row($result);
      while($row)
      {
         $list[] = $row[0];
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }

   function get_actual_reused_loc()
   {
if($this->using_cache)
      if(isset($this->cached_values["actual_reused_loc"]))
         return $this->cached_values["actual_reused_loc"];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT actual_loc FROM reuse WHERE programid=".$this->get_programid()." AND objectid=".$this->get_id());
      $row = $db->fetch_row($result);
      $db->close();
      return $this->cached_values["actual_reused_loc"] = $row[0];
   }

   function get_total_plan_reused_loc($prog)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT SUM(loc) FROM object WHERE id IN ( SELECT objectid FROM reuse WHERE programid=".$prog.")");
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return 0;
      return $row[0];
   }

   function get_total_actual_reused_loc($prog)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT SUM(actual_loc) FROM reuse WHERE programid=".$prog);
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return 0;
      return $row[0];
   }

   function update_reuse($prog, $object, $loc)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE reuse SET actual_loc=".$loc." WHERE programid=".$prog." AND objectid=".$object);
      $db->close();
   }

   function reuse($prog, $object, $loc)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      if($loc)
         $result = $db->run_query("INSERT INTO reuse ( programid, objectid, actual_loc ) VALUES ( ".$prog.", ".$object.", ".$loc." )");
      else
         $result = $db->run_query("INSERT INTO reuse ( programid, objectid, actual_loc ) VALUES ( ".$prog.", ".$object." )");
      $db->close();
   }

   function delete_reuse($prog, $object)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("DELETE FROM reuse WHERE programid=".$prog." AND objectid=".$object);
      $db->close();
   }

   function delete_all_reuse($prog)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("DELETE FROM reuse WHERE programid=".$prog);
      $db->close();
   }

   function get_all_reused_objects($prog)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT object.id, object.programid, object.name, object.type, object.methods, object.rel_size, object.loc, object.reuse, object.new_base, program.username, program.number, program.name, reuse.actual_loc FROM object, program, reuse WHERE object.id=reuse.objectid AND object.programid=program.id AND reuse.programid=".$prog." ORDER BY object.programid, object.name");

      $row = $db->fetch_row($result);
      while($row)
      {
         $o = new Object();
         $o->id = $row[0];
         $o->cached_values["programid"] = $row[1];
         $o->cached_values["name"] = $row[2];
         $o->cached_values["type"] = $row[3];
         $o->cached_values["methods"] = $row[4];
         $o->cached_values["rel_size"] = $row[5];
         $o->cached_values["loc"] = $row[6];
         $o->cached_values["reuse"] = $row[7];
         $o->cached_values["new_base"] = $row[8];
         $o->cached_values["username"] = $row[9];
         $o->cached_values["program_number"] = $row[10];
         $o->cached_values["program_name"] = $row[11];
         $o->cached_values["actual_reused_loc"] = $row[12];
         $list[] = $o;
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }

   function get_all_reusable_objects($user, $prog, $number)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $sql = "SELECT object.id, object.programid, object.name, object.type, object.methods, object.rel_size, object.loc, object.reuse, object.new_base, program.username, program.number, program.name FROM object, program WHERE object.reuse=1 AND object.programid=program.id AND program.id in ";
      $sql .= " ( select id from program WHERE username='".$user."' AND number < ".$number." )";
      $sql .= " AND object.id NOT IN ( SELECT objectid FROM reuse WHERE programid = ".$prog." ) ORDER BY programid, object.name";
      $result = $db->run_query($sql);
      $row = $db->fetch_row($result);
      while($row)
      {
         $o = new Object();
         $o->id = $row[0];
         $o->cached_values["programid"] = $row[1];
         $o->cached_values["name"] = $row[2];
         $o->cached_values["type"] = $row[3];
         $o->cached_values["methods"] = $row[4];
         $o->cached_values["rel_size"] = $row[5];
         $o->cached_values["loc"] = $row[6];
         $o->cached_values["reuse"] = $row[7];
         $o->cached_values["new_base"] = $row[8];
         $o->cached_values["username"] = $row[9];
         $o->cached_values["program_number"] = $row[10];
         $o->cached_values["program_name"] = $row[11];
         $list[] = $o;
         $row = $db->next_row($result);
      }
      $db->close();
      return $list;
   }

   function get_total_new_base($prog, $new_base)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT sum(loc) FROM object WHERE new_base='".$new_base."' AND programid='".$prog."'");
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return 0;
      return $row[0];
   }

   function get_plan_total_new_base($username, $prog, $new_base, $number)
   {
      $total = 0;
      $temp_obj = new Object();
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT id FROM object WHERE new_base='".$new_base."' AND programid='".$prog."'");
      $row = $db->fetch_row($result);
      while($row)
      {
         $temp_obj = $temp_obj->get_object($row[0]);
         $total += $temp_obj->get_est_loc($username, $number);
         $row = $db->next_row($result);
      }
      $db->close();
      return $total;
   }

   function get_est_total_new_reuse($username, $prog, $number)
   {
      $total = 0;
      $temp_obj = new Object();
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT id FROM object WHERE new_base='new' AND reuse=1 AND programid='".$prog."'");
      $row = $db->fetch_row($result);
      while($row)
      {
         $temp_obj = $temp_obj->get_object($row[0]);
         $total += $temp_obj->get_est_loc($username, $number);
         $row = $db->next_row($result);
      }
      $db->close();
      return $total;
   }

   function get_total_new_reuse($prog)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT sum(loc) FROM object WHERE new_base='new' AND reuse=1 AND programid='".$prog."'");
      $row = $db->fetch_row($result);
      $db->close();
      if(!$row[0]) return 0;
      return $row[0];
   }

   function exists($name, $prog)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT id FROM object WHERE name='".$name."' AND programid='".$prog."'");
      $row = $db->fetch_row($result);
      $db->close();
      return $row[0];
   }

   function create_row($p, $n, $t, $m, $rs, $l, $r, $nb)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("INSERT INTO object ( programid, name, type, methods, rel_size, loc, reuse, new_base ) VALUES ( '".$p."', '".$n."', '".$t."', '".$m."', '".$rs."', '".$l."', '".$r."', '".$nb."')");
      $row = $db->insert_id();
      $db->close();
      return $row;
   }

   function update_row($id, $n, $t, $m, $rs, $l, $r)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("UPDATE object set name='".$n."', type='".$t."', methods='".$m."', rel_size='".$rs."', loc='".$l."', reuse='".$r."' WHERE id=".$id); 
      $db->close();
      return $this->get_object($id);
   }

   function delete_row($id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("DELETE FROM object WHERE id='".$id."'");
      $db->close();
   }

   function delete_all_for_program($program_id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("DELETE FROM object WHERE programid='".$program_id."'");
      $db->close();
   }

   function get_object($id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT object.id, object.programid, object.name, object.type, object.methods, object.rel_size, object.loc, object.reuse, object.new_base, program.username, program.number, program.name FROM object, program WHERE object.programid=program.id AND object.id=".$id);
      $row = $db->fetch_row($result);
      $o = new Object();
      $o->id = $row[0];
      $o->cached_values["programid"] = $row[1];
      $o->cached_values["name"] = $row[2];
      $o->cached_values["type"] = $row[3];
      $o->cached_values["methods"] = $row[4];
      $o->cached_values["rel_size"] = $row[5];
      $o->cached_values["loc"] = $row[6];
      $o->cached_values["reuse"] = $row[7];
      $o->cached_values["new_base"] = $row[8];
      $o->cached_values["username"] = $row[9];
      $o->cached_values["program_number"] = $row[10];
      $o->cached_values["program_name"] = $row[11];
      $db->close();
      return $o;
   }

   function get_all_program_objects($program_id)
   {
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();

      $result = $db->run_query("SELECT object.id, object.programid, object.name, object.type, object.methods, object.rel_size, object.loc, object.reuse, object.new_base, program.username, program.number, program.name FROM object, program WHERE object.programid=".$program_id." AND program.id=".$program_id." ORDER BY object.name");
      $row = $db->fetch_row($result);
      $result2 = $db->run_query("SELECT avg(loc/methods) - 2 * stddev(loc/methods), avg(loc/methods) - stddev(loc/methods), avg(loc/methods), avg(loc/methods) + stddev(loc/methods), avg(loc/methods) + 2 * stddev(loc/methods), exp(avg(ln(loc/methods)) - 2 * stddev(ln(loc/methods))), exp(avg(ln(loc/methods)) - stddev(ln(loc/methods))), exp(avg(ln(loc/methods))), exp(avg(ln(loc/methods)) + stddev(ln(loc/methods))), exp(avg(ln(loc/methods)) + 2 * stddev(ln(loc/methods))) FROM object WHERE programid IN ( SELECT id FROM program WHERE username=( SELECT username FROM program WHERE id=".$program_id." ) AND number < ( SELECT number FROM program WHERE id=".$program_id."))");
      $row2 = $db->fetch_row($result2);
      while($row)
      {
         $o = new Object();
         $o->id = $row[0];
         $o->cached_values["programid"] = $row[1];
         $o->cached_values["name"] = $row[2];
         $o->cached_values["type"] = $row[3];
         $o->cached_values["methods"] = $row[4];
         $o->cached_values["rel_size"] = $row[5];
         $o->cached_values["loc"] = $row[6];
         $o->cached_values["reuse"] = $row[7];
         $o->cached_values["new_base"] = $row[8];
         $o->cached_values["username"] = $row[9];
         $o->cached_values["program_number"] = $row[10];
         $o->cached_values["program_name"] = $row[11];
         if($row[5] == "V. Small")
            $o->cached_values["est_loc"] = $row[4] * $row2[0];
         if($row[5] == "Small")
            $o->cached_values["est_loc"] = $row[4] * $row2[1];
         if($row[5] == "Medium")
            $o->cached_values["est_loc"] = $row[4] * $row2[2];
         if($row[5] == "Large")
            $o->cached_values["est_loc"] = $row[4] * $row2[3];
         if($row[5] == "V. Large")
            $o->cached_values["est_loc"] = $row[4] * $row2[4];
         // objects from psp0 and psp0.1 may not have a rel_size
         if($row[5] && $o->cached_values["est_loc"] <= 1)
         {
            if($row[5] == "V. Small")
               $o->cached_values["est_loc"] = $row[4] * $row2[5];
            if($row[5] == "Small")
               $o->cached_values["est_loc"] = $row[4] * $row2[6];
            if($row[5] == "Medium")
               $o->cached_values["est_loc"] = $row[4] * $row2[7];
            if($row[5] == "Large")
               $o->cached_values["est_loc"] = $row[4] * $row2[8];
            if($row[5] == "V. Large")
               $o->cached_values["est_loc"] = $row[4] * $row2[9];
         }
         $list[$row[8]][] = $o;
         $row = $db->next_row($result);
      }
      $db->close();
      if(!$list["new"]) $list["new"] = array();
      if(!$list["base"]) $list["base"] = array();
      return $list;
   }

} // Object
?>
