<?php 
	$id_user = $_GET['id_akses'];
	if (empty($id_user)) {
		echo "<script>location='index.php?p=akses';</script>";
	}
	else{
		$query = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id_user' ");
		$cek = mysqli_num_rows($query);
		if ($cek > 0) {
			$delete = mysqli_query($koneksi,"DELETE FROM user WHERE id_user='$id_user' ");
			if ($delete) {
				echo "<script>alert('Data berhasil dihapus!');</script>";
				echo "<script>location='index.php?p=akses';</script>";
			}
		}else{
			echo "<script>location='index.php?p=akses';</script>";
		}
	}
 ?>