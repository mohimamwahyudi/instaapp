<?php

    if (isset($_POST['submit'])) {
			$pdo = new PDO ('mysql:host=localhost;dbname=instaapp','root','');
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			try {
				$query = $pdo->prepare('SELECT * FROM  users WHERE username = :username and pwd = SHA2(:password,0)');
				$query->bindValue(':username', $_POST['username']);
				$query->bindValue(':password', $_POST['password']);
				$query->execute();
				if($query->rowCount()>0){
                     foreach ($query as $row) { //Mengambil beberapa data pada db
			            $session = $row['id']; //parameter terdefinisi nilainya berisi id user
			
		}
					session_start();
					$_SESSION['isMember'] = true;
                     $_SESSION['id'] = $session;
        
					header('Location:index.php');
					exit();

				}
			
		} catch (PDOException $e) {
			echo $e -> getMassage();
			
		}
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

   
  </head>
  <body>
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5 bg-white p-sm-4">
            <h4>Log in</h4>
            
            <form class="my-2" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>

                <button type="submit" class="btn text-white btn-block bg-dark" name="submit">Masuk</button>
            </form>
            <small>Belum punya akun? daftar <a href="daftar.php">disini</a></small>
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