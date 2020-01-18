<?php 
	include'../config/koneksi.php';
	$tanggal_awal = $_GET['tgl_awal'];
	$tanggal_akhir = $_GET['tgl_akhir'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
	<div class="row">
		<div class="col-lg-6" style="margin: 0 auto; float: none;">
			<center>
				<h3>E-Kasir</h3>
				<h2>Laporan Penjualan Restoran</h2>
				Periode : <?php echo date("d-m-Y", strtotime($tanggal_awal)); ?> s/d <?php echo date("d-m-Y", strtotime($tanggal_akhir)); ?>			
			</center>
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Menu</th>
						<th>Jumlah</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$cari = "";
						if (!empty($tanggal_awal)) {
							$cari .= " and date(transaksi.created_at) >= '".$tanggal_awal."' ";
						}
						if (!empty($tanggal_akhir)) {
							$cari .= " and date(transaksi.created_at) <= '".$tanggal_akhir."' ";
						}

						$query = mysqli_query($koneksi,"SELECT *, sum(pesanan.jumlah) as jumlahnya, sum(transaksi.total) as total_seluruh FROM transaksi LEFT JOIN pesanan ON transaksi.id_pesanan=pesanan.id_pesanan LEFT JOIN menu ON pesanan.id_menu = menu.id_menu WHERE 1=1 $cari GROUP BY pesanan.id_menu");
						$cek = mysqli_num_rows($query);
						if ($cek > 0) {
							$no = 1;
							while ($data = mysqli_fetch_array($query)) {
								?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $data['nama_menu'] ?></td>
									<td><?php echo $data['jumlahnya'] ?></td>
									<td>Rp. <?php echo number_format($data['total_seluruh'], 2,",","."); ?></td>
								</tr>
								<?php
							}
							?>
								<tr>
									<td colspan="3" class="text-right">Total Semua :</td>
									<td>Rp.
										<?php
											$query_total = mysqli_query($koneksi, "SELECT sum(total) as total_semua FROM transaksi WHERE 1=1 $cari");
											$data_total = mysqli_fetch_array($query_total);
											echo number_format($data_total['total_semua'], 2,",",".");
										 ?>
									</td>
								</tr>
							<?php
						}else{
							?>
							<tr>
								<td class="text-center" colspan="4">Data tidak tersedia!</td>
							</tr>
							<?php
						}
					 ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
<script>window.print();</script>