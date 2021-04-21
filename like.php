<?php 
    require 'akses.inc';
    $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
    $query = $dbc->prepare("SELECT * FROM postingan WHERE :id = postingan.idpost");
			$query->bindValue(':id', $_GET['id']);
			$query->execute();
    $like = 0;
    foreach ($query as $key) {
        $like = $like + $key['suka'];
        $likeb = $like+1;
        $likebaru = strval($likeb) ;
        $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
        $lk = $dbc->prepare("UPDATE `postingan` SET `suka` = $likebaru WHERE `postingan`.`idpost` = :id;");
		$lk->bindValue(':id', $key['idpost']);
		$lk->execute();
        if ($lk > 0) {
            header('location:index.php');
        }
    }
                        
                        
                
 ?>