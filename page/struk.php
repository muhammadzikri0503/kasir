<?php 
	include '../config/koneksi.php';
	$id_transaksi = $_GET['id_transaksi'];
	if (empty($id_transaksi)) {
		echo "<script>location='../index.php?p=transaksi';</script>";
	}

	$query = mysqli_query($koneksi,"SELECT * FROM transaksi LEFT JOIN pesanan ON transaksi.id_pesanan=pesanan.id_pesanan LEFT JOIN pelanggan ON pesanan.id_pelanggan= pelanggan.id_pelanggan LEFT JOIN menu ON pesanan.id_menu = menu.id_menu WHERE id_transaksi='$id_transaksi' ");
	$cek = mysqli_num_rows($query);
	if ($cek > 0) {
		$data = mysqli_fetch_array($query);
	}else{
		echo "<script>location='../index.php?p=transaksi';</script>";
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $data['id_transaksi']; ?></title>
	<style type="text/css">
		.cetak{
			width: 50%;
			height: auto;
			border: 1px solid #000;
			padding: 20px;
		}
	</style>
</head>
<body style="margin: 0 auto; font-family: monospace;">
	<center>
		<div class="cetak">
			<h2 style="margin: 0;">E-KASIR</h2>
			<br>
			<span><?php echo date('d-m-Y') . ", " . date('H:i:s') ?></span>
			<br>
			<table style="float: none;" width="100%" border="0" cellpadding="10" cellspacing="0">
				<tr>
					<td colspan="4">Nama : <?php echo $data['nama_pelanggan']; ?></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;"><?php echo $data['nama_menu'] ?></td>
					<td style="border-bottom: 1px solid #999;">Rp. <?php echo number_format($data['harga'], 0,",","."); ?></td>
					<td style="border-bottom: 1px solid #999;"><?php echo $data['jumlah'] ?> Buah</td>
					<td style="border-bottom: 1px solid #999;">Rp. <?php echo number_format($data['total'], 0,",","."); ?></td>
				</tr>
				<tr>
					<td colspan="3">Uang Pembayaran :</td>
					<td>Rp. <?php echo number_format($data['bayar'], 0,",","."); ?></td>
				</tr>
				<tr>
					<td colspan="3">Uang Kembalian &nbsp;:</td>
					<td>Rp. <?php echo number_format($data['kembalian'], 0,",","."); ?></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: center;">Terima Kasih atas kunjungan anda!</td>
				</tr>
			</table>
		</div>
	</center>

	<script>
		window.print();
	</script>
</body>
</html>