
<html>
   <head>
     <title>e2_list.php</title>
   </head>
 <body>
 <p>
 <b>Tietueiden listaus</b>&nbsp;&nbsp;
 [<a href='e2_add.php'>Lisää uusi tietue</a>]</p>

<?php
  include("e2_dbfunctions.php");
    
  connect("localhost", "root", "", "osoitteet");
  list_table("osoitelista");
  close();
?>

  <form method="get" action="delete.php">
  <b>Poistettava  ID:</b>  <input type="text" name="id" size="40">
  <input type="submit" name="poista" value="poista">
  </form>
  
 
 </body>
</html>