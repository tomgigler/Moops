<?php

require_once "Program.php";
require_once "Level.php";
require_once "Time.php";
require_once "Object.php";
 
   session_start();

   include "verify.inc";

   $title = "Size Estimating Template";

   include "header.inc";

   print "   <script language='JavaScript' src='javascripts/summary_psp0.js'></script>\n";
   print "   <script language='JavaScript' src='javascripts/size_est_template.js'></script>\n";

   print "   <center>\n";
   print "      <table id='table_size_est_table' width=80%>\n";

   if($program == 0 || $program->get_level() > 1)
   {
      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               <b>BASE PROGRAM LOC</b>\n";
      print "            </td>\n";
      print "            <td COLSPAN=5/>\n";
      print "            <td class=td_center>\n";
      print "               ESTIMATE\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_center>\n";
      print "               ACTUAL\n";
      print "            </td>\n";
      print "         </tr>\n";
      print "         <tr>\n";
      print "            <td COLSPAN=7>\n";
      print "               BASE SIZE (B)\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if(isset($print_mode))
      {
         if($program)
            print "               ".$program->get_est_base_loc()."\n";
         else
            print "               &nbsp;\n";
      }
      else
      {
         print "            <input id='input_est_base_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"est_base_loc\",".$program->get_id().", this.value)'";
         print " onchange='set_value(\"est_base_loc\",".$program->get_id().", this.value)' value='".$program->get_est_base_loc()."'/>\n";
      }
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if(isset($print_mode))
      {
         if($program)
            print "               ".$program->get_base_loc()."\n";
         else
            print "               &nbsp;\n";
      }
      else
      {
         print "            <input id='input_base_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"base_loc\",".$program->get_id().", this.value)'";
         print " onchange='set_value(\"base_loc\",".$program->get_id().", this.value)' value='".$program->get_base_loc()."'/>\n";
      }
      print "            </td>\n";
      print "         </tr>\n";
      print "         <tr>\n";
      print "            <td COLSPAN=7>\n";
      print "               LOC DELETED (D)\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if(isset($print_mode))
      {
         if($program)
            print "               ".$program->get_est_deleted_loc()."\n";
         else
            print "               &nbsp;\n";
      }
      else
      {
         print "            <input id='input_est_deleted_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"est_deleted_loc\",".$program->get_id().", this.value)'";
         print " onchange='set_value(\"est_deleted_loc\",".$program->get_id().", this.value)' value='".$program->get_est_deleted_loc()."'/>\n";
      }
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if(isset($print_mode))
      {
         if($program)
            print "               ".$program->get_deleted_loc()."\n";
         else
            print "               &nbsp;\n";
      }
      else
      {
         print "            <input id='input_deleted_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"deleted_loc\",".$program->get_id().", this.value)'";
         print " onchange='set_value(\"deleted_loc\",".$program->get_id().", this.value)' value='".$program->get_deleted_loc()."'/>\n";
      }
      print "            </td>\n";
      print "         </tr>\n";
      print "         <tr>\n";
      print "            <td COLSPAN=7>\n";
      print "               LOC MODIFIED (M)\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if(isset($print_mode))
      {
         if($program)
            print "               ".$program->get_est_modified_loc()."\n";
         else
            print "               &nbsp;\n";
      }
      else
      {
         print "            <input id='input_est_modified_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"est_modified_loc\",".$program->get_id().", this.value)'";
         print " onchange='set_value(\"est_modified_loc\",".$program->get_id().", this.value)' value='".$program->get_est_modified_loc()."'/>\n";
      }
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if(isset($print_mode))
      {
         if($program)
            print "               ".$program->get_modified_loc()."\n";
         else
            print "               &nbsp;\n";
      }
      else
      {
         print "            <input id='input_modified_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"modified_loc\",".$program->get_id().", this.value)'";
         print " onchange='set_value(\"modified_loc\",".$program->get_id().", this.value)' value='".$program->get_modified_loc()."'/>\n";
      }
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td>&nbsp;</td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td>\n";
      print "               <b>OBJECT LOC</b>\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td>\n";
      print "               BASE ADDITIONS\n";
      print "            </td>\n";
      print "            <td>&nbsp;</td>\n";
      print "            <td class=td_center>\n";
      print "               TYPE\n";
      print "            </td>\n";
      print "            <td>&nbsp;</td>\n";
      print "            <td class=td_center>\n";
      print "               METHODS\n";
      print "            </td>\n";
      print "            <td>&nbsp;</td>\n";
      print "            <td class=td_center>\n";
      print "               REL. SIZE\n";
      print "            </td>\n";
      print "            <td>&nbsp;</td>\n";
      print "            <td class=td_center>\n";
      print "               LOC\n";
      print "            </td>\n";
      print "            <td>&nbsp;</td>\n";
      print "            <td class=td_center>\n";
      print "               LOC\n";
      print "            </td>\n";
      print "         </tr>\n";

      if(!isset($print_mode))
      {

         // display input fields
         print "         <tr id='row_base_object_input'>\n";
         print "            <td class=td_underscore_left>\n";
         print "               <input id='input_base_object_name' size=40 onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"base\")'/>\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         print "               <select id='select_base_object_type' onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"base\")'>\n";
         print "                  <option value='Logic'>Logic</option>\n";
         print "                  <option value='I/O'>I/O</option>\n";
         print "                  <option value='Calc'>Calc</option>\n";
         print "                  <option value='Text'>Text</option>\n";
         print "                  <option value='Data'>Data</option>\n";
         print "                  <option value='Set-up'>Set-up</option>\n";
         print "               </select>\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         print "               <input id='input_base_object_methods' size=6/ onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"base\")'>\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         print "               <select id='select_base_object_rel_size' onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"base\")'>\n";
         print "                  <option value='V. Small'>V. Small</option>\n";
         print "                  <option value='Small'>Small</option>\n";
         print "                  <option value='Medium'>Medium</option>\n";
         print "                  <option value='Large'>Large</option>\n";
         print "                  <option value='V. Large'>V. Large</option>\n";
         print "               </select>\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         print "               &nbsp;\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         print "               <input id='input_base_object_loc' size=6 onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"base\")'/>\n";
         print "            </td>\n";
         print "            <td COLSPAN=2>\n";
         print "               <button onClick='create_object(".$program->get_id().",\"base\")'>\n";
         print "                  Submit\n";
         print "               </button>\n";
         print "            </td>\n";
         print "         </tr>\n";
      }

      $all = $program->get_all_objects("base");

      // display all base objects for this program
      for($x = 0 ; $x < sizeof($all) ; $x++)
      {
         print "         <tr id='row_base_object_".$all[$x]->get_id()."'>\n";
         print "            <td id='cell_base_object_name_".$all[$x]->get_id()."' class=td_underscore_left>\n";
         print "               ".$all[$x]->get_name()."\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td id='cell_base_object_type_".$all[$x]->get_id()."' class=td_underscore>\n";
         print "               ".$all[$x]->get_type()."\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td id='cell_base_object_methods_".$all[$x]->get_id()."' class=td_underscore>\n";
         print "               ".$all[$x]->get_methods()."\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td id='cell_base_object_rel_size_".$all[$x]->get_id()."' class=td_underscore>\n";
         print "               ".$all[$x]->get_rel_size()."\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td id='cell_base_object_est_loc_".$all[$x]->get_id()."' class=td_underscore>\n";
         if($program == 0 || $program->get_level() > 1)
         {
            print "               ".round($all[$x]->get_est_loc(),1)."\n";
         }
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td id='cell_base_object_loc_".$all[$x]->get_id()."' class=td_underscore>\n";
         print "               ".$all[$x]->get_loc();
         if($all[$x]->get_reuse()) print "*";
         print "\n            </td>\n";
         if(!isset($print_mode))
         {
            print "           <td>\n";
            print "               <button onClick='edit_object(\"".$program->get_id()."\",\"".$all[$x]->get_id()."\",\"base\")'>\n";
            print "                  Edit\n";
            print "               </button>\n";
            print "           </td>\n";
            print "           <td>\n";
            print "               <button onClick='delete_object(\"".$program->get_id()."\",\"".$all[$x]->get_id()."\",\"base\",\"".$all[$x]->get_name()."\")'>\n";
            print "                  Delete\n";
            print "               </button>\n";
            print "           </td>\n";
         }
         print "         </tr>\n";
      }

      for($x = sizeof($all) ; $x < 4 ; $x++)
      {
      print "         <tr>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";
      }
      print "         <tr id='row_base_object_total'>\n";
      print "            <td COLSPAN=7>\n";
      print "               TOTAL BASE ADDITIONS (BA)\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_plan_total_base_objects' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_plan_total_new_base("base"),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_total_base_objects' class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_total_new_base("base")."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td>&nbsp;</td>\n";
      print "         </tr>\n";
   }

   print "         <tr id='row_new_object_header'>\n";
   print "            <td>\n";
   print "               NEW OBJECTS\n";
   print "            </td>\n";
   print "            <td>&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               TYPE\n";
   print "            </td>\n";
   print "            <td>&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               METHODS\n";
   print "            </td>\n";
   print "            <td>&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   if($program == 0 || $program->get_level() > 1)
      print "               REL. SIZE\n";
   print "            </td>\n";
   print "            <td>&nbsp;</td>\n";
   print "            <td class=td_center COLSPAN=3>\n";
   print "               LOC (New Reuse*)\n";
   print "            </td>\n";
   print "         </tr>\n";

   if(!isset($print_mode))
   {

      // display input fields
      print "         <tr id='row_new_object_input'>\n";
      print "            <td class=td_underscore_left>\n";
      print "               <input id='input_new_object_name' size=40 onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"new\")'/>\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               <select id='select_new_object_type' onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"new\")'>\n";
      print "                  <option value='Logic'>Logic</option>\n";
      print "                  <option value='I/O'>I/O</option>\n";
      print "                  <option value='Calc'>Calc</option>\n";
      print "                  <option value='Text'>Text</option>\n";
      print "                  <option value='Data'>Data</option>\n";
      print "                  <option value='Set-up'>Set-up</option>\n";
      print "               </select>\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               <input id='input_new_object_methods' size=6 onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"new\")'/>\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program == 0 || $program->get_level() > 1)
      {
         print "               <select id='select_new_object_rel_size' onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"new\")'>\n";
         print "                  <option value='V. Small'>V. Small</option>\n";
         print "                  <option value='Small'>Small</option>\n";
         print "                  <option value='Medium'>Medium</option>\n";
         print "                  <option value='Large'>Large</option>\n";
         print "                  <option value='V. Large'>V. Large</option>\n";
         print "               </select>\n";
      }
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program == 0 || $program->get_level() > 1)
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               <input id='input_new_object_loc' size=6/ onkeypress='capture_keypress(event, create_object, 0, 0, 0, ".$program->get_id().",\"new\")'>\n";
      print "            </td>\n";
      print "            <td COLSPAN=2>\n";
      print "               <button onClick='create_object(".$program->get_id().",\"new\")'>\n";
      print "                  Submit\n";
      print "               </button>\n";
      print "            </td>\n";
      print "         </tr>\n";
   }

   $all = $program->get_all_objects("new");
   // display all new objects for this program
   for($x = 0 ; $x < sizeof($all) ; $x++)
   {
      print "         <tr id='row_new_object_".$all[$x]->get_id()."'>\n";
      print "            <td id='cell_new_object_name_".$all[$x]->get_id()."' class=td_underscore_left>\n";
      print "               ".$all[$x]->get_name()."\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='cell_new_object_type_".$all[$x]->get_id()."' class=td_underscore>\n";
      print "               ".$all[$x]->get_type()."\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='cell_new_object_methods_".$all[$x]->get_id()."' class=td_underscore>\n";
      print "               ".$all[$x]->get_methods()."\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='cell_new_object_rel_size_".$all[$x]->get_id()."' class=td_underscore>\n";
      if($program == 0 || $program->get_level() > 1)
         print "               ".$all[$x]->get_rel_size()."\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='cell_new_object_est_loc_".$all[$x]->get_id()."' class=td_underscore>\n";
      if($program == 0 || $program->get_level() > 1)
      {
         print "               ".round($all[$x]->get_est_loc(),1)."\n";
      }
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='cell_new_object_loc_".$all[$x]->get_id()."' class=td_underscore>\n";
      print "               ".$all[$x]->get_loc();
      if($all[$x]->get_reuse()) print "*";
      print "\n            </td>\n";
      if(!isset($print_mode))
      {
         print "           <td>\n";
         print "               <button onClick='edit_object(\"".$program->get_id()."\",\"".$all[$x]->get_id()."\",\"new\")'>\n";
         print "                  Edit\n";
         print "               </button>\n";
         print "           </td>\n";
         print "           <td>\n";
         print "               <button onClick='delete_object(\"".$program->get_id()."\",\"".$all[$x]->get_id()."\",\"new\",\"".$all[$x]->get_name()."\")'>\n";
         print "                  Delete\n";
         print "               </button>\n";
         print "           </td>\n";
      }
      print "         </tr>\n";
   }

   // display at least five lines
   for($x = sizeof($all) ; $x < 5 ; $x++)
   {
      print "         <tr>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program == 0 || $program->get_level() > 1)
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program == 0 || $program->get_level() > 1)
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";
   }
   print "         <tr id='row_new_object_total'>\n";
   print "            <td COLSPAN=7>\n";
   print "               TOTAL NEW OBJECTS\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_total_new_objects' class=td_underscore>\n";
   if($program->get_level() > 1)
   {
      if($program != 0)
         print "               ".round($program->get_plan_total_new_base("new"),1)."\n";
      else
         print "               &nbsp;\n";
   }
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_total_new_objects' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_total_new_base("new")."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   if($program == 0 || $program->get_level() > 1)
   {
      print "         <tr>\n";
      print "            <td>&nbsp;</td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td>\n";
      print "               <b>REUSED OBJECTS</b>\n";
      print "            </td>\n";
      print "         </tr>\n";

      if(!isset($print_mode))
      {
         print "         <tr id='row_reuse_object_input'>\n";
         print "            <td class=td_underscore_left COLSPAN=7>\n";
         print "               <select id='select_reused_objects' onchange='select_reused_objects_change()'>\n";
         $all = $program->get_all_reusable_objects();
         if(sizeof($all) == 0)
            print "                  <option value=''>No objects available</option>\n";
         else
            print "                  <option value=''></option>\n";
         for($x = 0 ; $x < sizeof($all) ; $x++)
         {
            print "                  <script language='JavaScript'>int_reusable_object_".$all[$x]->get_id()."=".$all[$x]->get_loc()."</script>\n";
            print "                  <option value=".$all[$x]->get_id().">".$all[$x]->get_name()." (".$all[$x]->get_program_name().")</option>\n";
         }
         print "               </select>\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td id='td_reusable_objects_loc' class=td_underscore>\n";
         print "               &nbsp;\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         print "               <input disabled id='input_actual_reuse_loc' size=6/>\n";
         print "            </td>\n";
         print "            <td COLSPAN=2>\n";
         print "               <button disabled id='button_reused_object_submit' onClick='add_reused_object(".$program->get_id().")'>\n";
         print "                  Submit\n";
         print "               </button>\n";
         print "            </td>\n";
         print "         </tr>\n";
      }
 
      if($program != 0)
         $all = $program->get_all_reused_objects();
      for($x = 0 ; $x < sizeof($all) ; $x++)
      {
         print "         <tr id='tr_reused_object_".$all[$x]->get_id()."'>\n";
         print "            <script language='JavaScript'>int_reusable_object_".$all[$x]->get_id()."=".$all[$x]->get_loc()."</script>\n";
         print "            <td class=td_underscore_left COLSPAN=7>\n";
         print "               ".$all[$x]->get_name()." (".$all[$x]->get_program_name().")\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         print "               ".$all[$x]->get_loc()."\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         if($all[$x]->get_actual_reused_loc())
            print "               ".$all[$x]->get_actual_reused_loc()."\n";
         else
            print "               &nbsp;\n";
         print "            </td>\n";
         if(!$print_mode)
         {
            print "            <td>\n";
            print "                <button onClick='edit_reused_object(".$program->get_id().",".$all[$x]->get_id().")'>\n";
            print "                   Edit\n";
            print "                </button>\n";
            print "            </td>\n";
            print "            <td>\n";
            print "                <button onClick='delete_reused_object(".$program->get_id().",".$all[$x]->get_id().")'>\n";
            print "                   Delete\n";
            print "                </button>\n";
            print "            </td>\n";
         }
         print "         </tr>\n";
      }

      for($x = sizeof($all) ; $x < 5 ; $x++)
      {
         print "         <tr>\n";
         print "            <td class=td_underscore COLSPAN=7>\n";
         print "               &nbsp;\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         print "               &nbsp;\n";
         print "            </td>\n";
         print "            <td/>\n";
         print "            <td class=td_underscore>\n";
         print "               &nbsp;\n";
         print "            </td>\n";
         print "         </tr>\n";
      }

      print "         <tr id='tr_reused_object_total'>\n";
      print "            <td COLSPAN=7>\n";
      print "               REUSED TOTAL\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_total_plan_reused_loc' class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_total_plan_reused_loc()."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_total_actual_reused_loc' class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_total_actual_reused_loc()."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td>&nbsp;</td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=8/>\n";
      print "            <td class=td_center>\n";
      print "               SIZE\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_center>\n";
      print "               TIME\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               PROBE Estimating Method:\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_probe_est_method_loc' class=td_underscore>\n";
      if(!$print_mode)
      {
         print "               <select id='select_probe_est_method_loc' onchange='select_probe_est_method_loc_change(".$program->get_id().")'>\n";
         $method = array("C", "D");
         foreach($method as $m)
         {
            print "                  <option value='".$m."'";
            if($program->get_probe_method_loc() == $m) print " selected";
            print ">".$m."</option>\n";
         }
         print "               </select>\n";
      }
      else
      {
         if(!$program->get_probe_method_loc())
            print "               &nbsp;\n";
         else
            print "               ".$program->get_probe_method_loc()."\n";
      }
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_probe_est_method_time' class=td_underscore>\n";
      if(!$print_mode)
      {
         print "               <select id='select_probe_est_method_time' onchange='select_probe_est_method_time_change(".$program->get_id().")'>\n";
         foreach($method as $m)
         {
            print "                  <option value='".$m."'";
            if($program->get_probe_method_time() == $m) print " selected";
            print ">".$m."</option>\n";
         }
         print "               </select>\n";
      }
      else
      {
         if(!$program->get_probe_method_time())
            print "               &nbsp;\n";
         else
            print "               ".$program->get_probe_method_time()."\n";
      }
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Estimated Object LOC (E):\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "               E=BA+NO+M\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_est_obj_loc' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_estimated_object_loc(),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Regression Parameters:\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "               &#946<sub>0</sub>(size and time)\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_b0_size' class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_b0_size_display()."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_b0_time' class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_b0_time_display()."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Regression Parameters:\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "               &#946<sub>1</sub>(size and time)\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_b1_size' class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_b1_size_display()."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_b1_time' class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_b1_time_display()."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Estimated New and Changed LOC (N):\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "               N=&#946<sub>0</sub>+&#946<sub>1</sub>*E\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_probe_plan_newchg_loc' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_probe_plan_newchg_loc(),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Estimated Total LOC:\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "               T=N+B-D-M+R\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_probe_plan_total_loc' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_probe_plan_total_loc(),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Estimated Total New Reuse (sum of * LOC):\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_est_total_new_reuse' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_est_total_new_reuse(),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Estimated Total Development Time:\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "               Time=&#946<sub>0</sub>+&#946<sub>1</sub>*E\n";
      print "            </td>\n";
      print "            <td COLSPAN=3/>\n";
      print "            <td id='td_probe_plan_time' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_probe_plan_time(),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Prediction Range:\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "               Range\n";
      print "            </td>\n";
      print "            <td>\n";
      print "            <td id='td_range_size' class=td_underscore>\n";
      if($program->get_probe_method_loc() == "D" || $program->get_probe_method_loc() == "C")
      {
         if(!$print_mode)
         {
            print "               <input id='input_range_size' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"range_size\",".$program->get_id().", this.value)'";
            print " onchange='set_value(\"range_size\",".$program->get_id().", this.value)' value='".$program->get_range_size()."'/>\n";
         }
         else
         {
            if($program->get_range_size())
               print "               ".$program->get_range_size()."\n";
            else
               print "               &nbsp;\n";
         }
      }
      else
      {
         print "               &nbsp;\n";
      }
      print "            </td>\n";
      print "            <td>\n";
      print "            <td id='td_range_time' class=td_underscore>\n";
      if($program->get_probe_method_time() == "D" || $program->get_probe_method_loc() == "C")
      {
         if(!$print_mode)
         {
            print "               <input id='input_range_time' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"range_time\",".$program->get_id().", this.value)'";
            print " onchange='set_value(\"range_time\",".$program->get_id().", this.value)' value='".$program->get_range_time()."'/>\n";
         }
         else
         {
            if($program->get_range_time())
               print "               ".$program->get_range_time()."\n";
            else
               print "               &nbsp;\n";
         }
      }
      else
      {
         print "               &nbsp;\n";
      }
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Upper Prediction Interval:\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "            </td>\n";
      print "            <td>\n";
      print "            <td id='td_upper_interval_size' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_upper_interval_size(),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td>\n";
      print "            <td id='td_upper_interval_time' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_upper_interval_time(),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Lower Prediction Interval:\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "            </td>\n";
      print "            <td>\n";
      print "            <td id='td_lower_interval_size' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_lower_interval_size(),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td>\n";
      print "            <td id='td_lower_interval_time' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_lower_interval_time(),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";

      print "         <tr>\n";
      print "            <td COLSPAN=3>\n";
      print "               Prediction Interval Percent:\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td COLSPAN=3>\n";
      print "            </td>\n";
      print "            <td>\n";
      print "            <td id='td_interval_percent_size' class=td_underscore>\n";
      if($program->get_probe_method_loc() == "D" || $program->get_probe_method_loc() == "C")
         print "               N/A\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td>\n";
      print "            <td id='td_interval_percent_time' class=td_underscore>\n";
      if($program->get_probe_method_time() == "D" || $program->get_probe_method_loc() == "C")
         print "               N/A\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";
   }

   print "      </table>\n";
   print "   </center>\n";

   include "footer.inc";

?> 
