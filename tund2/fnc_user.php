<?php
$database = "if20_carolyn_ko_1";

function signup($firstname, $lastname,$email, $gender, $birthdate, $password) {
	$notice = null;
	 $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	 $stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?, ?, ?, ?, ?, ?)");
	 echo $conn->error;
	 
	 //krüpteerime salasõna
	 $options = ["cost" => 12, "salt" => substr(sha1(rand()),0, 22)];
	 $pwdbash = password_hash($password, PASSWORD_BCRYPT, $options);
	 
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
					$_SESSION["userfirrstname"] = $firstnamefromdb;
					$_SESSION["userlastname"] = $lastnamefromdb;
					
					$_SESSION["userbgcolor"] = "#AACCFF";
					$_SESSION["usertxtcolor"] = "#000066";
					
					//värvid loeme profiilist, kui on olemas kasutaja
					$_SESSION["userbgcolor"] = "#FFFFFF";
					$_SESSION["usertxtcolor"] = "#000000";
					
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
		
		//SQL
		//kontrollime, kas äkki on profiil olemas
		//SELECT vpusersprofiles_id FROM vpuserprofiles WHERE userid = ?
		//küsimärk asendada väärtusega 
		//$_SESSION["userid"]
		//kui profiili ei ole olemas, siis loome
		//INSERT INTO vpuserprofiles (userid, description, bgcolor, txtcolor)
		//VALUES(?,?,?,?)
		
		//kui profiil on olemas, siis uuendame
		///UPDATE vpuserprofiles SET description = ?, bgcolr = ?, txtcolor = ? WHERE USERID = ?
		
		//execute jms võib loomisel ja uuendamisel ühine olla
	}
	
	function readuserdescription() {
		//kui profiil on olemas siis loe kasutaja lühikirjelduse
		
	}
		
