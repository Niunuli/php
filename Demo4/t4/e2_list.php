
<html>
   <head>
     <title>e2_list.php</title>
   </head>
 <body>
 <p>
 <b>Tietueiden listaus</b>&nbsp;&nbsp;
 [<a href='e2_add.php'>Lis�� uusi tietue</a>]</p>

<?php
  include("e2_dbfunctions.php");
    
  connect("localhost", "root", "", "osoitteet");
  list_table("osoitelista");
  close();
?>


  
 
 </body>
</html>