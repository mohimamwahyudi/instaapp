<?php 
    require 'akses.inc';
    $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
    $query = $dbc->prepare("SELECT * FROM users WHERE :id = users.id");
			$query->bindValue(':id', $_SESSION['id']);
			$query->execute();
    if (isset($_POST['submit'])) {
        $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
        $dbc ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $men = $dbc->prepare("INSERT INTO komentar VALUES (Null,:idpost,:id_user,:komen)");
        $men->bindValue(':idpost', $_GET['id']);
        $men->bindValue(':id_user', $_SESSION['id']);
        $men->bindValue(':komen', $_POST['komen'] );
        $men->execute();
        header('location:index.php');
                        
                        
                }
 ?>
 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>komen</title>
  </head>
  <body>
      <section>
        <div class="container shadow-sm p-3 mb-5 bg-body rounded">
        <?php 
                    $dbc = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
                    $query = $dbc->prepare("SELECT * FROM postingan,users WHERE  postingan.idpost=:id AND users.id=postingan.id_user");
                    $query->bindValue(':id', $_GET['id']);
			        $query->execute();
                    foreach ($query as $post) {
                        # code...
                    
                ?>
            <div class="row row justify-content-center mb-3 pt-5">
                    <div class="card" style="width: 25rem;">
                    <h2><?= $post['nama']; ?></h2>
                    <img src="gambar/<?= $post['gambar']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      
                        <p class="card-text"><?= $post['text']; ?></p>
                        <i><?= $post['suka']; ?> menyukai</i> <br>
                        <a href="" class="btn btn-primary">like</a>
                    </div>
                    <div>
                  
                        <form action="" method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" aria-describedby="name" name="komen">
                            </div>
                            </div>
                                <button type="submit" class="btn btn-primary" name="submit">komen</button>
                            </form>
                        </form>
                    </div>

                    </div>
               
                <?php } ?>
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