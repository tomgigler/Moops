<?php


   print "   <script language='JavaScript' src='javascripts/ajax.js'></script>\n";
   print "   <script language='JavaScript' src='javascripts/summary_psp0.js'></script>\n";

   print "   <center>\n";
   print "      <table width=80%>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Program Size (LOC)</i></b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b><i>Plan</i></b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b><i>Actual</i></b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b><i>To Date</i></b>\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Base (B)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($print_mode)
   {
      if($program != 0)
         print $program->get_base_loc()."\n";
      else
         print "&nbsp;\n";
   }
   else
   {
      print "            <input id='input_base_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"base_loc\",".$program->get_id().", this.value)'";
      print " onchange='set_value(\"base_loc\",".$program->get_id().", this.value)' value='".$program->get_base_loc()."'/>\n";
   }
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "         <tr/>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Measured)\n";
   print "            </td>\n";
   print "         <tr/>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>&nbsp;&nbsp;&nbsp; Deleted (D)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($print_mode)
   {
      if($program != 0)
         print $program->get_deleted_loc()."\n";
      else
         print "&nbsp;\n";
   }
   else
   {
      print "            <input id='input_deleted_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"deleted_loc\",".$program->get_id().", this.value)'";
      print " onchange='set_value(\"deleted_loc\",".$program->get_id().", this.value)' value='".$program->get_deleted_loc()."'/>\n";
   }
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "         <tr/>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Counted)\n";
   print "            </td>\n";
   print "         <tr/>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>&nbsp;&nbsp;&nbsp; Modified (M)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($print_mode)
   {
      if($program != 0)
         print $program->get_modified_loc()."\n";
      else
         print "&nbsp;\n";
   }
   else
   {
      print "            <input id='input_modified_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"modified_loc\",".$program->get_id().",this.value)'";
      print " onchange='set_value(\"modified_loc\",".$program->get_id().",this.value)' value='".$program->get_modified_loc()."'/>\n";
   }
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "         <tr/>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Counted)\n";
   print "            </td>\n";
   print "         <tr/>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>&nbsp;&nbsp;&nbsp; Added (A)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_added_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".($program->get_total_loc()-$program->get_base_loc()+$program->get_deleted_loc()-$program->get_reused_loc())."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "         <tr/>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (T-B+D-R)\n";
   print "            </td>\n";
   print "         <tr/>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>&nbsp;&nbsp;&nbsp; Reused (R)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($print_mode)
   {
      if($program != 0)
         print $program->get_reused_loc()."\n";
      else
         print "&nbsp;\n";
   }
   else
   {
      print "            <input id='input_reused_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"reused_loc\",".$program->get_id().",this.value)'";
      print " onchange='set_value(\"reused_loc\",".$program->get_id().",this.value)' value='".$program->get_reused_loc()."'/>\n";
   }
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_reused_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_reused_loc($_SESSION['USER'],$program->get_number())."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         <tr/>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Counted)\n";
   print "            </td>\n";
   print "         <tr/>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>New and Changed (N)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($print_mode)
   {
      if($program != 0)
         print $program->get_plan_newchg_loc()."\n";
      else
         print "&nbsp;\n";
   }
   else
   {
      print "            <input id='input_plan_newchg_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"plan_newchg_loc\",".$program->get_id().", this.value)'";
      print " onchange='set_value(\"plan_newchg_loc\",".$program->get_id().", this.value)' value='".$program->get_plan_newchg_loc()."'/>\n";
   }
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_newchg_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_newchg_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_newchg_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_newchg_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         <tr/>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (A+M)\n";
   print "            </td>\n";
   print "         <tr/>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Total LOC (T)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($print_mode)
   {
      if($program != 0)
         print $program->get_total_loc()."\n";
      else
         print "&nbsp;\n";
   }
   else
   {
      print "            <input id='input_total_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"total_loc\",".$program->get_id().",this.value)'";
      print " onchange='set_value(\"total_loc\",".$program->get_id().",this.value)' value='".$program->get_total_loc()."'/>\n";
   }
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_total_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_total_loc($_SESSION['USER'],$program->get_number())."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         <tr/>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Measured)\n";
   print "            </td>\n";
   print "         <tr/>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Total New Reusable</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_total_new_reuse()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_new_reuse' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_new_reuse($_SESSION['USER'],$program->get_number())."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "      <table/>\n";
   print "   <center/>\n";

   print "   <br><br><br>\n";

   print "   <center>\n";
   print "      <table width=80%>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               <b>Time in Phase (min.)</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b>Plan</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            </td>\n";
   print "            <td class=td_center>\n";
   print "               <b>Actual</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td>\n";
   print "               <b>To Date</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b>To Date %</b>\n";
   print "            </td>\n";
   print "         </tr>\n";

   if($program != 0)
      $phases = $program->get_all_phases();
   foreach($phases as $p)
   {
      print "         <tr>\n";
      print "            <td>\n";
      print "               &nbsp;&nbsp; ".$p."\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td id='td_plan_".$p."' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_plan_time($p))."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_actual_time($p))."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_to_date_time($p)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_to_date_percent($p),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";
   }

   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp;&nbsp;&nbsp; Total\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($print_mode)
   {
      if($program != 0)
         print $program->get_plan_time()."\n";
      else
         print "&nbsp;\n";
   }
   else
   {
      print "            <input id='input_plan_time' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"plan_time\",".$program->get_id().",this.value)'";
      print " onchange='set_value(\"plan_time\",".$program->get_id().",this.value)' value='".$program->get_plan_time()."'/>\n";
   }
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_actual_time()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_time()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($time_to_date_percent = $program->get_to_date_percent(), 1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>&nbsp;</td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>&nbsp;</td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b>Defects Injected</b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_center>\n";
   print "               <b>Actual</b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_center>\n";
   print "               <b>To Date</b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_center>\n";
   print "               <b>To Date %</b>\n";
   print "            </td>\n";
   print "         </tr>\n";

   for($x = 0 ; $x < sizeof($phases) - 1 ; $x++)
   {
      print "         <tr>\n";
      print "            <td>\n";
      print "               &nbsp;&nbsp; ".$phases[$x]."\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td>\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_actual_injected($phases[$x])."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_to_date_injected($phases[$x])."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_to_date_injected_percent($phases[$x]),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";
      print "         </tr>\n";
   }

   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp;&nbsp;&nbsp; Total Development\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_actual_injected()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_injected()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_injected_percent(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b>Defects Removed</b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_center>\n";
   print "               <b>Actual</b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_center>\n";
   print "               <b>To Date</b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_center>\n";
   print "               <b>To Date %</b>\n";
   print "            </td>\n";
   print "         </tr>\n";

   for($x = 0 ; $x < sizeof($phases) - 1 ; $x++)
   {
      print "         <tr>\n";
      print "            <td>\n";
      print "               &nbsp;&nbsp; ".$phases[$x]."\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td>\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_actual_removed($phases[$x])."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program != 0)
         print "               ".$program->get_to_date_removed($phases[$x])."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_to_date_removed_percent($phases[$x]),1)."\n";
      else
         print "               &nbsp;\n";
      print "            </td>\n";
      print "         </tr>\n";
   }
   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp;&nbsp;&nbsp; Total Development\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_actual_removed()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_removed()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_removed_percent(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp; After Development\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_actual_removed('postmortem')."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_removed('postmortem')."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "      </table>\n";
   print "   </center>\n";
?>
