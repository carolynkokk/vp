<?php
  require("../../../config.php");
  require("usesession.php");
  $database = "if20_carolyn_ko_1";
  if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	//valmistame ette SQL käsu
	$stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES(?)");
	echo $conn->error;
	//seome käasuga päris andmed
	//s-string, i-integer, d-decimal
	$stmt->bind_param("s", $_POST["ideainput"]);
	$stmt->execute();
	echo $stmt->error;
	$stmt->close();
	$conn->close();
	  }
	require("header.php");
?>

  
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner"> 
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
    <li><a href="home.php">Avalehele</a></li>
	<li><a href="?logout=1">Logi välja</a>!</li>
  </ul>

 <hr>
 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Sisesta oma tänane mõttetu mõte!</label>
	<input type="text" name="ideainput" placeholder="mõttekoht">
	<input type="submit" name="ideasubmit" value="Saada mõte!">
  </form>
  <hr>
 <p>Tagasi <a href="home.php">pealehele!</a></p>
</body>
</html>