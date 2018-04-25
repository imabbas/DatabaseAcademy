<?php 
session_start();
if($_SESSION['loggedin'] == "yes"){
	$_SESSION['loggedin'] = "no";
   session_destroy();
   header('location:index.php');
} 
 ?>