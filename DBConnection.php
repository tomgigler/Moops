<?php 
class DBConnection {
   var $user_name;
   var $password;
   var $database_name;
   var $result;
   var $connection;
   var $output;
   var $db;

   function DBConnection(){

      $this->user_name = "moops";
      $this->password = "moopsy";
      $this->database_name = "moops";

   }//DBConnection

   function connect(){
      $this->connection = mysql_pconnect("localhost", $this->user_name, $this->password);
      return $this->connection;
   }//connect

   function set_query($SQL) {
      $SQL = ereg_replace("table", "table if not exists", $SQL);
      $result = @mysql_db_query($this->database_name, $SQL, $this->connection);
      unset ($SQL);
      return $result;
   }//set_query

   function run_query($SQL) {
//print "<debug>$SQL</debug>\n";
$_SESSION['sql_count']++;
      $result = mysql_db_query($this->database_name, $SQL, $this->connection);
      unset ($SQL);
      return $result;
   }//set_query

   function insert_id() {
      return mysql_insert_id();
   }

   function fetch_row($result){
      $output = @mysql_fetch_row($result);
      unset($result);
      return $output;
   }//fetch_row

   function next_row($result){
      $output = @mysql_fetch_row($result);
      unset($result);
      return $output;
   }//next_row

   function num_rows($result){
      $output = @mysql_num_rows($result);
      return $output;
   }//num_row

   function error(){
      $output = @mysql_error();
      return $output;
   }//error

   function free_result($result){
      @mysql_free_result($result);
   }

   function close(){
      @mysql_close($this->connection);
      unset($this);
   }//close

}//class
?>
