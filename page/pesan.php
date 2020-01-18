<?php 
	$query = mysqli_query($koneksi,"SELECT max(id_pelanggan) as max_kode FROM pelanggan");
	$data = mysqli_fetch_array($query);
	$id_pelanggan = $data['max_kode'];

	$no_urut = (int) substr($id_pelanggan, 3, 3);
	$no_urut++;

	$char = "PLG";
	$kode_pelanggan = $char . sprintf("%03s", $no_urut);
 ?>
<h2 class="text-center">Pesanan</h2>
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading" style="text-align: center;">Tambah Pesanan</div>
			<div class="panel-body">
				<form method="POST" action="">
					<div class="col-md-6">
						<div class="form-group">
							<label for="id_pelanggan">ID Pelanggan</label>
							<input type="text" name="id_pelanggan" id="id_pelanggan" class="form-control" required="" readonly="" value="<?php echo $kode_pelanggan; ?>">
						</div>
						<div class="form-group">
							<label for="nama">Nama Pelanggan</label>
							<input type="text" name="nama" id="nama" class="form-control" required="" placeholder="Masukkan nama pelanggan">
						</div>
						<div class="form-group">
							<label for="jenis_kelamin">Jenis Kelamin</label>
							<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required="">
								<option disabled="" selected="" value="">Pilih Jenis Kelamin </option>
								<option value="laki-laki">Laki - laki</option>
								<option value="perempuan">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label for="telepon">No Telepon</label>
							<input type="number" name="telepon" id="telepon" class="form-control" required="" placeholder="Masukkan nomor telepon">
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<textarea name="alamat" id="alamat" cols="37" class="form-control" rows="4" required="" placeholder="Masukkan alamat pelanggan"></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="menu">Menu</label>
							<select name="menu" id="menu" class="form-control" required="">
								<option selected="" disabled="" value="">Pilih Menu</option>
								<?php 
									$query_menu = mysqli_query($koneksi,"SELECT * FROM menu");
									while($menu = mysqli_fetch_array($query_menu)){
										?>
										<option value="<?php echo $menu['id_menu'] ?>"><?php echo $menu['nama_menu']; ?></option>
										<?php
									}
								 ?>
							</select>
						</div>
						<div class="form-group">
							<label for="jumlah">Jumlah</label>
							<input type="number" class="form-control" id="jumlah" name="jumlah" required="" min="1" placeholder="Masukkan jumlah pesanan">
						</div>
						<div class="form-group">
							<button class="btn btn-primary" name="simpan">Simpan</button>
						</div>
					</div>
				</form>
			</div>
			<?php 
				if (isset($_POST['simpan'])) {
					$id_pelanggan = $_POST['id_pelanggan'];
					$nama_pelanggan = $_POST['nama'];
					$jenis_kelamin = $_POST['jenis_kelamin'];
					$telepon = $_POST['telepon'];
					$alamat = $_POST['alamat'];
					$menu = $_POST['menu'];
					$jumlah = $_POST['jumlah'];

					$query_pelanggan = mysqli_query($koneksi,"INSERT INTO pelanggan SET id_pelanggan='$id_pelanggan',nama_pelanggan='$nama_pelanggan',jenis_kelamin='$jenis_kelamin',no_hp='$telepon',alamat='$alamat' ");
					if ($query_pelanggan) {
						$query_pesanan = mysqli_query($koneksi,"INSERT INTO pesanan SET id_menu='$menu',id_pelanggan='$id_pelanggan',jumlah='$jumlah',id_user='$id_user',status='0' ");

						echo "<script>location='index.php?p=pesan&halaman=1';</script>";
					}else{
						?>
						<div class="alert alert-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> Pesanan gagal!</div>
						<?php
					}
				}
			 ?>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div style="text-align: center;" class="panel-heading">Daftar Pesanan Hari ini</div>
		  <!-- Table -->
		  <table class="table table-boldered table-striped">
		    	<thead>
		    		<tr>
		    			<th>No</th>
		    			<th>Nama Pelanggan</th>
		    			<th>Menu</th>
		    			<th>Jumlah</th>
		    			<th>Status</th>
		    			<th>Opsi</th>
		    		</tr>
		    	</thead>
		    	<tbody>
		    		<?php 
		    			$hari_ini = date('Y-m-d');
						$pembagian = 7;
						$page = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
						$mulai = $page > 1 ? $page * $pembagian - $pembagian : 0;
						$query_jumlah = mysqli_query($koneksi,"SELECT * FROM pesanan WHERE date(tanggal_pesanan)='$hari_ini'");
						$jumlah = mysqli_num_rows($query_jumlah);
						$jumlah_halaman = ceil($jumlah / $pembagian);
		    			$query_tampil = mysqli_query($koneksi, "SELECT * FROM pesanan 
		    													LEFT JOIN pelanggan ON pesanan.id_pelanggan=pelanggan.id_pelanggan 
		    													LEFT JOIN menu ON pesanan.id_menu=menu.id_menu WHERE date(tanggal_pesanan)='$hari_ini' LIMIT $mulai,$pembagian");
		    			$cek = mysqli_num_rows($query_tampil);

		    			if ($cek > 0) {
		    				$no = $mulai + 1;
		    				while ($data_tampil = mysqli_fetch_array($query_tampil)) {
		    					?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $data_tampil['nama_pelanggan']; ?></td>
									<td><?php echo $data_tampil['nama_menu']; ?></td>
									<td><?php echo $data_tampil['jumlah']; ?></td>
									<td>
										<?php 
											if ($data_tampil['status'] == 0) {
												?>
												<span class="label label-warning">Belum</span>
												<?php
											}
											elseif ($data_tampil['status'] == 1) {
												?>
												<span class="label label-info">Sudah</span>
												<?php
											}
											else{
												?>
												<span class="label label-success">Lunas</span>
												<?php
											}
										 ?>
									</td>
									<?php 
										if ($data_tampil['status'] == 0) {
											?>
											<td>
												<a onclick="return confirm('Apakah anda yakin sudah melayani pelanggan ini?')" title="Tandai" href="index.php?p=tandai&id_pesanan=<?php echo $data_tampil['id_pesanan']; ?>&halaman=<?php echo $_GET['halaman']; ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i></a>
											</td>
										 	<?php
										}else{
											
										}
									 ?>
								</tr>
		    					<?php
		    				}
		    			}else{
		    				?>
		    				<tr>
		    					<td colspan="6" style="text-align: center;">Tidak ada pesanan</td>
		    				</tr>
		    				<?php
		    			}
		    		 ?>
		    	</tbody>
		  </table>
		  <div class="text-center">
			<nav>
			  <ul class="pagination">
			    <li>
			      <a href="?p=pesan&halaman=<?php echo $page - 1; ?>" aria-label="Previous">
			        <span aria-hidden="true">&laquo; Previous</span>
			      </a>
			    </li>
			    <?php 
			    	for ($i=1; $i <= $jumlah_halaman; $i++) { 
			    		?>
			    		<li class="<?php echo ($i == $_GET['halaman'] ? 'active' : '') ?>"><a href="?p=pesan&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			    		<?php
			    	}
			     ?>
			    <li>
			      <a href="?p=pesan&halaman=<?php echo $page + 1; ?>" aria-label="Next">
			        <span aria-hidden="true">Next &raquo;</span>
			      </a>
			    </li>
			  </ul>
			</nav>
		</div>
		</div>
	</div>
</div>