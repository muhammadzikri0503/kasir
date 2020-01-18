<?php 
	$id_akses = $_GET['id_akses'];
	if (empty($id_akses)) {
		echo "<script>location='index.php?p=akses';</script>";
	}
	$query = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id_akses' ");
	$cek = mysqli_num_rows($query);
	if ($cek > 0) {
		$ambil = mysqli_fetch_array($query);
	}else{
		echo "<script>location='index.php?p=akses';</script>";
	}
 ?>
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading" style="text-align: center;">Edit Akses</div>
			<div class="panel-body">
				<div class="col-lg-8 col-lg-offset-2">
					<form action="" method="POST">
						<?php
							if ($ambil['level'] != 'admin' && $ambil['level'] != 'owner') {
							 	?>
							 	<div class="form-group">
								 	<label for="nama">Nama</label>
								 	<input type="text" name="nama" id="nama" required="" class="form-control" value="<?php echo $ambil['nama_user'] ?>">
							 	</div>
							 	<div class="form-group">
								 	<label for="username">Username</label><span style="font-size: 12px;"> (Optional)</span>
								 	<input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username baru">
							 	</div>
							 	<div class="form-group">
							 		<label for="password">Password</label><span style="font-size: 12px;"> (Optional)</span>
							 		<input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru">
							 	</div>
							 	<div class="form-group">
							 		<label for="level">Level</label>
							 		<select name="level" id="level" required="" class="form-control">
							 			<option value="" disabled="">Pilih level</option>
							 			<option value="kasir" <?php if($ambil['level'] == 'kasir'){ echo "selected"; }; ?>>Kasir</option>
							 			<option value="waiter" <?php if($ambil['level'] == 'waiter'){ echo "selected"; }; ?>>Waiter</option>
							 		</select>
							 	</div>
							 	<button name="ubah" class="btn btn-primary">Ubah</button>
						 		<a href="index.php?p=akses" class="btn btn-warning">Kembali</a>
							 	<?php
							 }
							 else{
							 	?>
							 	<div class="alert alert-danger">Akses di Tolak!!</div>
							 	<?php
							 }
						 ?>
					</form>
					<?php
						if (isset($_POST['ubah'])) {
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
						 		if (!empty($_POST['password']) && !empty($_POST['username'])) {
						 		$update = mysqli_query($koneksi,"UPDATE user SET username='$username', password='$password', nama_user='$nama', level='$level' WHERE id_user='$id_akses' ");
						 	}
						 	else{
						 		$update = mysqli_query($koneksi,"UPDATE user SET nama_user='$nama', level='$level' WHERE id_user='$id_akses' ");
						 	}
						 	echo "<script>alert('Data berhasil di perbaharui');</script>";
						 	echo "<script>location='index.php?p=akses';</script>";
						 } 
						 	}
					 ?>
				</div>
			</div>
		</div>
	</div>
</div>