<?php

require_once "../Program.php";
require_once "../Level.php";
 
   session_start();
   $host = $_SERVER['HTTP_HOST'];
   $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
   if (!isset($_SESSION['USER'])) 
   {
      header("Location: http://$host$uri/index.php");
      exit;
   }

   $program = new Program();
   $level = new Level();

   print "<xml>\n";

   switch($_GET['op'])
   {
      case "create":
         if($id = $program->exists($_SESSION['USER'], $_GET['progname']))
         {
            print "<alert>Program ".$_GET['progname']." already exists!</alert><id>".$id."</id>\n";
            print "<highlight>tr_program_".$id."</highlight>\n";
            print "<focus>input_program_name</focus>\n";
         }
         else if(preg_match("/\"/", $_GET['progname']) || preg_match("/'/", $_GET['progname']))
         {
            print "<alert>Quote characters not allowed in program name!</alert>\n";
            print "<highlight>input_program_name</highlight>\n";
            print "<focus>input_program_name</focus>\n";
         }
         else
         {
            $id = $program->create($_SESSION['USER'], $_GET['progname'], $_GET['level']);
            $program = $program->get_program($id);
            $number = $program->get_number();
            print "<id>".$id."</id><number>".$number."</number><level>".$level->get_level_name($_GET['level']);
            print "</level><message color='green'>Created program ".$_GET['progname']."</message>\n";
         }
         break;

      case "delete":
         $program = $program->get_program($_GET['prog']);

         // if this program is not owned by the current user, don't allow delete
         if($program->get_username() != $_SESSION['USER'])
         {
            print "<alert>Cannot delete this program</alert>\n";
         }

         // else if this program contains objects that are being reused, don't allow delete
         else if($all = $program->get_programs_reusing_objects())
         {
            print "<alert>Cannot delete \"".$program->get_name()."\"!  It contains objects being reused by program";
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
         else
         {
            $program->delete($_GET['prog']);
            print "<message color='green'>Deleted program ".$program->get_name()."</message>\n";
         }
         break;
   }
   print "</xml>\n";

?>
