
<?php

function connect($db_host,$db_user,$db_pass,$db_name) 
{ 
    
  mysql_connect($db_host, $db_user, $db_pass) or die("Yhteytt‰ 
  tietokantapalvelimeen ei voida muodostaa<br>" . mysql_error()); 
  mysql_select_db($db_name) or die("Tietokannan valinta ep‰onnistui<br>" 
  . mysql_error()); 
}
 
function close() 
{ 
  mysql_close(); 
} 
 
  /*list_table() n‰ytt‰‰ kaikki tiedot taulusta $table
  Se on hyvin uudelleenk‰ytett‰v‰ funktio. Voi
  k‰ytt‰‰ suoraan erilaisten taulujen kanssa koska
  laskee taulun sarakkeiden m‰‰r‰n.*/

function list_table($table) 
{ 
  
  //valitaan kaikki data taulusta
  $query = "select * from $table";
  $result = mysql_query($query); 
  print "<html><body>"; 
  print "<table border='1' cellspacing='1' cellpadding='2'>";
  
  //poimitaan taulusta rivej‰ niin kauan kuin niit‰ on
  while($row = mysql_fetch_row ($result)) { 
  //lasketaan sarakkeiden m‰‰r‰
  $total_cols = count($row);
  $i = 0; 
  print "<tr>"; 
  //tehd‰‰n sarakkeita niin monta kuin niit‰ on
  while($i < $total_cols){ 
  print "<td>"; 
  //tulostetaan sis‰ltˆ sarakkeisiin
  print $row[$i]; 
  print "</td>"; 
  //otetaan tietueen id talteen
  //$id = $row[0];
  $i++; 
  } 
  print "</tr>"; 
  } 
  print "</table></body></html>"; 
} 

function edit($id)
{

 /*Jos lomakkeella on painettu poistu-nappia niin 
siirryt‰‰n list.php -sivulle ja lopetetaan t‰m‰ skripti*/
	if (@$_POST['cancel']) 
	{
	echo"<meta http-equiv=refresh content='0; url=nayta_2.php'>"; 
	die();
	}

/*Katsotaan onko lomakkeen L‰het‰-nappia painettu.
Jos muuttuja $_POST['fname'] ei ole tyhj‰ eli se on saanut
lomakkeelta arvon, niin sen perusteella lomake on l‰hetetty.
Jos n‰in ei ole niin n‰ytet‰‰n lomake */
  
	if(!empty($_POST['nimi'])) 
	{
    
    $id = $_POST['id'];
    $nimi = addslashes($_POST['nimi']);
    $sisalto = addslashes($_POST['sisalto']);
  
//P‰ivitet‰‰n sit‰ tietuetta miss‰ ID=$id
  
    $sql = "UPDATE sivunmuokkaus SET nimi='$nimi', sisalto='$sisalto'  WHERE ID='$id'";
    $query = mysql_query($sql) or die("Tiedon p‰ivitt‰minen 
	ei onnistunut.<br>". mysql_error());
    echo "Tietokanta p‰ivitetty!<meta http-equiv=refresh content='1; 
    url=nayta_2.php'>";
	} 
  
//Muuten jos lomakkeen L‰het‰-nappia ei ole painettu niin n‰ytet‰‰n lomake 
	else 
	{
/*Aluksi haetaan lomakkeen tekstikenttiin (value-attribuutin arvoiksi)
olemassa olevat arvot tietokannasta*/
	$sql = "SELECT * FROM sivunmuokkaus WHERE ID='$id'";
    $query = mysql_query($sql) or 
	die("Tietoja ei voitu hakea kannasta.<br>". mysql_error());
    $result = mysql_fetch_array($query);
    
    $Nimi = stripslashes($result["Nimi"]);
    $Sisalto = stripslashes($result["Sisalto"]);

    ?> 

<!-- Muokkauslomakkeella kenttien value-arvoina ovat 
kentiss‰ olevat tiedot  -->
  <b>Muokkaa sis‰ltˆ‰</b> 
  <form name="muokkaus" method="post" 
  action="<?php echo($_SERVER['PHP_SELF']);?>">
    
   <table border="0" cellspacing="0" cellpadding="2">
    <td>ID:</td>
     <td>
      <input type="text" name="id" value="<?php 
       echo $id; ?>" size="40">
     </td>
    </tr>
    <tr> 
    <tr> 
     <td>Nimi: </td>
     <td>
      <input type="text" name="nimi" value="<?php 
      echo $Nimi; ?>" size="40">
     </td>
    </tr>
    <tr> 
     <td>Sisalto:</td>
     <td>
      <input type="text" name="sisalto" value="<?php 
      echo $Sisalto; ?>" size="40">
     </td>
    </tr>
    <tr> 
     <td> </td>
     <td> 
      <div align="right">
      <input type="submit" name="submit" value="L‰het‰"><input 
      type="submit" name="cancel" value="Poistu">
     </div>
     </td>
    </tr>
   </table>
    <input type="hidden" name="id" value="<?php 
    echo $id; ?>"> 
	<?php
	}}
	?>
    </form> 
	</body>
	</html>
	