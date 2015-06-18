
<?php

function connect($db_host,$db_user,$db_pass,$db_name) 
{ 
    
  mysql_connect($db_host, "root", "") or die("Yhteytt‰ 
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
  $query = "select * from $table order by id";
  $result = mysql_query($query); 
  print "<html><body>"; 
  print "<table border='1' cellspacing='1' cellpadding='2'>";
  
  //poimitaan taulusta rivej‰ niin kauan kuin niit‰ on
  while($row = mysql_fetch_row ($result)) 
  { 
  //lasketaan sarakkeiden m‰‰r‰
  $total_cols = count($row);
  $i = 0; 
  print "<tr>"; 
  //tehd‰‰n sarakkeita niin monta kuin niit‰ on
  while($i < $total_cols)
  { 
  print "<td>"; 
  //tulostetaan sis‰ltˆ sarakkeisiin
  print $row[$i]; 
  print "</td>"; 
  //otetaan tietueen id talteen
  $id = $row[0];
  $i++; 
  } 
  print "<td>[<a href='edit.php?id=$id'>Muokkaa</a>
  |<a href='delete.php?id=$id'>Poista</a>]</td>";
  print "</tr>"; 
  } 
  print "</table></body></html>"; 
} 

  /*add_row_to_table() ei ole niin yleisk‰yttˆinen kuin
  list_table(), vaan se toimii vain osoitelista-taulun kanssa.*/
  
function add_row_to_table($table) 
{
  
  /*addslashes-funktio lis‰‰ kenoviivat (\) ' ja " merkkien 
  eteen, jolloin niit‰ ei k‰sitell‰ koodin merkkein‰ vaan tavallisina 
  merkkijonomerkkein‰. N‰in estet‰‰n mahdolliset virheet.*/
  
  $fname = addslashes($_POST['fname']);
  $lname = addslashes($_POST['lname']);
  $email = addslashes($_POST['email']);
  $address = addslashes($_POST['address']);
  
  //Asetetaan sql-k‰sky muuttujan $sql arvoksi.
  
  $sql = "INSERT INTO $table SET FirstName='$fname', 
  LastName='$lname', Email='$email', Address='$address'";
  
  /*Lis‰t‰‰n tiedot kantaan suorittamalla sql-k‰sky 
  mysql_query()-funktion avulla.*/
  
  $query = mysql_query($sql) or die("Cannot query the database.<br>" 
  . mysql_error());
  echo "Tietokanta p‰ivitetty!<meta http-equiv=refresh content='1; 
        url=e2_list.php'>";
  } 

function search_table($table, $searchword)
 { 
  
  //valitaan kaikki data taulusta
  $query = "SELECT * FROM $table WHERE LastName = '$searchword' or FirstName = '$searchword' ORDER BY id";
  $result = mysql_query($query); 
  print "<html><body>"; 
  print "<table border='1' cellspacing='1' cellpadding='2'>";
  
  //poimitaan taulusta rivej‰ niin kauan kuin niit‰ on
  while($row = mysql_fetch_row ($result)) 
  { 
  //lasketaan sarakkeiden m‰‰r‰
  $total_cols = count($row);
  $i = 0; 
  print "<tr>"; 
  //tehd‰‰n sarakkeita niin monta kuin niit‰ on
  while($i < $total_cols)
  { 
  print "<td>"; 
  //tulostetaan sis‰ltˆ sarakkeisiin
  print $row[$i]; 
  print "</td>"; 
  //otetaan tietueen id talteen
  $id = $row[0];
  $i++; 
  } 
  print "</tr>"; 
  } 
  print "</table></body></html>"; 
}

function delete($id)
{
    $sql = "DELETE FROM osoitelista WHERE ID='$id'"; 
    $query = mysql_query($sql) or die("Cannot delete record.<br>" 
    . mysql_error()); 
    echo "Tietue poistettu!<meta http-equiv=refresh content='1; 
    url=e2_list.php'>";

}

function poistu()
{

  echo"<meta http-equiv=refresh content='0; url=e2_list.php'>"; 
  die();

}

