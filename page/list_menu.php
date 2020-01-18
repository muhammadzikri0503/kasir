<h1 class="text-center">Daftar Menu</h1>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="col-md-8">
			<a title="Tambah" href="index.php?p=tambah_menu" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i></a>
		</div>
		<div class="col-md-4">
			<form action="" class="form-inline" method="GET">
				<input type="hidden" name="p" value="list_menu">
				<input type="text" name="cari" class="form-control" placeholder="Masukkan nama menu...">
				<button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-search"></i></button>
			</form>
		</div>
		<hr>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Menu</th>
					<th>Harga</th>
					<th>Tanggal Ditambahkan</th>
					<th>Tanggal Di ubah</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					@$cari = $_GET['cari'];
					$query_cari = "";
					if (!empty($cari)) {
						$query_cari .= " and nama_menu LIKE '%".$cari."%' ";
					}
					$pembagian = 5;
					$page = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
					$mulai = $page > 1 ? $page * $pembagian - $pembagian : 0;

					$query = mysqli_query($koneksi,"SELECT * FROM menu WHERE 1=1 $query_cari LIMIT $mulai,$pembagian");

					$query_jumlah = mysqli_query($koneksi,"SELECT * FROM menu ");
					$jumlah = mysqli_num_rows($query_jumlah);


					$cek = mysqli_num_rows($query);
					$jumlah_halaman = ceil($jumlah / $pembagian);

					if ($cek > 0) {
						$no = $mulai + 1;
						while ($data = mysqli_fetch_array($query)){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $data['nama_menu'] ?></td>
							<td><?php echo rupiah($data['harga']) ?></td>
							<td><?php echo $data['created_at'] ?></td>
							<td><?php echo $data['updated_at'] ?></td>
							<td>
								<a title="Edit" class="btn btn-info btn-sm" href="index.php?p=edit_menu&id_menu=<?php echo $data['id_menu']; ?>"><i class="glyphicon glyphicon-edit"></i></a>
								<a title="Hapus" onclick="return confirm('Apakah anda ingin menghapus menu?')" class="btn btn-danger btn-sm" href="index.php?p=hapus_menu&id_menu=<?php echo $data['id_menu']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
							</td>
						</tr>
						<?php
						}
					}else{
						?>
						<tr>
							<td colspan="6" class="text-center">Tidak ada data <a title="Refresh" href="index.php?p=list_menu" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-refresh"></i></a></td>
						</tr>
						<?php
					}
				 ?>
			</tbody>
		</table>
		<div>
			<p>Jumlah : <?php echo $jumlah; ?></p>
		</div>
		<div class="text-center">
			<nav>
			  <ul class="pagination">
			    <li>
			      <a href="?p=list_menu&halaman=<?php echo $page - 1; ?>" aria-label="Previous">
			        <span aria-hidden="true">&laquo; Previous</span>
			      </a>
			    </li>
			    <?php 
			    	for ($i=1; $i <= $jumlah_halaman; $i++) { 
			    		?>
			    		<li class="<?php echo ($i == $_GET['halaman'] ? 'active' : '') ?>"><a href="?p=list_menu&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			    		<?php
			    	}
			     ?>
			    <li>
			      <a href="?p=list_menu&halaman=<?php echo $page + 1; ?>" aria-label="Next">
			        <span aria-hidden="true">Next &raquo;</span>
			      </a>
			    </li>
			  </ul>
			</nav>
		</div>
	</div>
</div>