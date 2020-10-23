<?php

//loeme andmebaasi login info muutujad
  require("../../../config.php");
  require("usesession.php");
  //kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
  $database = "if20_carolyn_ko_1";

//loeme andmebaasist
  $nonsenshtml= "";
  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
  //valmistame ette SQL käsu
  $stmt = $conn->prepare("SELECT nonsensidea FROM nonsens");
  echo $conn->error;
  //seome tulemuse mingi muutujaga
  $stmt->bind_result($nonsensfromdb);
  $stmt->execute();
  //võtan, kuni on
  while($stmt->fetch()) {
	  //<p>suvaline mõte </p>
	  $nonsenshtml .= "<p>" .$nonsensfromdb ."</p>";
	  
  }
  $stmt->close();
  $conn->close();
  //ongi andmebaasist loetud
  //vaatame, mida vormist serverile saadetakse
  //var_dump($_POST);

?>

  <h1>Loe huvitavaid mõtteid!</h1>
  <hr>
  <?php echo $nonsenshtml; ?>
  <hr>

  <ul>
  <li><a href="?logout=1">Logi välja</a>!</li>
  <li><a href="home.php">Avalehele</a></li>
  </ul>

</body>
</html>