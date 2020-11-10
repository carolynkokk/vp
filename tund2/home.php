<?php
require("usesession.php");
  
//klassi testimine
//require("classes/First_class.php");
//myclassobject = new First(10);
//echo "salajane arv on: " .$myclassobject->mybusiness;
//echo "avalik arv on: " .$myclassobject->everybodysbusiness;
//myclassobject->tellMe();
//unset ($myclassobject);
//echo "Avalik arv on: " .$myclassobject->everybodysbusiness;

//tegelen küpsistega - cookies
//setcookie see funktsioon peab olema enne <html> elementi
//küpsise nimi, väärtus, aegumistähtaeg, failitee (domeeni piires), domeen, https kasutamine
setcookie("vpvisitorname" $_SESSION["userfirstname"] ." " $_SESSION["userlastname"], time() + (86400 * 8), "/~carokok/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
$lastvisitor = null;
if(isset($_COOKIE["$vpvisitorname"])){
	$lastvisitor = "<p>Viimati külastas lehte: " .$_COOKIE["vpvisitorname"] .".</p> \n";
} else {
	$lastvisitor = "<p>Küpsiseid ei leitud, viimane külastaja pole teada.</p> \n";
}

//küpsise kustutamine
//kustutamiseks tuleb sama küpsis kirjutada minevikus aegumistähtajaga, näiteks time() - 3600
	


  require("header.php"); 
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner"> 
  <h1><?php echo $_SESSION["userfirstname"] . " " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
<ul>
<li><a href="addideas.php">Mõtete sisestamine!</a></li>
<li><a href="addfilms.php">Filmide lisamine</a></li>
<li><a href="addfilmrelations.php">Seoste lisamine</a></li>
<li><a href="addquote.php">Tsitaadi lisamine</a></li>
<br>
<li><a href="motetelugemine.php">Mõtete lugemine!</a></li>
<li><a href="listfilms.php">Filmiinfo näitamine</a></li>
<li><a href="photogallery_public.php">Avalike fotode galerii</a></li>
<br>
<li><a href="userprofile.php">Minu kasutajaprofiil</a></li>
<li><a href="photoupload.php">Galeriipiltide üles laadimine</a></li>
<br>
<li><a href="?logout=1">Logi välja!</a></li>
</ul>

<hr>

	<h3>Viimane külastaja sellest arvutist<h3/>
	<?php
		if(count($_COOKIE) > 0){
			echo "<p>Küpsised on lubatud! Leiti: </p> \n";
		}
		echo $lastvisitor;
	?>
</body>
</html>