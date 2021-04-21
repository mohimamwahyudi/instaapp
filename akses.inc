<?php
	session_start(); //Memulai session
	if (!isset($_SESSION['isMember'])){ 
		header("Location: login.php"); 
		exit();
}
?>
