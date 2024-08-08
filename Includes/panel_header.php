<?php 
session_start();

//Logging out
if(isset($_GET['logout']))
	unset($_SESSION['loggedin']);
	
//Checking if the current admin is logged in
if(!isset($_SESSION['loggedin']))
	header("location:admin.php");
	
require_once "includes/header.php"; 
?>