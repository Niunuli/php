
<html>
 <head>
  <title>Demo 4, teht�v� 1</title>
 </head>
 <h3>muokkaa_2.php</h3>
  <body>
 
   <?php
 
/*Otetaan k�ytt��n connect.php, jolla luodaan yhteys 
tietokantapalvelimeen ja valitaan oikea kanta.*/
	$id = "";
	include("dbfunctions.php"); 
	connect("localhost", "root", "", "t1");
	edit($id);
	close();
      ?>
  
  </body>
</html>