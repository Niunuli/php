<html>
 <head>
  <title>edit.php</title>
 </head>
  <body>
 
   <?php
 
/*Otetaan k�ytt��n connect.php, jolla luodaan yhteys 
tietokantapalvelimeen ja valitaan oikea kanta.*/
	include("e2_dbfunctions.php"); 
    connect("localhost", "root", "", "osoitteet");
//Haetaan editoitavan tietueen id osoiterivilt�
	$id=@$_GET['id'];

 /*Jos lomakkeella on painettu poistu-nappia niin 
   siirryt��n list.php -sivulle ja lopetetaan t�m� skripti*/
	if (@$_POST['cancel']) 
	{
	poistu();
	}

/*Katsotaan onko lomakkeen L�het�-nappia painettu.
 Jos muuttuja $_POST['fname'] ei ole tyhj� eli se on saanut
 lomakkeelta arvon, niin sen perusteella lomake on l�hetetty.
 Jos n�in ei ole niin n�ytet��n lomake */
  
	if(!empty($_POST['fname'])) 
	{
    paivitys($id);
    } 
  
 //Muuten jos lomakkeen L�het�-nappia ei ole painettu niin n�ytet��n lomake 
	else 
	{
	lomake($id);
	}
	
	close();
?>  
  </body>
</html>