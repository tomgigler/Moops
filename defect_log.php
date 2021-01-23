<?php

require_once "Program.php";
 
   session_start();

   include "verify.inc";

   $title = "Defect Recording Log";

   include "header.inc";

   print "   <script language='JavaScript' src='javascripts/defect_log.js'></script>\n";

   $defect = new Defect();

   if(!isset($print_mode))
   {
      $all = $program->get_all_defects();

      // Data input form
      $today = $defect->get_last_defect_date($program->get_id());
      print "   <center>\n";
      print "   <table>\n";
      print "      <tr>\n";
      print "         <td>\n";
      print "            <b>Date</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Type</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Inject</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Remove</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Fix Time</b>\n";
      print "         </td>\n";
      print "         <td>\n";
      print "            <b>Fix Ref.</b>\n";
      print "         </td>\n";
      print "      </tr>\n";
      print "      <tr>\n";
      print "         <td class=td_defect_box_input>\n";
      print "            <input id='input_date' size=8 value='".$today."' onkeypress='capture_keypress(event, create_defect, 0, 0, 0, ".$program->get_id().")'/>\n";
      print "         </td>\n";
      print "         <td class=td_defect_box_input>\n";
      print "            <select id='select_type' onkeypress='capture_keypress(event, create_defect, 0, 0, 0, ".$program->get_id().")'>\n";
      print "               <option value='10'>10</option>\n";
      print "               <option value='20'>20</option>\n";
      print "               <option value='30'>30</option>\n";
      print "               <option value='40'>40</option>\n";
      print "               <option value='50'>50</option>\n";
      print "               <option value='60'>60</option>\n";
      print "               <option value='70'>70</option>\n";
      print "               <option value='80'>80</option>\n";
      print "               <option value='90'>90</option>\n";
      print "               <option value='100'>100</option>\n";
      print "            </select>\n";
      print "         </td>\n";
      $phases = $program->get_all_phases();
      print "         <td class=td_defect_box_input>\n";
      print "            <select id='select_inject_phase' onkeypress='capture_keypress(event, create_defect, 0, 0, 0, ".$program->get_id().")'>\n";
      for($x = 0 ; $x < sizeof($phases) - 1 ; $x++)
         print "               <option value='".$phases[$x]."'>".$phases[$x]."</option>\n";
      print "            </select>\n";
      print "         </td>\n";
      print "         <td class=td_defect_box_input>\n";
      print "            <select id='select_remove_phase' onkeypress='capture_keypress(event, create_defect, 0, 0, 0, ".$program->get_id().")'>\n";
      print "               <option value=''></option>\n";
      for($x = 0 ; $x < sizeof($phases) - 1 ; $x++)
         print "               <option value='".$phases[$x]."'>".$phases[$x]."</option>\n";
      print "               <option value='".$phases[$x]."'>After Development</option>\n";
      print "            </select>\n";
      print "         </td>\n";
      print "         <td class=td_defect_box_input>\n";
      print "            <input id='input_fixtime' size=4 value='0' onkeypress='capture_keypress(event, create_defect, 0, 0, 0, ".$program->get_id().")'/>\n";
      print "         </td>\n";
      print "         <td class=td_defect_box_input>\n";
      print "            <select id='select_fixref' onkeypress='capture_keypress(event, create_defect, 0, 0, 0, ".$program->get_id().")'>\n";
      print "               <option id='option_fixref_none' value=0>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>\n";
      for($x = 0 ; $x < sizeof($all) ; $x++)
         print "               <option value='".$all[$x]->number."'>".$all[$x]->number."</option>\n";
      print "            </select>\n";
      print "         </td>\n";
      print "      </tr>\n";
      print "         <td align=right>\n";
      print "            Description:\n";
      print "         </td>\n";
      print "         <td class=td_underscore colspan=6>\n";
      print "            <input id='input_description' size=100% onkeypress='capture_keypress(event, create_defect, 0, 0, 0, ".$program->get_id().")'/>\n";
      print "         </td>\n";
      print "         <td colspan=6 align=center>\n";
      print "            <button id='button_submit' onClick='create_defect(".$program->get_id().")'>\n";
      print "               Submit\n";
      print "            </button>\n";
      print "         </td>\n";
      print "      </tr>\n";
      print "   </table>\n";
      print "   </center>\n";

   }

   print "  <div id='div_defect_log'";
   if(sizeof($all) == 0 && !isset($print_mode)) print " style='display:none'";
   print ">\n";

   // Data display table
   print "   <center>\n";
   if(!$print_mode)
      print "   <br><br><br>\n";
   print "   <table id='table_defect_log' class=defect_log>\n";
   if(sizeof($all))
   {

      for($x = 0 ; $x < sizeof($all) ; $x++)
      {
         print "      <tr id='defect_id_".$all[$x]->id."'>\n";
         print "         <td>\n";
         print "            Date\n";
         print "         </td>\n";
         print "         <td>\n";
         print "            Number\n";
         print "         </td>\n";
         print "         <td>\n";
         print "            Type\n";
         print "         </td>\n";
         print "         <td>\n";
         print "            Inject\n";
         print "         </td>\n";
         print "         <td>\n";
         print "            Remove\n";
         print "         </td>\n";
         print "         <td>\n";
         print "            Fix Time\n";
         print "         </td>\n";
         print "         <td>\n";
         print "            Fix Ref.\n";
         print "         </td>\n";
         print "      </tr>\n";
         print "      <tr>\n";
         print "         <td id='defect_date_".$all[$x]->id."' class=td_defect_box>\n";
         print "            ".$all[$x]->date."\n";
         print "         </td>\n";
         print "         <td id='defect_number_".$all[$x]->id."' class=td_defect_box>\n";
         print "            ".$all[$x]->number."\n";
         print "         </td>\n";
         print "         <td id='defect_type_".$all[$x]->id."' class=td_defect_box>\n";
         print "            ".$all[$x]->type."\n";
         print "         </td>\n";
         print "         <td id='defect_inject_phase_".$all[$x]->id."' class=td_defect_box>\n";
         print "            ".ucwords($all[$x]->inject_phase)."\n";
         print "         </td>\n";
         print "         <td id='defect_remove_phase_".$all[$x]->id."'class=td_defect_box>\n";
         if($all[$x]->remove_phase)
            print "            ".ucwords($all[$x]->remove_phase)."\n";
         else
            print "            &nbsp;\n";
         print "         </td>\n";
         print "         <td id='defect_fixtime_".$all[$x]->id."' class=td_defect_box>\n";
         print "            ".$all[$x]->fixtime."\n";
         print "         </td>\n";
         print "         <td id='defect_fixref_".$all[$x]->id."'class=td_defect_box>";
         if($all[$x]->fixref)
            print "            ".$all[$x]->fixref."\n";
         else
            print "&nbsp;";
         print "</td>\n";
         if(!isset($print_mode))
         {
            print "         <td>\n";
            print "            <button onClick='edit_defect(".$program->get_id().",".$all[$x]->id.")'>\n";
            print "               Edit\n";
            print "            </button>\n";
            print "         </td>\n";
         }
         print "      </tr>\n";
         print "      <tr>\n";
         print "         <td align=right>\n";
         print "            Description:\n";
         print "         </td>\n";
         print "         <td id='defect_description_".$all[$x]->id."' class=td_underscore_left colspan=6>\n";
         if($all[$x]->description != "")
            print "            ".$all[$x]->description."\n";
         else
            print "            &nbsp;\n";
         print "         </td>\n";
         if(!isset($print_mode))
         {
            print "         <td>\n";
            print "            <button onClick='delete_defect(".$program->get_id().",".$all[$x]->id.")'>\n";
            print "               Delete\n";
            print "            </button>\n";
            print "         </td>\n";
         }
         print "      </tr>\n";
         print "      <tr>\n";
         print "         <td>\n";
         print "            &nbsp;\n";
         print "         </td>\n";
         print "      </tr>\n";
      }
   }
   // in print mode display at least 7 rows
   if(isset($print_mode))
   {
      if(sizeof($all) < 7)
      {
         for($x = 0 ; $x < 7 - sizeof($all) ; $x++)
         {
            print "      <tr>\n";
            print "         <td>\n";
            print "            Date\n";
            print "         </td>\n";
            print "         <td>\n";
            print "            Number\n";
            print "         </td>\n";
            print "         <td>\n";
            print "            Type\n";
            print "         </td>\n";
            print "         <td>\n";
            print "            Inject\n";
            print "         </td>\n";
            print "         <td>\n";
            print "            Remove\n";
            print "         </td>\n";
            print "         <td>\n";
            print "            Fix Time\n";
            print "         </td>\n";
            print "         <td>\n";
            print "            Fix Ref.\n";
            print "         </td>\n";
            print "      </tr>\n";
            for($y = 0 ; $y < 7 ; $y++) print "<td class=td_defect_box>&nbsp;</td>\n";
            print "      <tr>\n";
            print "      </tr>\n";
            print "         <td align=right>\n";
            print "            Description:\n";
            print "         </td>\n";
            print "         <td class=td_underscore_left colspan=6>\n";
            print "            &nbsp;\n";
            print "         </td>\n";
            print "      </tr>\n";
            print "      <tr>\n";
            print "         <td>\n";
            print "            &nbsp;\n";
            print "         </td>\n";
            print "      </tr>\n";
         }
      }
   }
   print "   </table>\n";
   print "   </center>\n";
   print "   </div>\n";

   include "footer.inc";

?> 
