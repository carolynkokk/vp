<div>
<img src="pictures/kaelkirjak.jpg"
alt=kaelkirjak />
</div>
<?php
$commenthtml = "";
$commentautorhtml = "";
$commenterror = "";
$commenttotalhtml = "";

require("../../../../config.php");
$database = "if20_carolyn_ko_1";
// Kommentaari salvestamine
if(isset($_POST["commentsubmit"])){
    if(empty($_POST["kommentaar"]) or empty($_POST["autor"]));
    $commenterror = "Kommentaari jätmiseks tuleb täita kõik väljad!";
}
if(isset($_POST["commentsubmit"]) and !empty($_POST["kommentaar"])){
    $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
    $stmt = $conn->prepare("INSERT INTO giraffecomment (kommentaar, autor) VALUES (?, ?)");
    //echo $conn->error;
    $stmt->bind_param("ss", $_POST["kommentaar"], $_POST["autor"]);
    $stmt->execute();
    //echo $stmt->error;
    $stmt->close();
    $conn->close();
}

// Kommentaarid andmebaasist
$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
$stmt = $conn->prepare("SELECT autor, kommentaar FROM giraffecomment");
//echo $conn->error;
$stmt->bind_result($commentautorfromdb, $commentfromdb);
$stmt->execute();
while($stmt->fetch()){
    $commentautorhtml .= "<b>" .$commentautorfromdb ."</b>";
    $commenthtml .= "<p>" .$commentfromdb ."</p>";
}
$stmt->close();
$conn->close();

//<label for="kuupäev">Tänane kuupäev:</label>
//<input type="date" id="kuupäev" name="kuupäev">
require("header.php");
?>

<h1>Veebileht on koostatud eksamitöö käigus.</h2>
<p>Tere tulemast galeriisse, kus esitleme erinevaid toredaid loomi!</p>
<hr>
<?php

 ?>
<hr>
<br>
<b>Sisesta oma kommentaar pildile!</b>
<br>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="text" name="kommentaarpildile" placeholder="Kommentaar">
    <p>Sisesta oma nimi!</p>
    <input type="text" name="autor" placeholder="nimi">
    <input type="submit" name="commentsubmit" value="Jäta oma kommentaar!">
</form>
<b><?php echo $commenterror; ?></b>
<hr>

</body>
</html>