<?php

require_once "DBConnection.php";

class Level {
   var $id;
   var $cached_values;

   function Level()
   {
   }

   function get_level_name($id)
   {
      if(isset($this->cached_values["level_name_".$id]))
         return $this->cached_values["level_name_".$id];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT * FROM level");
      $row = $db->fetch_row($result);
      while($row)
      {
         $this->cached_values["level_name_".$row[0]] = $row[1];
         $this->cached_values["levels"][$row[0]] = $row[1];
         $row = $db->next_row($result);
      }
      $db->close();
      return $this->cached_values["level_name_".$id];
   }

   function get_levels()
   {
      if(isset($this->cached_values["levels"]))
         return $this->cached_values["levels"];
      $db = new DBConnection() or die('There was an error connecting to the database.');
      $db->connect();
      $result = $db->run_query("SELECT * FROM level");
      $row = $db->fetch_row($result);
      while($row)
      {
         $this->cached_values["level_name_".$row[0]] = $row[1];
         $this->cached_values["levels"][$row[0]] = $row[1];
         $row = $db->next_row($result);
      }
      $db->close();
      return $this->cached_values["levels"];
   }
}//Level
?>
