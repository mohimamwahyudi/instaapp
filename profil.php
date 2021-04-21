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

    <title>home</title>
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
   <!-- profil-->
    <section class="jumbotron text-center">
        <img src="gambar/<?= $row['foto']; ?>" alt="imam" width="200" class="rounded-circle" /> <br>
        <a href="updatefoto.php" class="btn btn-light">ganti foto</a>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?= $row['nama']; ?></li>
            <li class="list-group-item"><?= $row['tgl']; ?></li>          
        </ul>
    </section>
    <?php } ?>
    <section>
        <div class="container shadow-sm p-3 mb-5 bg-body rounded">
        <?php 
                    $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
                    $query = $dbc->prepare("SELECT * FROM postingan WHERE :id = postingan.id_user");
                    $query->bindValue(':id', $_SESSION['id']);
			        $query->execute();
                    foreach ($query as $post) {
                        # code...
                    
                ?>
            <div class="row row justify-content-center mb-3 pt-5">
                      <?php $idpos = $post['idpost'] ?>
                    <div class="card" style="width: 25rem;">
                    <img src="gambar/<?= $post['gambar']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"><?= $post['text']; ?></p>
                        <i><?= $post['suka']; ?> menyukai</i> <br>
                       <i class="far fa-heart"><a href="like.php?id=<?= $post['idpost']; ?>" class="btn btn">like</a></i>
                        <i class="far fa-comment-dots"><a href="komen.php?id=<?= $post['idpost']; ?>" class="btn btn">coment</a></i><hr>
                    </div>
                      <?php 
                       $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
                      $komen = $dbc->prepare("SELECT * FROM komentar,users WHERE  komentar.idpost = $idpos AND komentar.id_user=users.id");
                      $komen->bindValue(':id', $_SESSION['id']);
			                $komen->execute();
                      foreach ($komen as $key ) {?>
                    <div>
                        <ul class="list-group list-group-flush">
                        <h5><?= $key['nama']; ?></h5>
                        <li class="list-group-item">
                        <img src="gambar/<?= $key['foto']; ?>" alt="imam" width="40" class="rounded-circle" /> 
                        <?= $key['deskripsi']; ?>
                        </li>
                    </div>
                    <?php } ?>
                    </div>
               
                <?php } ?>
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