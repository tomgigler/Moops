<?php

require_once "Program.php";
 
   session_start();

   include "verify.inc";

   if($program != 0)
      $title = $program->get_level_name()." Project Plan Summary";
   else if(isset($_GET['psp']))
      $title = $_GET['psp']." Project Plan Summary";
   else exit;

   include "header.inc";

   print "   <script language='JavaScript' src='javascripts/summary_psp0.js'></script>\n";

   if($program != 0)
      include $program->get_level_name()."_pps.inc";
   else if(isset($_GET['psp']))
   {
      if($_GET['psp'] == "PSP2" || $_GET['psp'] == "PSP2.1" || $_GET['psp'] == "PSP3")
         $phases = array("Planning", "Design", "Design Review", "Code", "Code Review", "Compile", "Test", "Postmortem");
      else
         $phases = array("Planning", "Design", "Code", "Compile", "Test", "Postmortem");
      include $_GET['psp']."_pps.inc";
   }

   include "footer.inc";

?> 
