<html>
 <head>
  <title>edit.php</title>
 </head>
  <body>
 
   <?php
 
/*Otetaan käyttöön connect.php, jolla luodaan yhteys 
tietokantapalvelimeen ja valitaan oikea kanta.*/
	include("e2_dbfunctions.php"); 
    connect("localhost", "root", "", "osoitteet");
//Haetaan editoitavan tietueen id osoiteriviltä
	$id=@$_GET['id'];

 /*Jos lomakkeella on painettu poistu-nappia niin 
   siirrytään list.php -sivulle ja lopetetaan tämä skripti*/
	if (@$_POST['cancel']) 
	{
	poistu();
	}

/*Katsotaan onko lomakkeen Lähetä-nappia painettu.
 Jos muuttuja $_POST['fname'] ei ole tyhjä eli se on saanut
 lomakkeelta arvon, niin sen perusteella lomake on lähetetty.
 Jos näin ei ole niin näytetään lomake */
  
	if(!empty($_POST['fname'])) 
	{
    paivitys($id);
    } 
  
 //Muuten jos lomakkeen Lähetä-nappia ei ole painettu niin näytetään lomake 
	else 
	{
	lomake($id);
	}
	
	close();
?>  
  </body>
</html>