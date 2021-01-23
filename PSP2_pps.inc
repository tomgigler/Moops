<?php
   print "   <script language='JavaScript' src='javascripts/summary_psp0.js'></script>\n";

   print "   <center>\n";
   print "      <table width=80%>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b>Summary</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b>Plan</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b>Actual</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b>To Date</b>\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               LOC/Hour\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_loc_per_hour' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_loc_per_hour(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_loc_per_hour' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_loc_per_hour(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_loc_per_hour' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_loc_per_hour(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               Planned Time\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_time' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_plan_time()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_plan_time' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_plan_time()."\n";
   else
      print "               &nbsp;\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               Actual Time\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td/>\n";
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
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               CPI (Cost-Performance Index)\n";
   print "            </td>\n";
   print "            <td colspan=5 />\n";
   print "            <td id='td_CPI' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_CPI(),3)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td colspan=6 />\n";
   print "            <td class=td_hints>\n";
   print "               (Planned/Actual)\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               % Reused\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_percent_plan_reused_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_percent_plan_reused_loc(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_percent_reused_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_percent_reused_loc(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_percent_reused_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_percent_reused_loc(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               % New Reusable\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_percent_plan_new_reuse' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_percent_plan_new_reuse(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_percent_new_reuse' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_percent_new_reuse(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_percent_new_reuse' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_percent_new_reuse(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Test Defects/KLOC</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_test_defects_per_kloc' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_defects_per_kloc("Test"),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_test_defects_per_kloc' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_defects_per_kloc("Test"),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_test_defects_per_kloc' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_defects_per_kloc("Test"),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Total Defects/KLOC</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_total_defects_per_kloc' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_defects_per_kloc(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_total_defects_per_kloc' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_defects_per_kloc(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_total_to_date_defects_per_kloc' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_defects_per_kloc(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Yield %</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_yield' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_yield(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_actual_yield' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_actual_yield(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_yield' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_yield(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>&nbsp;</td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b>Program Size (LOC)</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b>Plan</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b>Actual</b>\n";
   print "            </td>\n";
   print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
   print "            <td class=td_center>\n";
   print "               <b>To Date</b>\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               Base (B)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_est_base_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_base_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Measured)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Measured)\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp;&nbsp; Deleted (D)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_est_deleted_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_deleted_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Estimated)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Counted)\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp;&nbsp; Modified (M)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_est_modified_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_modified_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Estimated)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Counted)\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp;&nbsp; Added (A)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_added' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_plan_newchg_loc() - $program->get_est_modified_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_added_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_added_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td>\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (N-M)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (T-B+D-R)\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               &nbsp;&nbsp;&nbsp; Reused (R)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_total_plan_reused_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_reused_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_reused_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Estimated)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Counted)\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               New and Changed (N)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($print_mode)
      if($program != 0)
         print "$program->get_plan_newchg_loc()\n";
      else
         print "               &nbsp;\n";
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
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Estimated)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (A+M)\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               Total LOC (T)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_total_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_plan_total_loc()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($print_mode)
      if($program != 0)
         print "$program->get_total_loc()\n";
      else
         print "               &nbsp;\n";
   else
   {
      print "            <input id='input_total_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"total_loc\",".$program->get_id().", this.value)'";
      print " onchange='set_value(\"total_loc\",".$program->get_id().", this.value)' value='".$program->get_total_loc()."'/>\n";
   }
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_to_date_total_loc' class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_total_loc($program->get_number())."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td/>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (N+B-M-D+R)\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_hints>\n";
   print "               (Measured)\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               Total New Reusable\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_est_total_new_reuse(),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_total_new_reuse()."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_new_reuse($program->get_number())."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>UPI (70%)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>LPI (70%)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
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
         print "               ".round($program->get_to_date_time($p))."\n";
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
      if($program != 0)
         print "$program->get_plan_time()\n";
      else
         print "               &nbsp;\n";
   else
   {
      print "            <input id='input_plan_time' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"plan_time\",".$program->get_id().", this.value)'";
      print " onchange='set_value(\"plan_time\",".$program->get_id().", this.value)' value='".$program->get_plan_time()."'/>\n";
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
      print "               ".round($program->get_to_date_percent(), 1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Total Time UPI (70%)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";

   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Total Time LPI (70%)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
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
   print "            <td class=td_center>\n";
   print "               <b><i>Plan</i></b>\n";
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
      print "            <td id='td_plan_injected_".$phases[$x]."' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_plan_injected($phases[$x]),1)."\n";
      else
         print "               &nbsp;\n";
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
   print "            <td id='td_total_plan_injected' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_injected(),1)."\n";
   else
      print "               &nbsp;\n";
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
   print "            <td class=td_center>\n";
   print "               <b><i>Plan</i></b>\n";
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
      print "            <td id='td_plan_remove_".$phases[$x]."' class=td_underscore>\n";
      if($program != 0)
         print "               ".round($program->get_plan_remove($phases[$x]),1)."\n";
      else
         print "               &nbsp;\n";
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
   print "            <td id='td_total_plan_remove' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_remove(),1)."\n";
   else
      print "               &nbsp;\n";
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
   print "            <td id='td_plan_remove_Postmortem' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_remove("Postmortem"),1)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_actual_removed('Postmortem')."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".$program->get_to_date_removed('Postmortem')."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "      </table>\n";

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

   print "      <table width=80%>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Defect Removal Efficiency</i></b>\n";
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
   print "               <b><i>Defects/Hour - Design Review</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_defects_per_hour_Design Review' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_defects_per_hour('Design Review'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_actual_defects_per_hour('Design Review'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_defects_per_hour('Design Review'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Defects/Hour - Code Review</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_defects_per_hour_Code Review' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_defects_per_hour('Code Review'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_actual_defects_per_hour('Code Review'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_defects_per_hour('Code Review'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Defects/Hour - Compile</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_defects_per_hour_Compile' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_defects_per_hour('Compile'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_actual_defects_per_hour('Compile'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_defects_per_hour('Compile'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>Defects/Hour - Test</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_defects_per_hour_Test' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_defects_per_hour('Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_actual_defects_per_hour('Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_defects_per_hour('Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>DRL (DLDR/UT)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_DRL_DLDR_UT' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_DRL('Design Review', 'Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_actual_DRL('Design Review', 'Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_DRL('Design Review', 'Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>DRL (Code Review/UT)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_DRL_CR_UT' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_DRL('Code Review', 'Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_actual_DRL('Code Review', 'Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_DRL('Code Review', 'Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "         <tr>\n";
   print "            <td>\n";
   print "               <b><i>DRL (Compile/UT)</i></b>\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td id='td_plan_DRL_Compile_UT' class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_plan_DRL('Compile', 'Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_actual_DRL('Compile', 'Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "            <td/>\n";
   print "            <td class=td_underscore>\n";
   if($program != 0)
      print "               ".round($program->get_to_date_DRL('Compile', 'Test'),2)."\n";
   else
      print "               &nbsp;\n";
   print "            </td>\n";
   print "         </tr>\n";
   print "      </table>\n";

   print "   </center>\n";
?>
