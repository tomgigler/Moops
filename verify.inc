<?php
 
   require_once "Program.php";
   // if you are not logged in or prog is not set, just show printable form
   if (!isset($_SESSION['USER']) || !isset($_GET['prog']))
      $print_mode = 1;
   else
      if(isset($_GET['print'])) $print_mode = 1;

   $program = new Program();

   if(isset($_GET['prog']))
   {
      if(!(isset($_SESSION['program']) && $_SESSION['program'] && $_SESSION['program']->get_id() == $_GET['prog']))
         $_SESSION['program'] =& $program->get_program($_GET['prog']);
      $program =& $_SESSION['program'];
   }
   else
      $program = 0;

   // if program does not belong to you, just show blank form
   if($program != 0 && $program->get_username() != $_SESSION['USER'])
   {
      $print_mode = 1;
      $program = 0;
   }

?>
