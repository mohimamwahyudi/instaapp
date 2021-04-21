<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Daftar</title>
  </head>
  <body>
      
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5 bg-white p-sm-4">
            <h4>Daftar</h4>
            <?php
               
	
                if (isset($_POST["submit"])){
                    $nama=$_POST['nama'];
                    $tgl=$_POST['tgl'];
                    $user=$_POST['username'];
                    $pass=$_POST['password'];
                    $konfir=$_POST['konfir'];

                    if (empty($nama) || empty($tgl) || empty($user) || empty($pass) || empty($konfir)) {
                        echo '<div class="alert alert-danger mt-2" role="alert">Silahkan lengkapi form yang disediakan!</div>';
                    }
                    elseif($pass !== $konfir){
                        echo '<div class="alert alert-danger mt-2" role="alert">Konfimasi Password tidak benar!</div>';
                    }
                    else {
                         try {
                        $dbc = new PDO('mysql:host=localhost;dbname=instaapp','root',''); //Membuat koneksi db
                        $dbc -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = $dbc->prepare("INSERT INTO users VALUES (Null,:nama_lengkap, :tgl,'default.jpg',:username, SHA2(:password,0))");
                        $query->bindValue(':nama_lengkap', $nama);
                        $query->bindValue(':tgl', $_POST['tgl']);
                        $query->bindValue(':username', $_POST['username']);
                        $query->bindValue(':password', $_POST['password']);
                        $query->execute();
                        if ($query>0) {
                             echo "<script>alert('Anda berhasil mendaftar, silahkan login');window.location='login.php';</script>";
                        }
                       
                        }catch (Exception $err) {
		                echo $err->getMessage();
		
	                    }

                    }
                }
                
            ?>
            <form class="my-2" method="post">
                <div class="form-group">
                    <label>Nama Anda</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Anda" value="<?php echo (isset($_POST['nama']))?$_POST['nama']:'';?>" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tgl" placeholder="Tanggal Lahir" value="<?php echo (isset($_POST['tgl']))?$_POST['tgl']:'';?>" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo (isset($_POST['username']))?$_POST['username']:'';?>" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required value="<?php echo (isset($_POST['password']))?$_POST['password']:'';?>">
                </div>
                <div class="form-group">
                    <label>Konfimasi Password</label>
                    <input type="password" class="form-control" name="konfir" placeholder="Konfirmasi Password" value="<?php echo (isset($_POST['konfir']))?$_POST['konfir']:'';?>" required>
                </div>

                <button type="submit" class="btn text-white btn-block bg-dark" name="submit">Daftar</button>
            </form>
            <small>Sudah punya akun? Masuk <a href="login.php">disini</a></small>
        </div>
    </div>
</div>

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

