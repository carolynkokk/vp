<?php
  require("../../../config.php");
  require("fnc_film.php");
  require("usesession.php");
  //vaatame, mida vormist serverile saadetakse
  //var_dump($_POST);
  $username = "Carolyn Kokk";

  require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bÃ¤nner"> 
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud ÃµppetÃ¶Ã¶ kÃ¤igus ning ei sisalda mingit tÃµsiseltvÃµetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ãœlikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
  <li><a href="?logout=1">Logi välja</a>!</li>
  <li><a href="home.php">Avalehele</a></li>
  </ul>
  <hr>
  <?php echo readfilms(); ?>
  <hr>
</body>
</html>