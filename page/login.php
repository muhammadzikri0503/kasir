<div class="container">
	<section id="content">
		<form action="" method="POST">
			<h1><span class="glyphicon glyphicon-user"></span> E-Kasir</h1> 
      <div class="alert alert-info" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign"></span> Masukkan username atau password dengan benar!
      </div>
			<div>
				<input type="text" placeholder="Username" required="" name="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password" />
			</div>
      <div>
  			<input type="submit" name="login" value="Login">
        <a href="#">Forget the password?</a>
        <a href="#">Register</a>
      </div>
		</form>
    <?php 
      if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($koneksi,htmlentities($_POST['username']));
        $password = mysqli_real_escape_string($koneksi,htmlentities($_POST['password']));

        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' ");
        $cek = mysqli_num_rows($query);

        if ($cek > 0) {
          $data = mysqli_fetch_array($query);
          $password = md5($password);

          $pass_db = $data['password'];
          if ($password == $pass_db) {
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $data['level'];
            $_SESSION['nama_user'] = $data['nama_user'];
            $_SESSION['id_user'] = $data['id_user'];
            ?>
            <script>window.location.href="index.php?p=home";</script>";
            <?php
          }else{
            ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Gagal!</strong> Password anda salah.
            </div>
            <?php
          }

        } else{
          ?>
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Gagal!</strong> Username tidak ditemukan.
          </div>
          <?php
        }
      }
     ?>
	</section>
</div>