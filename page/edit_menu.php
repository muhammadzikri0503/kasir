<?php 
	@$id_menu = $_GET['id_menu'];
	if (empty($id_menu)) {
		echo "<script>location='index.php?p=list_menu';</script>";
	}else{
		$ambil = mysqli_query($koneksi,"SELECT * FROM menu WHERE id_menu='$id_menu' ");
		$cek = mysqli_num_rows($ambil);
		if ($cek > 0) {
			$data = mysqli_fetch_array($ambil);
		}
		else{
			echo "<script>location='index.php?p=list_menu';</script>";
		}
	}
 ?>
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Edit Menu</div>
		  <div class="panel-body">
		  	<div class="col-md-8 col-md-offset-2">
		  		<form action="" method="POST">
			    	<div class="form-group">
			    		<label for="nama">Nama</label>
			    		<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $data['nama_menu'] ?>"  required="">
			    	</div>
			    	<div class="form-group">
			    		<label for="harga">Harga</label>
			    		<input type="number" id="harga" name="harga" class="form-control" min="1000" value="<?php echo $data['harga'] ?>" required="">
			    	</div>
			    	<div class="form-group">
			    		<button name="simpan" class="btn btn-primary">Simpan</button>
			    		<a href="index.php?p=list_menu" class="btn btn-warning">Kembali</a>
			    	</div>
			    </form>
			    <?php 
			    	if (isset($_POST['simpan'])) {
			    		$nama_menu = $_POST['nama'];
			    		$harga = $_POST['harga'];

			    		$query = mysqli_query($koneksi,"UPDATE menu SET nama_menu='$nama_menu',harga='$harga' WHERE id_menu='$id_menu' ");
			    		if ($query) {
			    			echo "<script>alert('Menu berhasil diperbaharui');</script>";
			    			echo "<script>location='index.php?p=list_menu';</script>";
			    		}else{
			    			echo "<script>alert('Menu gagal diperbaharui');</script>";
			    		}
			    	}
			     ?>
		  	</div>
		  </div>
		</div>
	</div>
</div>