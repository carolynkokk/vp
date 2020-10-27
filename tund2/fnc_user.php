<?php
$database = "if20_carolyn_ko_1";

function signup($firstname, $lastname,$email, $gender, $birthdate, $password) {
	$notice = null;
	 $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	 $stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?, ?, ?, ?, ?, ?)");
	 echo $conn->error;
	 
	 //krüpteerime salasõna
	 $options = ["cost" => 12, "salt" => substr(sha1(rand()),0, 22)];
	 $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	 
	 $stmt->bind_param("sssiss", $firstname, $lastname, $birthdate, $gender, $email, $pwdhash);
		if($stmt->execute()){
			$notice = "ok";
		} else {
			$notice = $stmt->error;	
		}
		$stmt->close();
	    $conn->close();
		return $notice;
	}
	function signin($email, $password){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT password FROM vpusers WHERE email = ?");
		echo $conn->error;
		$stmt->bind_param("s", $email);
		$stmt->bind_result($passwordfromdb);
		if($stmt->execute()){
			
			//andmebaasi päring õnnestus
			if ($stmt->fetch()){
				if(password_verify($password, $passwordfromdb)) {
					//Kõik on õige ja parool klapib, sisselogimine
					$stmt->close();
					
					//loen sisse loginud kasutaja info
					$stmt = $conn->prepare("SELECT vpusers_id, firstname, lastname FROM vpusers WHERE email = ?");
					echo $conn->error;
					$stmt->bind_param("s", $email);
					$stmt->bind_result($idfromdb, $firstnamefromdb, $lastnamefromdb);
					$stmt->execute();
					$stmt->fetch();
					//salvestame sessioonimuutujad
					$_SESSION["userid"] = $idfromdb;
					$_SESSION["userfirstname"] = $firstnamefromdb;
					$_SESSION["userlastname"] = $lastnamefromdb;
					$stmt->close();
					
					//värvid loeme profiilist, kui on olemas kasutaja
					$stmt = $conn->prepare("SELECT bgcolor, txtcolor FROM vpuserprofiles WHERE userid = ?");
				  echo $conn->error;
				  $stmt->bind_param("i", $_SESSION["userid"]);
				  $stmt->bind_result($userbgcolorfromdb, $usertxtcolorfromdb);
				  $stmt->execute();
				  if($stmt->fetch()) {
					  $_SESSION["userbgcolor"] = $userbgcolorfromdb;
					  $_SESSION["usertxtcolor"] = $usertxtcolorfromdb;
				  }
				  else {
					  $_SESSION["userbgcolor"] = "#FFFFFF";
					  $_SESSION["usertxtcolor"] = "#000000";
				  }
					
					$stmt->close();
					$conn->close();
					header("Location: home.php");
					exit();
 				} else {
					$notice = "Vale salasõna!";
				}		
			} else {
				$notice = "Sellist kasutajat (" .$email .") ei ole olemas!";
			}		
		} else {
			$notice = "Sisselogimisel tekkis tehniline viga: " .$stmt->error;
		}	
		
		$stmt->close();
	    $conn->close();
		return $notice;
	}	
	 function storeuserprofile($description, $bgcolor, $txtcolor) {
	  $notice = null;
	  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  
	  // Kontrollime, kas profiil on olemas
	  $stmt = $conn->prepare("SELECT vpuserprofiles_id FROM vpuserprofiles WHERE userid = ?");
	  echo $conn->error;
	  $stmt->bind_param("i", $_SESSION["userid"]);
	  $stmt->bind_result($profileidfromdb);
	  $stmt->execute();
	  
	  // Kui profiil on olemas, siis uuendame
	  if($stmt->fetch()) {
		  $stmt->close();
		  $stmt = $conn->prepare("UPDATE vpuserprofiles SET description = ?, bgcolor = ?, txtcolor = ? WHERE userid = ?");
		  echo $conn->error;
		  $stmt->bind_param("sssi", $description, $bgcolor, $txtcolor, $_SESSION["userid"]);
	  }
	  else { // Kui profiili pole olemas, siis loome
		  $stmt->close();
		  $stmt = $conn->prepare("INSERT INTO vpuserprofiles (userid, description, bgcolor, txtcolor) VALUES(?,?,?,?)");
		  echo $conn->error;
		  $stmt->bind_param("isss", $_SESSION["userid"], $description, $bgcolor, $txtcolor);
		  
	  }
	  if($stmt->execute()) {
			  $notice = "Salvestatud!";
		  }
		  else {
			  $notice = $stmt->error;
		  }
		  
		  $stmt->close();
		  $conn->close();
		  return $notice;	  
  }
  
  function readuserdescription() {
	  $description = "";
	  // Kui profiil on olemas, loeb kasutaja lühitutvustuse
	  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("SELECT description FROM vpuserprofiles WHERE userid = ?");
	  echo $conn->error;
	  $stmt->bind_param("i", $_SESSION["userid"]);
	  $stmt->bind_result($descriptionfromdb);
	  $stmt->execute();
	  if($stmt->fetch()) {
		  $description = $descriptionfromdb;
	  }
	  $stmt->close();
	  $conn->close();
	  return $description;
  }