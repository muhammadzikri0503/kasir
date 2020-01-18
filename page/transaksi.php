<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Data Transaksi Pesanan yang belum dibayar</div>
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
				$pembagian = 5;
				$page = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
				$mulai = $page > 1 ? $page * $pembagian - $pembagian : 0;

				$query_jumlah = mysqli_query($koneksi,"SELECT * FROM pesanan WHERE status='1' ");
				$jumlah = mysqli_num_rows($query_jumlah);
				$data_paging = mysqli_fetch_array($query_jumlah);
				
				$jumlah_halaman = ceil($jumlah / $pembagian);

				$query_tampil = mysqli_query($koneksi, "SELECT * FROM pesanan 
														LEFT JOIN pelanggan ON pesanan.id_pelanggan=pelanggan.id_pelanggan 
														LEFT JOIN menu ON pesanan.id_menu=menu.id_menu WHERE status='1' LIMIT $mulai,$pembagian");
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
							<td><a title="Proses" href="index.php?p=detail_transaksi&id_pesanan=<?php echo $data_tampil['id_pesanan']; ?>" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-share-alt"></i></a></td>
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
			<?php 
				if (!empty($data_paging)) {
					?>
					<div class="text-center">
						<nav>
						  <ul class="pagination">
						    <li>
						      <a href="?p=transaksi&halaman=<?php echo $page - 1; ?>" aria-label="Previous">
						        <span aria-hidden="true">&laquo; Previous</span>
						      </a>
						    </li>
						    <?php 
						    	for ($i=1; $i <= $jumlah_halaman; $i++) { 
						    		?>
						    		<li class="<?php echo ($i == $_GET['halaman'] ? 'active' : '') ?>"><a href="?p=transaksi&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
						    		<?php
						    	}
						     ?>
						    <li>
						      <a href="?p=transaksi&halaman=<?php echo $page + 1; ?>" aria-label="Next">
						        <span aria-hidden="true">Next &raquo;</span>
						      </a>
						    </li>
						  </ul>
						</nav>
					</div>
					<?php
				}
			 ?>
		</div>
	</div>
</div>