<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading" style="text-align: center;">Hak Akses</div>
			<div class="panel-body">
				<a href="index.php?p=tambah_akses" class="btn btn-primary">Tambah</a>
				<br><br>
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Level</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$query = mysqli_query($koneksi,"SELECT * FROM user ");
								$cek = mysqli_num_rows($query);
								if ($cek > 0) {
									$no = 1;
									while ($data = mysqli_fetch_array($query)) {
										if ($data['level'] != "admin" && $data['level'] != "owner") {
											?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $data['nama_user'] ?></td>
												<td><?php echo $data['username'] ?></td>
												<td><?php echo $data['level'] ?></td>
												<td>
													<a href="index.php?p=edit_akses&id_akses=<?php echo $data['id_user'] ?>" title="Edit" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i></a>
													<a onclick="return confirm('Apakah anda yakin ingin menghapus user ini?');" href="index.php?p=hapus_akses&id_akses=<?php echo $data['id_user'] ?>" title="Hapus" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
												</td>
											</tr>
											<?php
										}
									}
								}else{
									?>
									<tr>
										<td colspan="5" class="text-center">Data tidak ada!</td>
									</tr>
									<?php
								}
							 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>