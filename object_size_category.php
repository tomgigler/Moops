<?php

require_once "Program.php";
require_once "Level.php";
require_once "Time.php";
require_once "Object.php";
 
   session_start();

   include "verify.inc";

   $title = "Object Category Sizes in LOC per Method";

   include "header.inc";

   print "   <script language='JavaScript' src='javascripts/object_size_category.js'></script>\n";
   print "   <script language='JavaScript'>category_groups=".$program->get_category_groups()."</script>\n";

   print "   <center>\n";

   print "   <div style='text-align: left; width: 250px;' >\n";
   print "   <input id='radio_one' type='radio' name='categories' value='one' onclick='show_categories_in_one_group(".$program->get_id().")'";
   if($print_mode)
      print " style='display:none;'/>\n";
   if(!$print_mode)
      print ">Put all objects in one category</input><br>\n";
   print "   <input id='radio_categories' type='radio' name='categories' value='all' onclick='show_categories_by_type(".$program->get_id().")'";
   if($print_mode)
      print " style='display:none;'/>\n";
   if(!$print_mode)
      print ">Categorize objects by type</input>\n<br><br>\n";
   print "   </div>\n";

   print "   <table id='object_category_size_table' border=1>\n";
   print "      <tr>\n";
   print "         <th COLSPAN=6>\n";
   print "            Object Size in LOC per Method (stddev method)";
   print "         </th>\n";
   print "      </tr>\n";
   print "   </table>\n";
   print "   <br><br>\n";

   print "   <table id='object_category_size_table_ln' border=1>\n";
   print "      <tr>\n";
   print "         <th COLSPAN=6>\n";
   print "            Object Size in LOC per Method (natural log method)";
   print "         </th>\n";
   print "      </tr>\n";
   print "   </table>\n";
   print "   </center>\n";

   include "footer.inc";

?> 
