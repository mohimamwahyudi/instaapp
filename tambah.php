<?php 
   require 'akses.inc'; 
        try {
               $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
               $dbc ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $query = $dbc->prepare("INSERT INTO teman VALUES (:id_user, :id_teman ,'mengikuti')");
               $query->bindValue(':id_user', $_SESSION['id']);
               $query->bindValue(':id_teman', $_GET['id'] );
               $query->execute();
               echo "<script>alert('berhasil menambahkan teman');window.location='teman.php';</script>";
              } catch (PDOException $e) {
			              echo $e -> getMassage();
                  }
    

?>