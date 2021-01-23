<?php

   print "   <script language='JavaScript' src='javascripts/summary_psp0.js'></script>\n";

   if(!$print_mode)
   {
      print "   <center>\n";
      print "      <table width=80%>\n";
      print "         <tr>\n";
      print "            <td>\n";
      print "            </td>\n";
      print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
      print "            <td class=td_center>\n";
      print "            </td>\n";
      print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
      print "            <td class=td_center>\n";
      print "               <b><i>Actual</i></b>\n";
      print "            </td>\n";
      print "            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
      print "            <td class=td_center>\n";
      print "            </td>\n";
      print "         </tr>\n";
      print "         <tr>\n";
      print "            <td>\n";
      print "               <b><i>Total LOC (T)</i></b>\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td>\n";
      print "            </td>\n";
      print "            <td/>\n";
      print "            <td class=td_underscore>\n";
      print "            <input id='input_total_loc' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"total_loc\",".$program->get_id().", this.value)'";
      print " onchange='set_value(\"total_loc\",".$program->get_id().", this.value)' value='".$program->get_total_loc()."'/>";
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
      print "      <table/>\n";
      print "   <center/>\n";
      print "   <br><br><br>\n";
   }

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
      print "            <td>\n";
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
         print "               ".round($program->get_to_date_percent($p), 1)."\n";
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
      if($program != 0 && $program->get_plan_time() != NULL)
         print $program->get_plan_time()."\n";
      else
         print "&nbsp;\n";
   }
   else
   {
      print "            <input id='input_plan_time' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"plan_time\",".$program->get_id().", this.value)'";
      print " onchange='set_value(\"plan_time\",".$program->get_id().", this.value)' value='".$program->get_plan_time()."'/>";
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
