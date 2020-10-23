<?php
session_start();
 // $username = "Carolyn Kokk";
 
 //kas on sissem loginud
 if(!isset($_SESSION["userid"])){
	 //jõuga suunatakse sisselogimise lehele
	 header("Location: page.php");
	 exit();
 }
  
  //logime välja
  if(isset($_GET["logout"])){
	  //lõpetame sessiooni
	  session_destroy();
	   //jõuga suunatakse sisselogimise lehele
	 header("Location: page.php");
	 exit();
	 
  }