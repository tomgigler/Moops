<?php

   print "   <br><br>\n";
print "db: ".$_SESSION['sql_count'];

   if(!isset($print_mode))
   {
      print "   <div>\n";
      print "      <center>\n";
      print "         <h5>If you have any questions or comments please contact the ".
         "<a href='MAILTO:giglert@csusb.edu?subject=Moops Question,Comment'>Webmaster</a></h5>\n";
      print "      </center>\n";
      print "   </div>\n";
      print "   <br><br>\n";
   }

   print "</body>\n";
   print "</html>";

?>
