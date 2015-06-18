
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

  <form method="get" action="search.php">
  <b>Etsittävä  etu- tai sukunimi:</b>  <input type="text" name="name" size="40">
  <input type="submit" name="etsi" value="etsi">
  </form>
  
 
 </body>
</html>