function paivitys($id)
{

    $id = $_POST['id'];
    $fname = addslashes($_POST['fname']);
    $lname = addslashes($_POST['lname']);
    $email = addslashes($_POST['email']);
    $address = addslashes($_POST['address']);
  
//P‰ivitet‰‰n sit‰ tietuetta miss‰ ID=$id
  
    $sql = "UPDATE osoitelista SET FirstName='$fname', LastName='$lname', 
    Email='$email', Address='$address' WHERE ID='$id'";
    $query = mysql_query($sql) or die("Tiedon p‰ivitt‰minen 
	ei onnistunut.<br>". mysql_error());
    echo "Tietokanta p‰ivitetty!<meta http-equiv=refresh content='1; 
    url=e2_list.php'>";

}

function lomake($id)
{

  /*Aluksi haetaan lomakkeen tekstikenttiin (value-attribuutin arvoiksi)
  olemassa olevat arvot tietokannasta*/
  $sql = "SELECT * FROM osoitelista WHERE ID='$id'";
    $query = mysql_query($sql) or 
	die("Tietoja ei voitu hakea kannasta.<br>". mysql_error());
    $result = mysql_fetch_array($query);
    
    $FirstName = stripslashes($result["FirstName"]);
    $LastName = stripslashes($result["LastName"]);
    $Email = stripslashes($result["Email"]);
    $Address = stripslashes($result["Address"]);
    ?> 
<html>
<head>
<title></title>
</head>
<body>
  <!-- Muokkauslomakkeella kenttien value-arvoina ovat 
  kentiss‰ olevat tiedot  -->
  <b>Muokkaa osoitelistaa</b> 
  <form name="address" method="post" 
  action="<?php echo($_SERVER['PHP_SELF']);?>">
    
   <table border="0" cellspacing="0" cellpadding="2">
    <td>Sukunimi:</td>
     <td>
      <input type="text" name="lname" value="<?php 
       echo $LastName; ?>" size="40">
     </td>
    </tr>
    <tr> 
    <tr> 
     <td>Etunimi: </td>
     <td>
      <input type="text" name="fname" value="<?php 
      echo $FirstName; ?>" size="40">
     </td>
    </tr>
    <tr> 
     <td>S‰hkˆposti:</td>
     <td>
      <input type="text" name="email" value="<?php 
      echo $Email; ?>" size="40">
     </td>
    </tr>
    <tr>
     <td>Osoite:</td>
     <td>
      <input type="text" name="address" value="<?php 
      echo $Address; ?>" size="40">
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
    </form>
    <?php        
      }
      ?>
	  
</body>
</html>	
<?php
function order($table)
{

/* M‰‰ritell‰‰n mitk‰ kent‰t otetaan j‰rjestett‰viksi */
   $default_sort = 'LastName';
   $allowed_order = array ('Email','Address','FirstName','LastName');

/* Jos k‰ytt‰j‰ valitsee j‰rjestett‰v‰t tiedot k‰ytet‰‰n k‰ytt‰j‰n valintaa,
muuten k‰ytet‰‰n oletusj‰rjest‰mist‰. */
   if (!isset ($_GET['order']) ||
   !in_array ($_GET['order'], $allowed_order)) {
   $order = $default_sort;
   } else {
   $order = $_GET['order'];
   }

/* Suoritetaan SQL-kysely osoitelista-tauluun */
  $query = "SELECT * FROM osoitelista ORDER BY $order";
  $result = mysql_query ($query);

/* Tarkistetaan ett‰ kannassa on tietoja */
  $numrows = mysql_num_rows($result);
  if ($numrows == 0) {
  echo "Tietoja ei ole!";
  exit;
  }
/* Tehd‰‰n taulukko johon tiedot tulevat */
  
  $row = mysql_fetch_assoc ($result);
  echo "<table border=1>\n";
  echo "<tr>\n";
  foreach ($row as $heading=>$column) {
  
/* Jos kent‰n nimi on mukana listassa josta
* valitaan j‰rjestett‰v‰t kent‰t, tehd‰‰n
* hyperlinkki */

  echo "<td><b>";
  if (in_array ($heading, $allowed_order)) {
  echo "<a href=\"{$_SERVER['PHP_SELF']}?order=$heading
  \">$heading</a>";
  } else {
  echo $heading;
  }
  echo "</b></td>\n";
  }
  echo "</tr>\n";

/* Nollataan $result takaisin ekaan riviin
* ja n‰ytet‰‰n tiedot */
  
  mysql_data_seek ($result, 0);
  while ($row = mysql_fetch_assoc ($result)) {
  echo "<tr>\n";
  foreach ($row as $column) {
  echo "<td>$column</td>\n";
  }
  echo "</tr>\n";
  }
  echo "</table>\n";

}
?>