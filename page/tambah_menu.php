<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Tambah Menu</div>
		  <div class="panel-body">
		  	<div class="col-md-8 col-md-offset-2">
		  		<form action="" method="POST">
			    	<div class="form-group">
			    		<label for="nama">Nama</label>
			    		<input type="text" id="nama" name="nama" class="form-control"  required="" placeholder="Masukkan nama menu">
			    	</div>
			    	<div class="form-group">
			    		<label for="harga">Harga</label>
			    		<input type="number" id="harga" name="harga" class="form-control" min="1000" placeholder="Masukkan harga menu" required="">
			    	</div>
			    	<div class="form-group">
			    		<button name="simpan" class="btn btn-primary">Simpan</button>
			    		<a href="index.php?p=list_menu" class="btn btn-warning">Kembali</a>
			    	</div>
			    </form>
			    <?php 
			    	if (isset($_POST['simpan'])) {
			    		$nama = $_POST['nama'];
			    		$harga = $_POST['harga'];
			    		$query = mysqli_query($koneksi,"INSERT INTO menu SET nama_menu='$nama', harga='$harga' ");
			    		if ($query) {
			    			?>
			    			<div class="alert alert-success">
			    				Menu Berhasil di tambahkan!
			    			</div>
			    			<?php
			    		}else{
			    			?>
			    			<div class="alert alert-warning">
			    				Menu gagal di tambahkan!
			    			</div>
			    			<?php
			    		}
			    	}
			     ?>
		  	</div>
		  </div>
		</div>
	</div>
</div>