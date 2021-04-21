<?php 
    require 'akses.inc';
    $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
    $query = $dbc->prepare("SELECT * FROM users WHERE :id = users.id");
			$query->bindValue(':id', $_SESSION['id']);
			$query->execute();
    
 ?>
 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    

    <title>teman</title>
  </head>
  <body>
    
    
    <?php foreach ($query as $row ) { ?>
     <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <div class="container">
        <a class="navbar-brand" href="#"><?= $row["nama"]; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="teman.php">teman</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="upload.php">upload</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profil.php">profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
   
   <?php } ?>
   <section>
        <div class="container">
            <div class="raw text-center">
                <div class="col">
                    <h2>dtaraf teman</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <ul class="list-group list-group-flush">
                        <?php 
                              $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
                              $flw = $dbc->prepare("SELECT users.nama,users.foto,teman.* FROM teman, users WHERE teman.id_teman = users.id AND teman.id = :id");
			                  $flw->bindValue(':id', $_SESSION['id']);
			                  $flw->execute();
                              foreach ($flw as $flws) {
                        ?>
                         <li class="list-group-item">
                            <img src="gambar/<?= $flws['foto']; ?>" alt="imam" width="80" class="rounded-circle" />
                            <?= $flws['nama']; ?> 
                         </li>
                         <?php } ?>
                    </ul>
                    
                    
                    </p>
                </div>
            </div>
            <div class="raw text-center">
                <div class="col">
                    <h2>tambah teman</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php 
                    $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
                    $teman = $dbc->prepare("SELECT * FROM users, teman WHERE teman.id = :id AND users.id != :ids AND users.id != teman.id_teman ");
			        $teman->bindValue(':id', $_SESSION['id']);
                    $teman->bindValue(':ids', $_SESSION['id']);
			        $teman->execute();
                                
                ?>
                <div class="col-md-4">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($teman as $tmn) {   ?>
                        <li class="list-group-item"> 
                        <img src="gambar/<?= $tmn['foto']; ?>" alt="imam" width="80" class="rounded-circle" />
                        <?= $tmn['nama']; ?> 
                        <a href="tambah.php?id=<?= $tmn['id']; ?>" name="tambah"><i class="fas fa-user-plus"></i></a>
                        </li>
                        <?php } ?>           
                    </ul> 
                </div>
                
            </div>
        </div>
   </section>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://kit.fontawesome.com/3870135dd6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>