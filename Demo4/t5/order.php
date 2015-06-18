<html>
   <head>
     <title>order.php</title>
   </head>
 <body>

 <p><a href="e2_list.php">Takaisin listaukseen</a></p>
 <?php
/*Otetaan käyttöön connect.php, jolla luodaan yhteys tietokantapalvelimeen 
ja valitaan oikea kanta.*/
   
	include("e2_dbfunctions.php"); 
	connect("localhost", "root", "", "osoitteet");
	order("osoitelista");
	close();	

?>

 </body>
</html>