<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading" style="text-align: center;">Tambah Akses</div>
			<div class="panel-body">
				<div class="col-lg-8 col-lg-offset-2">
					<form action="" method="POST">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" id="nama" name="nama" class="form-control" required="" placeholder="Masukkan nama">
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" id="username" class="form-control" required="" placeholder="Masukkan username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" id="password" name="password" required="" class="form-control" placeholder="Masukkan password">
						</div>
						<div class="form-group">
							<label for="level">Level</label>
							<select name="level" id="level" class="form-control" required="">
								<option selected="" disabled="" value="">Pilih level</option>
								<option value="kasir">Kasir</option>
								<option value="waiter">Waiter</option>
							</select>
						</div>
						<button name="tambah" class="btn btn-primary">Tambah</button>
						<a href="index.php?p=akses" class="btn btn-warning">Kembali</a>
					</form>
				</div>
				<?php 
					if (isset($_POST['tambah'])) {
						$nama = $_POST['nama'];
						$username = $_POST['username'];
						$password = md5($_POST['password']);
						$level = $_POST['level'];

						$periksa = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'");
						 	$periksa_data = mysqli_num_rows($periksa);

					 	if ($periksa_data > 0) {
					 		echo "<script>alert('Username telah dipakai!');</script>";
					 	}
					 	else{
					 		$query = mysqli_query($koneksi, "INSERT INTO user SET username='$username', password='$password', nama_user='$nama', level='$level' ");
							if ($query) {
								echo "<script>alert('Tambah hak akses berhasil!');</script>";
								echo "<script>location='index.php?p=akses'</script>";
							}
							else{
								echo "<script>('Tambah hak akses gagal!')</script>";
							}
					 	}
					}
				 ?>
			</div>
		</div>
	</div>
</div>