<?php 
	$id_menu = $_GET['id_menu'];

	$query = mysqli_query($koneksi,"DELETE FROM menu WHERE id_menu='$id_menu' ");
	if ($query) {
		echo "<script>alert('Menu berhasil di hapus!');</script>";
		echo "<script>location='index.php?p=list_menu';</script>";
	}else{
		echo "<script>alert('Menu gagal di hapus!');</script>";
	}
 ?>