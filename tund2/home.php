<?php
  require("usesession.php");
  require("header.php"); 
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner"> 
  <h1><?php echo $_SESSION["userfirstname"] . " " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<li><a href="?logout=1">Logi välja</a>!</li>
  
<ul>
<li><a href="motetesisestamine.php">Mõtete sisestamine!</a></li>
<li><a href="motetelugemine.php">Mõtete lugemine!</a></li>
<li><a href="listfilms.php">Filmiinfo näitamine</a></li>
<li><a href="addfilms.php">Filmide lisamine</a></li>
<li><a href="userprofile.php">Minu kasutajaprofiil</a></li>
</ul>

<hr>
</body>
</html>