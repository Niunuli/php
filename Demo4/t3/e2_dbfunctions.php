
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

?>