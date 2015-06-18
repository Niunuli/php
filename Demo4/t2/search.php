<html>
   <head>
     <title>search.php</title>
   </head>
 <body>
 <p>
 [<a href='e2_list.php'>Edelliselle sivulle</a>]</p>
 </body>
</html>
<?php

$name = @$_GET['name'];
$searchword  = $name;
$table = "osoitelista";

include("e2_dbfunctions.php");
    
connect("localhost", "root", "", "osoitteet");

search_table($table, $searchword);

close();

?>