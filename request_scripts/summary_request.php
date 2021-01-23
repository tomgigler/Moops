<?php

   require_once "../Program.php";
   require_once "../Object.php";
   session_start();
$_SESSION['sql_count'] = 0;

   if(isset($_SESSION['program']) && $_SESSION['program']) $program =& $_SESSION['program'];
   else exit;

   print "<xml>\n";
   $object = new Object();

   $old_total_loc = $program->get_total_loc();
   $old_total_new_reuse = $program->get_total_new_reuse();
   $old_est_total_new_reuse = $program->get_est_total_new_reuse();
   $old_total_base = $program->get_total_new_base("base");
   $old_plan_total_base = $program->get_plan_total_new_base("base");
   $old_total_new = $program->get_total_new_base("new");
   $old_plan_total_new = $program->get_plan_total_new_base("new");
   $old_plan_added = ($program->get_plan_newchg_loc() - $program->get_est_modified_loc());
   $old_added_loc = $program->get_added_loc();
   $old_base_loc = $program->get_base_loc();
   $old_est_base_loc = $program->get_est_base_loc();
   $old_deleted_loc = $program->get_deleted_loc();
   $old_est_deleted_loc = $program->get_est_deleted_loc();
   $old_modified_loc = $program->get_modified_loc();
   $old_est_modified_loc = $program->get_est_modified_loc();
   $old_to_date_reused_loc = $program->get_to_date_reused_loc();
   $old_newchg_loc = $program->get_newchg_loc();
   $old_to_date_newchg_loc = $program->get_to_date_newchg_loc();
   $old_to_date_total_loc = $program->get_to_date_total_loc();
   $old_est_obj_loc = ($program->get_plan_total_new_base("base") + $program->get_plan_total_new_base("new") + $program->get_est_modified_loc());
   $old_total_actual_reused_loc = $program->get_total_actual_reused_loc();
   $old_total_plan_reused_loc = $program->get_total_plan_reused_loc();
   $old_plan_newchg_loc = $program->get_plan_newchg_loc();
   $old_plan_total_loc = $program->get_plan_total_loc();
   $old_plan_time = $program->get_plan_time();

   $old_loc_per_hour = $program->get_loc_per_hour();
   $old_to_date_loc_per_hour = $program->get_to_date_loc_per_hour();
   $old_range_size = $program->get_range_size();
   $old_range_time = $program->get_range_time();
   $old_probe_est_method_loc = $program->get_probe_method_loc();
   $old_probe_est_method_time = $program->get_probe_method_time();
   $old_plan_loc_per_hour = $program->get_plan_loc_per_hour();
   $old_reused_loc = $program->get_reused_loc();
   $old_b0_size = $program->get_b0_size();
   $old_b1_size = $program->get_b1_size();
   $old_b0_time = $program->get_b0_time();
   $old_b1_time = $program->get_b1_time();
   $old_range_size = $program->get_range_size();
   $old_range_time = $program->get_range_time();
   $old_probe_plan_time = $program->get_probe_plan_time();
   $old_upper_interval_time = $program->get_upper_interval_time();
   $old_lower_interval_time = $program->get_lower_interval_time();
   $old_upper_interval_size = $program->get_upper_interval_size();
   $old_lower_interval_size = $program->get_lower_interval_size();
   $old_probe_plan_newchg_loc = $program->get_probe_plan_newchg_loc();
   $old_probe_plan_total_loc = $program->get_probe_plan_total_loc();

   $old_to_date_plan_time = $program->get_to_date_plan_time();
   $old_CPI = $program->get_CPI();
   $old_percent_plan_new_reuse = $program->get_percent_plan_new_reuse();
   $old_percent_new_reuse = $program->get_percent_new_reuse();
   $old_to_date_percent_new_reuse = $program->get_to_date_percent_new_reuse();
   $old_percent_plan_reused_loc = $program->get_percent_plan_reused_loc();
   $old_percent_reused_loc = $program->get_percent_reused_loc();
   $old_to_date_percent_reused_loc = $program->get_to_date_percent_reused_loc();

   $old_plan_test_defects_per_kloc = round($program->get_plan_defects_per_kloc("Test"),1);
   $old_test_defects_per_kloc = round($program->get_defects_per_kloc("Test"),1);
   $old_to_date_test_defects_per_kloc = round($program->get_to_date_defects_per_kloc("Test"),1);
   $old_plan_total_defects_per_kloc = round($program->get_plan_defects_per_kloc(),1);
   $old_total_defects_per_kloc = round($program->get_defects_per_kloc(),1);
   $old_total_to_date_defects_per_kloc = round($program->get_to_date_defects_per_kloc(),1);
   $old_plan_defects_per_hour_Design_Review = round($program->get_plan_defects_per_hour("Design Review"), 2);
   $old_plan_defects_per_hour_Code_Review = round($program->get_plan_defects_per_hour("Code Review"), 2);
   $old_plan_defects_per_hour_Compile = round($program->get_plan_defects_per_hour("Compile"), 2);
   $old_plan_defects_per_hour_Test = round($program->get_plan_defects_per_hour("Test"), 2);

   if($_GET['op'] == "set_range_size")
   {
      if($_GET['range_size'] == "NaN" || $_GET['range_size'] == $old_range_size)
         print "<old_range_size>".$program->get_range_size()."</old_range_size>\n";
      else
         $program->set_range_size($_GET['range_size']);
      print "<focus>input_range_size</focus>\n";
   }

   if($_GET['op'] == "set_range_time")
   {
      if($_GET['range_time'] == "NaN" || $_GET['range_time'] == $old_range_time)
         print "<old_range_time>".$program->get_range_time()."</old_range_time>\n";
      else
         $program->set_range_time($_GET['range_time']);
      print "<focus>input_range_time</focus>\n";
   }

   if($_GET['op'] == "set_probe_est_method_loc")
   {
      $program->set_probe_method_loc($_GET['probe_est_method_loc']);
      print "<range_size_input_value>".$program->get_range_size()."</range_size_input_value>\n";
   }

   if($_GET['op'] == "set_probe_est_method_time")
   {
      $program->set_probe_method_time($_GET['probe_est_method_time']);
      print "<range_time_input_value>".$program->get_range_time()."</range_time_input_value>\n";
   }

   if($_GET['op'] == "update_object" || $_GET['op'] == "create_object")
   {
      $id = $object->exists($_GET['name'], $_GET['prog']);
      if($id && $id != $_GET['id'])
      {
         $prev_obj = new Object();
         $prev_obj = $prev_obj->get_object($id);
         if($_GET['op'] == "create_object")
            print "<focus>input_".$_GET['new_base']."_object_name</focus>\n";
         else
            print "<focus>input_object_edit_name</focus>\n";
         print "<highlight>row_".$prev_obj->new_base."_object_".$id."</highlight>\n";
         print "<alert>Program ".$program->get_name()." already has an object named ".$_GET['name']."!</alert></xml>\n";
         exit;
      }
      else if(preg_match("/\"/", $_GET['name']) || preg_match("/'/", $_GET['name']))
      {
         if(isset($_GET['id'])) $input_id = "input_object_edit_name";
         else $input_id = "input_".$_GET['new_base']."_object_name";
         print "<focus>".$input_id."</focus>\n";
         print "<highlight>".$input_id."</highlight>\n";
         print "<alert>Quote characters not allowed in object name!</alert></xml>\n";
         exit;
      }
      if(preg_match("/\*\s*$/", $_GET['loc'])) $reuse = 1;
      else $reuse = 0; 
   }

   if($_GET['op'] == "update_object")
   {
      $object = $object->get_object($_GET['id']);
      print "<old_name>".$object->get_name()."</old_name>\n";
      print "<old_type>".$object->get_type()."</old_type>\n";
      print "<old_methods>".$object->get_methods()."</old_methods>\n";
      print "<old_loc>".$object->get_loc();
      if($object->get_reuse()) print "*";
      print "</old_loc>\n";
      print "<old_reuse>".$object->get_reuse()."</old_reuse>\n";
      if($program->get_level() > 1)
      {
         print "<old_rel_size>".$object->get_rel_size()."</old_rel_size>\n";
         print "<old_est_loc>".round($object->get_est_loc(),1)."</old_est_loc>\n";
      }

      $object = $program->update_object_row($_GET['id'], $_GET['name'], $_GET['type'], $_GET['methods'], $_GET['rel_size'], $_GET['loc'], $reuse); 
      $object = $object->get_object($_GET['id']);
   }

   if($_GET['op'] == "create_object")
   {
      $id = $program->create_object_row($_GET['name'], $_GET['type'], $_GET['methods'], $_GET['rel_size'], $_GET['loc'], $reuse, $_GET['new_base']); 
      $object = $object->get_object($id);
   }

   if($_GET['op'] == "update_object" || $_GET['op'] == "create_object")
   {
      print "<id>".$object->get_id()."</id>\n";
      print "<name>".$object->get_name()."</name>\n";
      print "<type>".$object->get_type()."</type>\n";
      print "<methods>".$object->get_methods()."</methods>\n";
      if($program->get_level() > 1)
      {
         print "<rel_size>".$object->get_rel_size()."</rel_size>\n";
         print "<est_loc>".round($object->get_est_loc(),1)."</est_loc>\n";
      }
      print "<loc>".$object->get_loc();
      if($object->get_reuse()) print "*";
      print "</loc>\n";
      print "<reuse>".$object->get_reuse()."</reuse>\n";
   }

   if($_GET['op'] == "get_object_for_edit")
   {
      // if this object is being reused, don't allow edit
      if($all = $object->get_programs_reusing($_GET['id']))
      {
         print "<alert>Cannot edit \"".$object->get_name($_GET['id'])."\"!  It is being reused by program";
         if(sizeof($all) > 1) print "s";
         print " ";
         for($x = 0 ; $x < sizeof($all) ; $x++)
         {
            print "\"".$program->get_name($all[$x])."\"";
            if($x == sizeof($all) - 1) print ".";
            if(sizeof($all) > 1 && $x < sizeof($all) - 2) print ", ";
            if(sizeof($all) > 1 && $x == sizeof($all) - 2) print " and ";

         }
         print "</alert>\n<highlight>row_new_object_".$_GET['id']."</highlight></xml>\n";
         exit;
      }
   }

   if($_GET['op'] == "get_object" || $_GET['op'] == "get_object_for_edit")
   {
      $object = $object->get_object($_GET['id']);
      print "<id>".$id."</id>\n";
      print "<name>".$object->get_name()."</name>\n";
      print "<type>".$object->get_type()."</type>\n";
      print "<methods>".$object->get_methods()."</methods>\n";
      print "<rel_size>".$object->get_rel_size()."</rel_size>\n";
      print "<est_loc>".round($object->get_est_loc(),1)."</est_loc>\n";
      print "<loc>".$object->get_loc()."</loc>\n";
      print "<reuse>".$object->get_reuse()."</reuse>\n";
   }

   if($_GET['op'] == "delete_object")
   {
      // if this object is being reused, don't allow delete
      if($all = $object->get_programs_reusing($_GET['id']))
      {
         print "<alert>Cannot delete \"".$object->get_name($_GET['id'])."\"!  It is being reused by program";
         if(sizeof($all) > 1) print "s";
         print " ";
         for($x = 0 ; $x < sizeof($all) ; $x++)
         {
            print "\"".$program->get_name($all[$x])."\"";
            if($x == sizeof($all) - 1) print ".";
            if(sizeof($all) > 1 && $x < sizeof($all) - 2) print ", ";
            if(sizeof($all) > 1 && $x == sizeof($all) - 2) print " and ";

         }
         print "</alert>\n</xml>\n";
         exit;
      }

      $program->delete_object_row($_GET['id']); 
      print "<id>".$_GET['id']."</id>\n";
      print "<level>".$program->get_level()."</level>\n";
   }

   if($_GET['op'] == "set_base_loc")
   {
      if($_GET['base_loc'] == "NaN" || $_GET['base_loc'] == $old_base_loc)
         print "<old_base_loc>".$program->get_base_loc()."</old_base_loc>\n";
      else
         $program->set_base_loc($_GET['base_loc']);
      print "<focus>input_base_loc</focus>\n";
   }

   if($_GET['op'] == "set_est_base_loc" || $_GET['est_base_loc'] == $old_est_base_loc)
   {
      if($_GET['est_base_loc'] == "NaN")
         print "<old_est_base_loc>".$program->get_est_base_loc()."</old_est_base_loc>\n";
      else
         $program->set_est_base_loc($_GET['est_base_loc']);
      print "<focus>input_est_base_loc</focus>\n";
   }

   if($_GET['op'] == "set_deleted_loc")
   {
      if($_GET['deleted_loc'] == "NaN" || $_GET['deleted_loc'] == $old_deleted_loc)
         print "<old_deleted_loc>".$program->get_deleted_loc()."</old_deleted_loc>\n";
      else
         $program->set_deleted_loc($_GET['deleted_loc']);
      print "<focus>input_deleted_loc</focus>\n";
   }

   if($_GET['op'] == "set_est_deleted_loc")
   {
      if($_GET['est_deleted_loc'] == "NaN" || $_GET['est_deleted_loc'] == $old_est_deleted_loc)
         print "<old_est_deleted_loc>".$program->get_est_deleted_loc()."</old_est_deleted_loc>\n";
      else
         $program->set_est_deleted_loc($_GET['est_deleted_loc']);
      print "<focus>input_est_deleted_loc</focus>\n";
   }

   if($_GET['op'] == "set_modified_loc")
   {
      if($_GET['modified_loc'] == "NaN" || $_GET['modified_loc'] == $old_modified_loc)
         print "<old_modified_loc>".$program->get_modified_loc()."</old_modified_loc>\n";
      else
         $program->set_modified_loc($_GET['modified_loc']);
      print "<focus>input_modified_loc</focus>\n";
   }

   if($_GET['op'] == "set_est_modified_loc")
   {
      if($_GET['est_modified_loc'] == "NaN" || $_GET['est_modified_loc'] == $old_est_modified_loc)
         print "<old_est_modified_loc>".$program->get_est_modified_loc()."</old_est_modified_loc>\n";
      else
         $program->set_est_modified_loc($_GET['est_modified_loc']);
      print "<focus>input_est_modified_loc</focus>\n";
   }

   if($_GET['op'] == "set_reused_loc")
   {
      if($_GET['reused_loc'] == "NaN" || $_GET['reused_loc'] == $old_reused_loc)
         print "<old_reused_loc>".$program->get_reused_loc()."</old_reused_loc>\n";
      else
         $program->set_reused_loc($_GET['reused_loc']);
      print "<focus>input_reused_loc</focus>\n";
   }

   if($_GET['op'] == "set_plan_newchg_loc")
   {
      if($_GET['plan_newchg_loc'] == "NaN" || $_GET['plan_newchg_loc'] == $old_plan_newchg_loc)
         print "<old_plan_newchg_loc>".$program->get_plan_newchg_loc()."</old_plan_newchg_loc>\n";
      else
      {
         $phases = $program->get_all_phases();
         for($x = 0 ; $x < sizeof($phases) ; $x++)
            $old_phase_plan_inject[$x] = $program->get_plan_injected($phases[$x]);
         $old_total_plan_injected = $program->get_plan_injected();

         for($x = 0 ; $x < sizeof($phases) ; $x++)
            $old_phase_plan_remove[$x] = $program->get_plan_remove($phases[$x]);
         $old_total_plan_remove = $program->get_plan_remove();

         $program->set_plan_newchg_loc($_GET['plan_newchg_loc']);

         for($x = 0 ; $x < sizeof($phases) ; $x++)
            if($old_phase_plan_inject[$x] != $program->get_plan_injected($phases[$x]))
               print "<plan_injected_phase phase='".$phases[$x]."'>".round($program->get_plan_injected($phases[$x]),1)."</plan_injected_phase>\n";
         if($old_total_plan_injected != $program->get_plan_injected())
            print "<total_plan_injected>".round($program->get_plan_injected(),1)."</total_plan_injected>\n";

         for($x = 0 ; $x < sizeof($phases) ; $x++)
            if($old_phase_plan_remove[$x] != $program->get_plan_remove($phases[$x]))
               print "<plan_remove_phase phase='".$phases[$x]."'>".round($program->get_plan_remove($phases[$x]),1)."</plan_remove_phase>\n";
         if($old_total_plan_remove != $program->get_plan_remove())
            print "<total_plan_remove>".round($program->get_plan_remove(),1)."</total_plan_remove>\n";
      }
      print "<focus>input_plan_newchg_loc</focus>\n";
   }

   if($_GET['op'] == "set_total_loc")
   {
      if($_GET['total_loc'] == "NaN" || $_GET['total_loc'] == $old_total_loc)
         print "<old_total_loc>".$program->get_total_loc()."</old_total_loc>\n";
      else
         $program->set_total_loc($_GET['total_loc']);
      print "<focus>input_total_loc</focus>\n";
   }

   if($_GET['op'] == "save_reused_object")
   {
      $object = new Object();
      $object = $object->get_object($_GET['objectid']);
      print "<old_reused_actual_loc>".$program->get_actual_reused_loc($object->get_id())."</old_reused_actual_loc>\n";
      if($_GET['reused_loc'] == "NaN") $r_loc = "null";
      else $r_loc = $_GET['reused_loc'];
      $program->update_reuse_object($object->get_id(), $r_loc);
      print "<objectid>".$object->get_id()."</objectid>\n";
      print "<reused_actual_loc>".$program->get_actual_reused_loc($object->get_id())."</reused_actual_loc>\n";
   }

   if($_GET['op'] == "add_reused_object")
   {
      $object = new Object();
      $object = $object->get_object($_GET['objectid']);
      if($_GET['reused_loc'] == "NaN") $r_loc = "null";
      else $r_loc = $_GET['reused_loc'];
      $program->reuse_object($object->get_id(), $r_loc);
      print "<objectid>".$object->get_id()."</objectid>\n";
      print "<reused_object_name>".$object->get_name($object->get_id())." (".$program->get_name($object->get_programid()).")</reused_object_name>\n";
      print "<reused_object_loc>".$object->get_loc()."</reused_object_loc>\n";
      print "<reused_actual_loc>".$program->get_actual_reused_loc($object->get_id())."</reused_actual_loc>\n";
   }

   if($_GET['op'] == "delete_reused_object")
   {
      $object = new Object();
      $object = $object->get_object($_GET['objectid']);
      $program->delete_reuse($object->get_id());
      print "<reused_object_name>".$object->get_name($object->get_id())." (".$program->get_name($object->get_programid()).")</reused_object_name>\n";
   }

   if($_GET['op'] == "get_reused_object")
   {
      print "<reused_actual_loc>".$program->get_actual_reused_loc($_GET['objectid'])."</reused_actual_loc>\n";
   }

   if($_GET['op'] == "set_plan_time")
   {
      $phase = $program->get_all_phases();
      for($x = 0 ; $x < sizeof($phase) ; $x++)
         $old_phases[$x] = round($program->get_plan_time($phase[$x]));
      if($_GET['plan_time'] == "NaN" || $_GET['plan_time'] == $old_plan_time)
         print "<old_plan_time>".$program->get_plan_time()."</old_plan_time>\n";
      else
      {
         $program->set_plan_time($_GET['plan_time']);
         for($x = 0 ; $x < sizeof($phase) ; $x++)
            if($old_phases[$x] != round($program->get_plan_time($phase[$x])))
               print "<plan_phase phase='".$phase[$x]."'>".round($program->get_plan_time($phase[$x]))."</plan_phase>\n";
      }
      print "<focus>input_plan_time</focus>\n";
   }

   if($old_total_loc != $program->get_total_loc())
      print "<total_loc>".$program->get_total_loc()."</total_loc>\n";
   if($old_total_new_reuse != $program->get_total_new_reuse())
      print "<total_new_reuse>".$program->get_total_new_reuse()."</total_new_reuse>\n";
   if($old_est_total_new_reuse != $program->get_est_total_new_reuse())
      print "<est_total_new_reuse>".$program->get_est_total_new_reuse()."</est_total_new_reuse>\n";
   if($old_total_base != $program->get_total_new_base("base"))
      print "<total_base>".$program->get_total_new_base("base")."</total_base>\n";
   if($old_plan_total_base != $program->get_plan_total_new_base("base"))
      print "<plan_total_base>".round($program->get_plan_total_new_base("base"),1)."</plan_total_base>\n";
   if($old_total_new != $program->get_total_new_base("new"))
      print "<total_new>".$program->get_total_new_base("new")."</total_new>\n";
   if($old_plan_total_new != $program->get_plan_total_new_base("new") && $program->get_level() > 1)
      print "<plan_total_new>".round($program->get_plan_total_new_base("new"),1)."</plan_total_new>\n";
   if($old_plan_added != ($program->get_plan_newchg_loc() - $program->get_est_modified_loc()))
      print "<plan_added>".($program->get_plan_newchg_loc() - $program->get_est_modified_loc())."</plan_added>\n";
   if($old_added_loc != $program->get_added_loc())
      print "<added_loc>".$program->get_added_loc()."</added_loc>\n";
   if($old_base_loc != $program->get_base_loc())
      print "<base_loc>".$program->get_base_loc()."</base_loc>\n";
   if($old_est_base_loc != $program->get_est_base_loc())
      print "<est_base_loc>".$program->get_est_base_loc()."</est_base_loc>\n";
   if($old_deleted_loc != $program->get_deleted_loc())
      print "<deleted_loc>".$program->get_deleted_loc()."</deleted_loc>\n";
   if($old_est_deleted_loc != $program->get_est_deleted_loc())
      print "<est_deleted_loc>".$program->get_est_deleted_loc()."</est_deleted_loc>\n";
   if($old_modified_loc != $program->get_modified_loc())
      print "<modified_loc>".$program->get_modified_loc()."</modified_loc>\n";
   if($old_est_modified_loc != $program->get_est_modified_loc())
      print "<est_modified_loc>".$program->get_est_modified_loc()."</est_modified_loc>\n";
   if($old_to_date_reused_loc != $program->get_to_date_reused_loc())
      print "<to_date_reused_loc>".$program->get_to_date_reused_loc()."</to_date_reused_loc>\n";
   if($old_newchg_loc != $program->get_newchg_loc())
      print "<newchg_loc>".$program->get_newchg_loc()."</newchg_loc>\n";
   if($old_to_date_newchg_loc != $program->get_to_date_newchg_loc())
      print "<to_date_newchg_loc>".$program->get_to_date_newchg_loc()."</to_date_newchg_loc>\n";
   if($old_to_date_total_loc != $program->get_to_date_total_loc())
      print "<to_date_total_loc>".$program->get_to_date_total_loc()."</to_date_total_loc>\n";
   if($old_est_obj_loc != ($program->get_plan_total_new_base("base") + $program->get_plan_total_new_base("new") + $program->get_est_modified_loc()))
      print "<est_obj_loc>".round($program->get_estimated_object_loc(),1)."</est_obj_loc>\n";
   if($old_total_actual_reused_loc != $program->get_total_actual_reused_loc())
      print "<total_actual_reused_loc>".$program->get_total_actual_reused_loc()."</total_actual_reused_loc>\n";
   if($old_total_plan_reused_loc != $program->get_total_plan_reused_loc())
      print "<total_plan_reused_loc>".$program->get_total_plan_reused_loc()."</total_plan_reused_loc>\n";
   if($old_plan_newchg_loc != $program->get_plan_newchg_loc())
      print "<plan_newchg_loc>".$program->get_plan_newchg_loc()."</plan_newchg_loc>\n";
   if($old_plan_total_loc != $program->get_plan_total_loc())
      print "<plan_total_loc>".$program->get_plan_total_loc()."</plan_total_loc>\n";
   if($old_plan_time != $program->get_plan_time())
      print "<plan_time>".$program->get_plan_time()."</plan_time>\n";

   if($old_loc_per_hour != $program->get_loc_per_hour())
      print "<loc_per_hour>".round($program->get_loc_per_hour(),1)."</loc_per_hour>\n";
   if($old_to_date_loc_per_hour != $program->get_to_date_loc_per_hour())
      print "<to_date_loc_per_hour>".round($program->get_to_date_loc_per_hour(),1)."</to_date_loc_per_hour>\n";
   if($old_range_size != $program->get_range_size())
      print "<range_size>".$program->get_range_size()."</range_size>\n";
   if($old_range_time != $program->get_range_time())
      print "<range_time>".$program->get_range_time()."</range_time>\n";
   if($old_probe_est_method_loc != $program->get_probe_method_loc())
      print "<probe_est_method_loc>".$program->get_probe_method_loc()."</probe_est_method_loc>\n";
   if($old_probe_est_method_time != $program->get_probe_method_time())
      print "<probe_est_method_time>".$program->get_probe_method_time()."</probe_est_method_time>\n";
   if($old_plan_newchg_loc != $program->get_plan_newchg_loc())
      print "<plan_newchg_loc>".$program->get_plan_newchg_loc()."</plan_newchg_loc>\n";
   if($old_plan_loc_per_hour != $program->get_plan_loc_per_hour())
      print "<plan_loc_per_hour>".round($program->get_plan_loc_per_hour(),1)."</plan_loc_per_hour>\n";
   if($old_reused_loc != $program->get_reused_loc())
      print "<reused_loc>".$program->get_reused_loc()."</reused_loc>\n";
   if($old_b0_size != $program->get_b0_size())
      print "<b0_size>".$program->get_b0_size_display()."</b0_size>\n";
   if($old_b1_size != $program->get_b1_size())
      print "<b1_size>".$program->get_b1_size_display()."</b1_size>\n";
   if($old_b0_time != $program->get_b0_time())
      print "<b0_time>".$program->get_b0_time_display()."</b0_time>\n";
   if($old_b1_time != $program->get_b1_time())
      print "<b1_time>".$program->get_b1_time_display()."</b1_time>\n";
   if($old_range_size != $program->get_range_size())
      print "<range_size>".$program->get_range_size()."</range_size>\n";
   if($old_range_time != $program->get_range_time())
      print "<range_time>".$program->get_range_time()."</range_time>\n";
   if($old_probe_plan_time != $program->get_probe_plan_time())
      print "<probe_plan_time>".round($program->get_probe_plan_time(),1)."</probe_plan_time>\n";
   if($old_upper_interval_size != $program->get_upper_interval_size())
      print "<upper_interval_size>".round($program->get_upper_interval_size(),1)."</upper_interval_size>\n";
   if($old_lower_interval_size != $program->get_lower_interval_size())
      print "<lower_interval_size>".round($program->get_lower_interval_size(),1)."</lower_interval_size>\n";
   if($old_upper_interval_time != $program->get_upper_interval_time())
      print "<upper_interval_time>".round($program->get_upper_interval_time(),1)."</upper_interval_time>\n";
   if($old_lower_interval_time != $program->get_lower_interval_time())
      print "<lower_interval_time>".round($program->get_lower_interval_time(),1)."</lower_interval_time>\n";
   if($old_probe_plan_newchg_loc != $program->get_probe_plan_newchg_loc())
      print "<probe_plan_newchg_loc>".round($program->get_probe_plan_newchg_loc(),1)."</probe_plan_newchg_loc>\n";
   if($old_probe_plan_total_loc != $program->get_probe_plan_total_loc())
      print "<probe_plan_total_loc>".round($program->get_probe_plan_total_loc(),1)."</probe_plan_total_loc>\n";

   if($old_to_date_plan_time != $program->get_to_date_plan_time())
      print "<to_date_plan_time>".$program->get_to_date_plan_time()."</to_date_plan_time>\n";
   if($old_CPI != $program->get_CPI())
      print "<CPI>".round($program->get_CPI(),3)."</CPI>\n";
   if($old_percent_plan_new_reuse != $program->get_percent_plan_new_reuse())
      print "<percent_plan_new_reuse>".round($program->get_percent_plan_new_reuse(),1)."</percent_plan_new_reuse>\n";
   if($old_percent_new_reuse != $program->get_percent_new_reuse())
      print "<percent_new_reuse>".round($program->get_percent_new_reuse(),1)."</percent_new_reuse>\n";
   if($old_to_date_percent_new_reuse != $program->get_to_date_percent_new_reuse())
      print "<to_date_percent_new_reuse>".round($program->get_to_date_percent_new_reuse(),1)."</to_date_percent_new_reuse>\n";
   if($old_percent_plan_reused_loc != $program->get_percent_plan_reused_loc())
      print "<percent_plan_reused_loc>".round($program->get_percent_plan_reused_loc(),1)."</percent_plan_reused_loc>\n";
   if($old_percent_reused_loc != $program->get_percent_reused_loc())
      print "<percent_reused_loc>".round($program->get_percent_reused_loc(),1)."</percent_reused_loc>\n";
   if($old_to_date_percent_reused_loc != $program->get_to_date_percent_reused_loc())
      print "<to_date_percent_reused_loc>".round($program->get_to_date_percent_reused_loc(),1)."</to_date_percent_reused_loc>\n";

   if($old_plan_test_defects_per_kloc != round($program->get_plan_defects_per_kloc("Test"),1))
      print "<plan_test_defects_per_kloc>".round($program->get_plan_defects_per_kloc("Test"),1)."</plan_test_defects_per_kloc>\n";
   if($old_test_defects_per_kloc != round($program->get_defects_per_kloc("Test"),1))
      print "<test_defects_per_kloc>".round($program->get_defects_per_kloc("Test"),1)."</test_defects_per_kloc>\n";
   if($old_to_date_test_defects_per_kloc != round($program->get_to_date_defects_per_kloc("Test"),1))
      print "<to_date_test_defects_per_kloc>".round($program->get_to_date_defects_per_kloc("Test"),1)."</to_date_test_defects_per_kloc>\n";
   if($old_plan_total_defects_per_kloc != round($program->get_plan_defects_per_kloc(),1))
      print "<plan_total_defects_per_kloc>".round($program->get_plan_defects_per_kloc(),1)."</plan_total_defects_per_kloc>\n";
   if($old_total_defects_per_kloc != round($program->get_defects_per_kloc(),1))
      print "<total_defects_per_kloc>".round($program->get_defects_per_kloc(),1)."</total_defects_per_kloc>\n";
   if($old_total_to_date_defects_per_kloc != round($program->get_to_date_defects_per_kloc(),1))
      print "<total_to_date_defects_per_kloc>".round($program->get_to_date_defects_per_kloc(),1)."</total_to_date_defects_per_kloc>\n";

   if($old_plan_defects_per_hour_Design_Review != round($program->get_plan_defects_per_hour("Design Review"), 2))
      print "<plan_defects_per_hour phase='Design_Review'>".round($program->get_plan_defects_per_hour("Design Review"), 2)."</plan_defects_per_hour>\n";
   if($old_plan_defects_per_hour_Code_Review != round($program->get_plan_defects_per_hour("Code Review"), 2))
      print "<plan_defects_per_hour phase='Code_Review'>".round($program->get_plan_defects_per_hour("Code Review"), 2)."</plan_defects_per_hour>\n";
   if($old_plan_defects_per_hour_Compile != round($program->get_plan_defects_per_hour("Compile"), 2))
      print "<plan_defects_per_hour phase='Compile'>".round($program->get_plan_defects_per_hour("Compile"), 2)."</plan_defects_per_hour>\n";
   if($old_plan_defects_per_hour_Test != round($program->get_plan_defects_per_hour("Test"), 2))
      print "<plan_defects_per_hour phase='Test'>".round($program->get_plan_defects_per_hour("Test"), 2)."</plan_defects_per_hour>\n";

   print "<level>".$program->get_level()."</level>\n";
print "<db>".$_SESSION['sql_count']."</db>\n";
   print "</xml>\n";

?>
