
<html>
   <head>
     <title>Demo 4, teht�v� 1</title>
  </head>
  <body>
  <h3>nayta_2.php</h3>
  <p><a href="muokkaa_2.php">Muokkaa sis�lt��</a></p>

<?php
 
/*otetaan k�ytt��n connect.php, jolla luodaan yhteys
 tietokantapalvelimeen ja valitaan oikea kanta.*/

    include("dbfunctions.php");
	connect("localhost", "root", "", "t1");
	list_table("sivunmuokkaus");
	close();
?> 
 </body>
</html>