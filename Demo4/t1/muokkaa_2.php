
<html>
 <head>
  <title>Demo 4, tehtävä 1</title>
 </head>
 <h3>muokkaa_2.php</h3>
  <body>
 
   <?php
 
/*Otetaan käyttöön connect.php, jolla luodaan yhteys 
tietokantapalvelimeen ja valitaan oikea kanta.*/
	$id = "";
	include("dbfunctions.php"); 
	connect("localhost", "root", "", "t1");
	edit($id);
	close();
      ?>
  
  </body>
</html>