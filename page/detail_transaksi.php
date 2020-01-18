<?php 
	$id_pesanan = $_GET['id_pesanan'];

	if (empty($id_pesanan)) {
		echo "<script>location='index.php?p=transaksi';</script>";
	}

	$query = mysqli_query($koneksi,"SELECT max(id_transaksi) as max_kode FROM transaksi");
	$data = mysqli_fetch_array($query);
	$id_transaksi = $data['max_kode'];

	$no_urut = (int) substr($id_transaksi, 3, 3);
	$no_urut++;

	$char = "TNS";
	$kode_transaksi = $char . sprintf("%03s", $no_urut);

	$query_transaksi = mysqli_query($koneksi, "SELECT * FROM pesanan INNER JOIN pelanggan ON pesanan.id_pelanggan=pelanggan.id_pelanggan INNER JOIN menu ON pesanan.id_menu=menu.id_menu WHERE id_pesanan='$id_pesanan' ");
	$cek = mysqli_num_rows($query_transaksi);
	
	if ($cek > 0) {
		$data_transaksi = mysqli_fetch_array($query_transaksi);
	}else{
		echo "<script>location='index.php?p=transaksi';</script>";
	}

	$total_bayar = $data_transaksi['harga'] * $data_transaksi['jumlah'];
 ?>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary">
			<div class="panel-heading" style="text-align: center;">Input Pembayaran</div>
			<div class="panel-body">
				<form method="POST" action="">
					<div class="col-md-6">
						<div class="form-group">
							<label for="nama">Nama Pelanggan</label>
							<input type="text" name="nama" id="nama" class="form-control" readonly="" required="" value="<?php echo $data_transaksi['nama_pelanggan'] ?>">
						</div>
						<div class="form-group">
							<label for="menu">Menu</label>
							<input type="text" name="menu" id="menu" class="form-control" required="" readonly="" value="<?php echo $data_transaksi['nama_menu'] ?>">
						</div>
						<div class="form-group">
							<label for="harga_satuan">Harga Satuan</label>
							<input type="number" id="harga_satuan" name="harga_satuan" readonly="" class="form-control" required="" value="<?php echo $data_transaksi['harga'] ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="jumlah">Jumlah</label>
							<input type="number" name="jumlah" id="jumlah" min="1" class="form-control" required="" readonly="" value="<?php echo $data_transaksi['jumlah'] ?>">
						</div>
						<div class="form-group">
							<label for="total_bayar">Total Bayar</label>
							<input type="number" id="total_bayar" name="total_bayar" required="" readonly="" class="form-control" value="<?php echo $total_bayar; ?>">
						</div>
						<div class="form-group">
							<label for="uang_pelanggan">Uang Pelanggan</label>
							<input type="number" id="uang_pelanggan" name="uang_pelanggan" required=""
							<?php echo ($data_transaksi['status'] == '2' ? 'readonly' : ''); ?> placeholder="Masukkan uang pelanggan" class="form-control" min="<?php echo $total_bayar; ?>">
						</div>
					</div>
					<button title="Simpan" class="btn btn-primary" <?php echo ($data_transaksi['status'] == '2' ? 'disabled' : ''); ?> name="simpan">Simpan</button>
					<a title="Kembali" href="index.php?p=transaksi" class="btn btn-danger">Kembali</a>
				</form>
			</div>
		</div>
		<?php 
			if (isset($_POST['simpan'])) {
				$uang_pelanggan = $_POST['uang_pelanggan'];
				$kembalian = $uang_pelanggan - $total_bayar;

				$query_tambah = mysqli_query($koneksi,"INSERT INTO transaksi SET id_transaksi='$kode_transaksi',id_pesanan='$id_pesanan',total='$total_bayar',bayar='$uang_pelanggan',kembalian='$kembalian' ");

				if ($query_tambah) {
					$query_update = mysqli_query($koneksi,"UPDATE pesanan SET status='2' WHERE id_pesanan='$id_pesanan' ");
					?>
					<div class="alert alert-info">
						<a title="Print" target="_blank" href="page/struk.php?id_transaksi=<?php echo $kode_transaksi; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
						&nbsp;&nbsp;Uang Kembalian = Rp <?php echo number_format($kembalian, 2,",","."); ?>
					</div>
					<?php
				}
			}
		 ?>
	</div>
</div>