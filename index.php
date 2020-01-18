<?php
  session_start();
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); 
  include'config/koneksi.php'; 
  include'config/function.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>E-Kasir</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="page/style.css">
  <link rel="icon" type="image/png" href="page/login.png">
</head>
<?php 
if (!empty($_SESSION['username'])) {
  @$user = $_SESSION['username'];
  @$level = $_SESSION['level'];
  @$nama_user = $_SESSION['nama_user'];
  @$id_user = $_SESSION['id_user'];
 ?>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">E-Kasir</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="index.php?p=home">Beranda</a></li>
        <?php 
          if (@$level == "admin") {
         ?>
        <li><a href="index.php?p=list_menu">List Menu</a></li>
        <li><a href="index.php?p=pesan&halaman=1">Pesan</a></li>
        <li><a href="index.php?p=transaksi">Transaksi</a></li>
        <li><a href="index.php?p=akses">Akses</a></li>
        <li><a href="index.php?p=laporan">Laporan</a></li>
        <?php } ?>

        <?php 
          if (@$level == "waiter") {
         ?>
        <li><a href="index.php?p=pesan&halaman=1">Pesan</a></li>
        <li><a href="index.php?p=laporan">Laporan</a></li>
        <?php } ?>

        <?php 
          if (@$level == "kasir") {
         ?>
        <li><a href="index.php?p=transaksi">Transaksi</a></li>
        <li><a href="index.php?p=laporan">Laporan</a></li>
        <?php } ?>
        
        <?php 
          if (@$level == "owner") {
         ?>
        <li><a href="index.php?p=akses">Akses</a></li>
        <li><a href="index.php?p=laporan">Laporan</a></li>
        <?php } ?>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php 
          if (!empty($user)) {
            ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo !empty($level) ? $level : '' ; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="page/logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
              </ul>
            </li>
            <?php
          } 
        ?>
      </ul>
    </div>
  </div>
</nav>	
<div class="container-fluid">
	<?php 

    if (@$level == "admin") {
       if (@$_GET['p'] == "") {
            include_once 'page/home.php';
          }
          elseif (@$_GET['p'] == "list_menu") {
            include_once 'page/list_menu.php';
          }
          elseif (@$_GET['p'] == "tambah_menu") {
            include_once 'page/tambah_menu.php';
          }
          elseif (@$_GET['p'] == "hapus_menu") {
            include_once 'page/hapus_menu.php';
          }
          elseif (@$_GET['p'] == "edit_menu") {
            include_once 'page/edit_menu.php';
          }
          elseif (@$_GET['p'] == "pesan") {
            include_once 'page/pesan.php';
          }
          elseif (@$_GET['p'] == "tandai") {
            include_once 'page/tandai.php';
          }
          elseif (@$_GET['p'] == "transaksi") {
            include_once 'page/transaksi.php';
          }
          elseif (@$_GET['p'] == "detail_transaksi") {
            include_once 'page/detail_transaksi.php';
          }
          elseif (@$_GET['p'] == "laporan") {
            include_once 'page/laporan.php';
          }
          elseif (@$_GET['p'] == "home") {
            include_once 'page/home.php';
          }
          elseif (@$_GET['p'] == "akses") {
            include_once 'page/akses.php';
          }
          elseif (@$_GET['p'] == "tambah_akses") {
            include_once 'page/tambah_akses.php';
          }
          elseif (@$_GET['p'] == "edit_akses") {
            include_once 'page/edit_akses.php';
          }
          elseif (@$_GET['p'] == "hapus_akses") {
            include_once 'page/hapus_akses.php';
          }
    }
    if (@$level == "kasir") {
       if (@$_GET['p'] == "") {
            include_once 'page/home.php';
          }
          elseif (@$_GET['p'] == "transaksi") {
            include_once 'page/transaksi.php';
          }
          elseif (@$_GET['p'] == "detail_transaksi") {
            include_once 'page/detail_transaksi.php';
          }
          elseif (@$_GET['p'] == "laporan") {
            include_once 'page/laporan.php';
          }
          elseif (@$_GET['p'] == "home") {
            include_once 'page/home.php';
          }
    }
    if (@$level == "waiter") {
       if (@$_GET['p'] == "") {
            include_once 'page/home.php';
          }
          elseif (@$_GET['p'] == "pesan") {
            include_once 'page/pesan.php';
          }
          elseif (@$_GET['p'] == "tandai") {
            include_once 'page/tandai.php';
          }
          elseif (@$_GET['p'] == "laporan") {
            include_once 'page/laporan.php';
          }
          elseif (@$_GET['p'] == "home") {
            include_once 'page/home.php';
          }
    }
    if (@$level == "owner") {
       if (@$_GET['p'] == "") {
            include_once 'page/home.php';
          }
          elseif (@$_GET['p'] == "laporan") {
            include_once 'page/laporan.php';
          }
          elseif (@$_GET['p'] == "home") {
            include_once 'page/home.php';
          }
          elseif (@$_GET['p'] == "akses") {
            include_once 'page/akses.php';
          }
          elseif (@$_GET['p'] == "tambah_akses") {
            include_once 'page/tambah_akses.php';
          }
          elseif (@$_GET['p'] == "edit_akses") {
            include_once 'page/edit_akses.php';
          }
          elseif (@$_GET['p'] == "hapus_akses") {
            include_once 'page/hapus_akses.php';
          }
    }	
}
else{
  include 'page/login.php';
}
	 ?>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<script>
  $(document).on('click', '#cetak', function(){
    var tgl_awal = $("#tgl_awal").val();
    var tgl_akhir = $("#tgl_akhir").val();
    window.open('page/cetak_laporan.php?tgl_awal='+tgl_awal+"&tgl_akhir="+tgl_akhir, '_blank');
  });
</script>