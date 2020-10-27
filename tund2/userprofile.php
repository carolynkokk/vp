<?php
  require("../../../config.php");
  require("fnc_user.php");
  require("usesession.php");
  require ("fnc_common.php");
  
  $notice = "";
  $userdescription = "";
  
  //kui klikiti submit, siis...
  if(isset($_POST["profilesubmit"])){
	  $userdescription = test_input($_POST["descriptioninput"]);
	  
	  $notice = storeuserprofile($userdescription, $_POST["bgcolorinput"], $_POST["txtcolorinput"]);
	  $_SESSION["userbgcolor"] = $_POST["bgcolorinput"];
	  $_SESSION["usertxtcolor"] = $_POST["txtcolorinput"];
  
  }

  require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner"> 
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
    <li><a href="home.php">Avalehele</a>!</li>
	<li><a href="?logout=1">Logi välja</a>!</li>
  </ul>
  
  <hr>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="descriptioninput">Minu lühikirejldus</label>
	<br>
	<textarea rows="10" cols="80" name="descriptioninput" id="descriptioninput" placeholder="Minu lühikirjeldus ..."><?php echo $userdescription; ?></textarea>
	<br>
	<label for="bgcolorinput">Minu valitud taustavärv: </label>
	<input type="color" name="bgcolorinput" id="bgcolorinput" value="<?php echo $_SESSION["bgcolor"]; ?>">
	<br>
	<label for="txtcolorinput">Minu valitud tekstivärv: </label>
	<input type="color" name= "txtcolorinput" value="<?php echo $_SESSION["usertxtcolor"]; ?>">
	<br>
	
	<input type="submit" name="profilesubmit" value="Salvesta profiil">
 </form>
 <p><?php echo $notice; ?></p>
 
</body>
</html>