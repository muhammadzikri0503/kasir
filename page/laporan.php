<?php 
	$hari_ini = date('Y-m-d');
 ?>
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-primary">
			<div class="panel-heading">Data Transaksi</div>
			<div class="panel-body">
				<form method="GET" class="form-inline" action="">
					<input type="hidden" name="p" value="laporan">
					<div class="form-group">
						<label for="tgl_awal">Tanggal Awal :</label>
						<input type="date" name="tanggal_awal" id="tgl_awal" class="form-control" value="<?php echo !empty($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : $hari_ini ?>">	
					</div>
					<div class="form-group">
						<label for="tgl_akhir">Tanggal Akhir :</label>
						<input type="date" name="tanggal_akhir" id="tgl_akhir" class="form-control" value="<?php echo !empty($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : $hari_ini ?>">
					</div>
					<div class="form-group">
						<input type="submit" title="Filter" name="cari" value="Filter" class="btn btn-primary btn-sm">
						<button class="btn btn-success btn-sm" id="cetak"><i class="glyphicon glyphicon-print"></i></button>
					</div>
				</form>

				<table class="table table-boldered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Menu</th>
							<th>Jumlah</th>
							<th>Tanggal</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$cari = "";
							@$tanggal_awal = $_GET['tanggal_awal'];
							@$tanggal_akhir = $_GET['tanggal_akhir'];
							if (!empty($tanggal_awal)) {
								$cari .= " and date(transaksi.created_at) >= '".$tanggal_awal."' ";
							}
							if (!empty($tanggal_akhir)) {
								$cari .= " and date(transaksi.created_at) <= '".$tanggal_akhir."' ";
							}
							if (empty($tanggal_awal) && empty($tanggal_akhir)) {
								$cari .= "and date(transaksi.created_at) >= '".$hari_ini."' and date(transaksi.created_at) >= '".$hari_ini."' ";
							}

							$pembagian = 5;
							$page = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
							$mulai = $page > 1 ? $page * $pembagian - $pembagian : 0;
							$query_jumlah = mysqli_query($koneksi,"SELECT *, transaksi.created_at as tgl FROM transaksi WHERE 1=1 $cari");
							$jumlah = mysqli_num_rows($query_jumlah);
							$jumlah_halaman = ceil($jumlah / $pembagian);


							$query = mysqli_query($koneksi,"SELECT *, transaksi.created_at as tgl FROM transaksi LEFT JOIN pesanan ON transaksi.id_pesanan=pesanan.id_pesanan LEFT JOIN pelanggan ON pesanan.id_pelanggan= pelanggan.id_pelanggan LEFT JOIN menu ON pesanan.id_menu = menu.id_menu WHERE 1=1 $cari LIMIT $mulai,$pembagian ");
							$cek = mysqli_num_rows($query);
							if ($cek > 0) {
								$no = $mulai + 1;
								while ($data = mysqli_fetch_array($query)) {
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $data['nama_pelanggan'] ?></td>
										<td><?php echo $data['nama_menu']; ?></td>
										<td><?php echo $data['jumlah'] ?></td>
										<td><?php echo $data['tgl'] ?></td>
										<td><?php echo rupiah($data['total']) ?></td>
									</tr>
									<?php
								}
							}else{
								?>
								<tr>
									<td class="text-center" colspan="6">Data tidak Ada!</td>
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
				      <a href="?p=laporan&tanggal_awal=<?php echo $tanggal_awal?>&tanggal_akhir=<?php echo $tanggal_akhir ?>&halaman=<?php echo $page - 1; ?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>
				    </li>
				    <?php 
				    	for ($i=1; $i <= $jumlah_halaman; $i++) { 
				    		?>
				    		<li class="<?php echo ($i == $_GET['halaman'] ? 'active' : '') ?>"><a href="?p=laporan&tanggal_awal=<?php echo $tanggal_awal?>&tanggal_akhir=<?php echo $tanggal_akhir ?>&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				    		<?php
				    	}
				     ?>
				    <li>
				      <a href="?p=laporan&tanggal_awal=<?php echo $tanggal_awal?>&tanggal_akhir=<?php echo $tanggal_akhir ?>&halaman=<?php echo $page + 1; ?>" aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-success">
			<div class="panel-heading">Total Pemasukkan hari ini</div>
			<div class="panel-body">
				<h2>Rp. 
					<?php 
						$total_hari_ini = mysqli_query($koneksi,"SELECT sum(total) as jumlah FROM transaksi WHERE date(created_at)='".$hari_ini."' ");
						$cek_hari_ini = mysqli_num_rows($total_hari_ini);
						if ($cek_hari_ini > 0) {
							$data_hari_ini = mysqli_fetch_array($total_hari_ini);
							echo number_format($data_hari_ini['jumlah'], 2,",",".");
						}else{
							echo "Data tidak ada!";
						}
					 ?>
				</h2>
			</div>
		</div>
		<div class="panel panel-success">
			<div class="panel-heading">Total Pemasukkan 28 hari Terakhir</div>
			<div class="panel-body">
				<h2>Rp.
					<?php 
						$tgl_awal = mktime(0, 0, 0, date("m"), date("d")-27, date("Y"));
						$tgl_awal = date('Y-m-d', $tgl_awal);

						$total_dua_delapan = mysqli_query($koneksi,"SELECT sum(total) as jumlah FROM transaksi WHERE date(created_at)>='".$tgl_awal."' and date(created_at) <= '".$hari_ini."' ");
						$cek_dua_delapan = mysqli_num_rows($total_dua_delapan);
						if ($cek_dua_delapan > 0) {
							$data_dua_delapan = mysqli_fetch_array($total_dua_delapan);
							echo number_format($data_dua_delapan['jumlah'], 2,",",".");
						}else{
							echo "Data tidak ada!";
						}
					 ?>
				</h2>
			</div>
		</div>
		<div class="panel panel-success">
			<div class="panel-heading">Total Pemasukkan Selama ini</div>
			<div class="panel-body">
				<h2>Rp. 
					<?php 
						$total_semua = mysqli_query($koneksi,"SELECT sum(total) as jumlah FROM transaksi");
						$cek_semua = mysqli_num_rows($total_semua);
						if ($cek_semua > 0) {
							$data_semua = mysqli_fetch_array($total_semua);
							echo number_format($data_semua['jumlah'], 2,",",".");
						}else{
							echo "Data tidak ada!";
						}
					 ?>
				</h2>
			</div>
		</div>
	</div>
</div>