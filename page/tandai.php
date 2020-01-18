<?php 
	$halaman = $_GET['halaman'];
	$id_pesanan = $_GET['id_pesanan'];
	if (empty($id_pesanan)) {
		echo "<script>location='index.php?p=pesan';</script>";
	}

	$ambil = mysqli_query($koneksi,"SELECT * FROM pesanan WHERE id_pesanan ='$id_pesanan' ");

	$cek = mysqli_fetch_array($ambil);

	if ($cek['status'] == 2) {
		echo "<script>location='index.php?p=pesan';</script>";

	}elseif($cek['status'] == 1 ){
		echo "<script>location='index.php?p=pesan';</script>";
	}else{
		$query_update = mysqli_query($koneksi, "UPDATE pesanan SET status='1' WHERE id_pesanan='$id_pesanan' ");
		if ($query_update) {
			echo "<script>location='index.php?p=pesan&halaman=$halaman';</script>";
		}else{
			echo "<script>alert('Gagal');</script>";
		}
	}
 ?>