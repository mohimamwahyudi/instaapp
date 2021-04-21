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
    
   <section>
        <?php 

          if (isset($_POST["submit"])) {
             $foto = $_POST['foto'];
             $namaFile = $_FILES['foto']['name'];
             $namaSementara =$_FILES['foto']['tmp_name'];

             
              $dir= "gambar/";
              $terupload = move_uploaded_file($namaSementara, $dir.$namaFile);
              if ($terupload) {
                try {
               $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
               $dbc ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $query = $dbc->prepare("UPDATE users SET foto = :gambar WHERE users.id = :id_user;");  
               $query->bindValue(':gambar', $namaFile );
               $query->bindValue(':id_user', $_SESSION['id']);
               $query->execute();
               header('location:profil.php');
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