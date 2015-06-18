
<html>
 <head>
  <title>delete.php</title>
 </head>
  <body>
 
   <?php 
    include("e2_dbfunctions.php"); 
    $id=$_GET['id'];
	$table = "osoitelista";
	connect("localhost", "root", "", "osoitteet");
	delete($id);
	close();
   ?>
  
  </body>
</html>