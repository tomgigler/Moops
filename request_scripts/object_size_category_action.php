<?php

   require_once "../Program.php";

   session_start();

   if(isset($_SESSION['program']) && $_SESSION['program']) $program =& $_SESSION['program'];
   else exit;

   print "<xml>\n";
   $sizes = array("V. Small", "Small", "Medium", "Large", "V. Large");
   $types = array("Logic", "I/O", "Calc", "Text", "Data", "Set-up");

   if($_GET['op'] == "one_group")
   {
      $program->set_category_groups(0);
      print "<table>\n";
      print "   <row>\n";
      foreach($sizes as $s) print "      <cell>\n         ".$s."\n      </cell>\n";
      print "   </row>\n";
      $obj_cat_sizes = $program->get_object_category_sizes();
      print "   <row>\n";
      foreach($obj_cat_sizes as $c) print "      <cell>\n         ".round($c,2)."\n      </cell>\n";
      print "   </row>\n";
      print "</table>\n";

      print "<table_ln>\n";
      print "   <row>\n";
      foreach($sizes as $s) print "      <cell>\n         ".$s."\n      </cell>\n";
      print "   </row>\n";
      $obj_cat_sizes = $program->get_object_category_sizes_ln();
      print "   <row>\n";
      foreach($obj_cat_sizes as $c) print "      <cell>\n         ".round($c,2)."\n      </cell>\n";
      print "   </row>\n";
      print "</table_ln>\n";
   }

   if($_GET['op'] == "group_by_type")
   {
      $program->set_category_groups(1);
      print "<table>\n";
      print "   <row>\n";
      print "      <cell>\n         Type\n      </cell>\n";
      foreach($sizes as $s) print "      <cell>\n         ".$s."\n      </cell>\n";
      print "   </row>\n";

      foreach($types as $t)
      {
         print "   <row>\n";
         print "      <cell>\n         ".$t."\n      </cell>\n";
         $obj_cat_sizes = $program->get_object_category_sizes($t);
         foreach($obj_cat_sizes as $c) print "      <cell>\n         ".round($c,2)."\n      </cell>\n";
         print "   </row>\n";
      }

      print "</table>\n";

      print "<table_ln>\n";
      print "   <row>\n";
      print "      <cell>\n         Type\n      </cell>\n";
      foreach($sizes as $s) print "      <cell>\n         ".$s."\n      </cell>\n";
      print "   </row>\n";

      foreach($types as $t)
      {
         print "   <row>\n";
         print "      <cell>\n         ".$t."\n      </cell>\n";
         $obj_cat_sizes = $program->get_object_category_sizes_ln($t);
         foreach($obj_cat_sizes as $c) print "      <cell>\n         ".round($c,2)."\n      </cell>\n";
         print "   </row>\n";
      }

      print "</table_ln>\n";
   }
   print "</xml>\n";

?>
