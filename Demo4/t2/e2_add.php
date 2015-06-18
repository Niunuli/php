
<html>
  <head>  
    <title>add.php</title>
  </head> 
  <body>    

<?php
/*Otetaan käyttöön connect.php, jolla luodaan yhteys
  tietokantapalvelimeen ja valitaan oikea kanta.*/
  
  include("e2_dbfunctions.php"); 
  
  /*Katsotaan onko etunimelle fname annettu lomakkeessa arvo.
  Jos kenttä ei ole tyhjä jatketaan ja lisätään 
  uusi tietue, muuten näytetään lomake uudestaan.*/
  
  if(!empty($_POST['fname'])) {
  
  connect("localhost", "root", "", "osoitteet");
  add_row_to_table("osoitelista"); 
  close();
  }
  
  //Jos ei suoriteta lisäystä niin näytetään lomake
  else {
  ?>
  
<!--Lomake kutsuu tätä sivua eli ylläolevaa PHP-skriptiä-->
<b>Lisää tietue osoitelistaan</b> 
<form name="address" method="post" 
  action="<?php echo ($_SERVER['PHP_SELF']); ?>">
  
<table border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td>Sukunimi:</td>
    <td><input type="text" name="lname" size="40"></td>
  </tr>
  <tr> 
    <td>Etunimi: </td>
    <td><input type="text" name="fname" size="40"></td>
  </tr>
  <tr> 
    <td>Sähköposti:</td>
    <td><input type="text" name="email" size="40"></td>
  </tr>
  <tr>
    <td>Osoite:</td>
    <td><input type="text" name="address" size="40"></td>
  </tr>
  <tr> 
    <td></td>
    <td><div align="right">
        <input type="submit" name="submit" value="Lähetä"><input 
        type="submit" name="cancel" value="Poistu"></div></td>
  </tr>
</table>
</form>
  
<?php
  //Jos painetaan Poistu-nappia mennään takaisin listasivulle
  if (@$_POST['cancel']) {
  echo"<meta http-equiv=refresh content='0; url=e2_list.php'>"; 
  }
}
?>
 </body>
</html>