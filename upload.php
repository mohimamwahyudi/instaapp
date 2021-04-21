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
   
   <?php } ?>
   <section>
        <?php 

          if (isset($_POST["submit"])) {
             $text = $_POST['text'];
             $foto = $_POST['foto'];
             $namaFile = $_FILES['foto']['name'];
             $namaSementara =$_FILES['foto']['tmp_name'];

             
              $dir= "gambar/";
              $terupload = move_uploaded_file($namaSementara, $dir.$namaFile);
              if ($terupload) {
                try {
               $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
               $dbc ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $query = $dbc->prepare("INSERT INTO postingan VALUES (Null,:id_user, :gambar,:textt,Null)");
               $query->bindValue(':id_user', $_SESSION['id']);
               $query->bindValue(':gambar', $namaFile );
               $query->bindValue(':textt', $text);
               $query->execute();
               header('location:index.php');
              } catch (PDOException $e) {
			              echo $e -> getMassage();
                  }
            }else{
              echo "gall";
            }
          }
              
          
        
      
        ?>
        <div class="container shadow-sm p-3 mb-5 bg-body rounded">
             <div class="row justify-content-center mb-3 pt-5">
          <div class="col-md-6">
            <form method="POST" action="" enctype="multipart/form-data">
              <div class="mb-3">
                <textarea class="form-control" id="pesan" rows="3" placeholder="apa yang anda pikirkan?" name="text"></textarea>
              </div>
              <div class="mb-3">
                    <input type="file" name="foto" class="form-control" required="Foto"/>
                </div>
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
        </div>
   </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>