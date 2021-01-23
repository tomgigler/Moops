<?php

$_SESSION['sql_count'] = 0;
   print "<html>\n";
   print "<head>\n";
   print "   <link rel=stylesheet type=text/css href=\"style.css\"/>\n";
   print "   <script language='JavaScript' src='javascripts/ajax.js'></script>\n";
   if($program)
      print "   <title>Moops - " . $program->get_name() . "</title>\n";
   else
      print "   <title>Moops</title>\n";

   print "</head>\n";
   if($program)
      print "<body onload='load(".$program->get_id().")'>\n";
   else
      print "<body>\n";
/*
   if(!isset($print_mode))
   {
      print "   <div id='top'>\n";
      print "      <img src='moops.jpg' />\n";
      print "   </div>\n";
   }
*/
   if(!isset($print_mode))
   {
      print "   <div>\n";
      if(isset($_SESSION['USER']))
      {
         print "      <a href='home.php'>Home</a>\n";
         if(isset($_GET['prog']))
         {
            print "      <a href='summary.php?prog=" .  $program->get_id() . "'>Summary</a>\n";
            print "      <a href='time_log.php?prog=" .  $program->get_id() . "'>Time Log</a>\n";
            print "      <a href='defect_log.php?prog=" . $program->get_id() . "'>Defect Log</a>\n";
            print "      <a href='size_est_template.php?prog=".$program->get_id()."'>Size Est Template</a>\n";
            if($program->get_level() > 1)
               print "      <a href='object_size_category.php?prog=".$program->get_id()."'>Object Category Sizes</a>\n";
            if($program->get_level() > 2)
            {
               print "      <a href='task_plan_template.php?prog=".$program->get_id()."'>Task Planning Template</a>\n";
               print "      <a href='schedule_plan_template.php?prog=".$program->get_id()."'>Schedule Planning Template</a>\n";
            }
            print "      <a href='?prog=" .  $program->get_id() . "&print=1' target='_blank'>Print</a>\n";
         }
         print "      <a href='profile.php'>Profile</a>\n";
         print "      <a href='logout.php'>Logout</a>\n";

         print "      <p align=\"right\">\n";
         print "      <b>Logged in as " . $_SESSION['USER'] . "&nbsp;&nbsp;&nbsp;&nbsp;</b>\n";
         print "      </p>\n";
      }
      else if(isset($logging_out)) print "      <a href='index.php'>Login</a>\n";
      print "   </div>\n";

      print "   <div id='message'>&nbsp;</div>\n";
   }

   if($print_mode) print "<br><br>\n";
   print "   <center>\n";
   if($program)
      print "      <h2>" . $program->get_name() . " - ".$title."</h2>\n";
   else
      print "      <h2>".$title."</h2>\n";
   print "   </center>\n";
   print "<br><br>\n";
?>
