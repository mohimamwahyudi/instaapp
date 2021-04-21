<?php
	unset($_SESSION['isMember']); //Meng-unset variabel session untuk isMember
	unset($_SESSION['id']); //Meng-unset variabel session untuk id
	header('Location: login.php');	
    exit();

?>