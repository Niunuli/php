<?php

  include("e2_dbfunctions.php");
    
  connect("localhost", "root", "", "osoitteet");
  
$os = 10;

if (isset($_GET['sivu'])) 
{
    $sivu = $_GET['sivu'];
}

$sivu = intval($sivu);
// haetaan n‰ytett‰v‰t tietueet tietokannasta
$osoitteet = mysql_query("SELECT * FROM osoitelista");

// selvitet‰‰n tietueiden m‰‰r‰
$maara = mysql_result(mysql_query("SELECT COUNT(*) FROM osoitelista"), 0);

// luodaan sivunumerolista, jos sivuja on useampia
if ($maara > $os) 
{
    echo "<p>";
    for ($i = 0; $i < $maara / $os; $i++) 
	{
        // tulostetaan pystyviivat sivunumeroiden v‰liin
        if ($i <> 0) 
		{
            echo " | ";
        }
        // jos t‰m‰ sivu n‰ytet‰‰n, tulostetaan sivun numero lihavoituna
        if ($sivu == $i) 
		{
            echo "<b>".($i + 1)."</b>";
        // muussa tapauksessa luodaan linkki toiselle sivulle
        } 
		
		else 
		{
            echo "<a href=\"{$_SERVER['PHP_SELF']}?sivu={$i}\">".($i + 1)."</a>";
        }
    }
    echo "</p>";
}

// tulostetaan tietokannasta luetut viestit
for ($i = 0; $i < $os; $i++) 
{
    // varmistetaan, ett‰ viimeisell‰ sivulle ei tule ylim‰‰r‰ist‰
    if ($i + $sivu * $os < $maara) {
        // tulostetaan viestin tiedot yksinkertaisesti muotoiltuna
		$id = mysql_result($osoitteet, $i, 0);
        $fname = mysql_result($osoitteet, $i, 1);
        $lname = mysql_result($osoitteet, $i, 2);
        $email = mysql_result($osoitteet, $i, 3);
		
        echo "<p>$id<br>$fname<br>$lname<br>$email</p>";
    }
}
close();
?>