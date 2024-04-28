<?php
include ("sess_check.php");

if (isset($_GET['nip'])) {
	$sql = "SELECT * FROM employee WHERE nip='" . $_GET['nip'] . "'";
	$ress = mysqli_query($conn, $sql);
	$data = mysqli_fetch_array($ress);
}
// deskripsi halaman
$pagedesc = "Data Karyawan";
$menuparent = "master";
include ("layout_top.php");
?>
<script type="text/javascript">
	function checknipAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "check_nipavailability.php",
		data:'nip='+$("#nip").val(),
		type: "POST",
		success:function(data){
			$("#user-availability-status").html(data);
			$("#loaderIcon").hide();
		},
		error:function (){}
	});
	}
</script>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Data Karyawan</h1>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12"><?php include ("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="karyawan_update.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Edit Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">NIP</label>
										<div class="col-sm-4">
											<input type="text" name="niplama" class="form-control" placeholder="nip" value="<?php echo $data['nip'] ?>" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">NIP Baru (Abaikan jika tidak diubah)</label>
										<div class="col-sm-4">
											<input type="text" name="nip" id="nip" onBlur="checknipAvailability()" class="form-control" placeholder="NIP Baru (Abaikan Jika Tidak Ada Perubahan!)">
											<span id="user-availability-status" style="font-size:12px;"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Nama</label>
										<div class="col-sm-4">
											<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['nama_emp'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jenis Kelamin</label>
										<div class="col-sm-3">
											<select name="jk" id="jk" class="form-control" required>
												<option value="<?php echo $data['jk_emp'] ?>" selected><?php echo $data['jk_emp'] ?></option>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Telepon</label>
										<div class="col-sm-4">
											<input type="number" name="telp" min="0" class="form-control" placeholder="Telepon" value="<?php echo $data['telp_emp'] ?>"required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Unit Kerja</label>
										<div class="col-sm-4">
											<select name="unit_kerja" id="unitkerja" class="form-control" required>
												<option value="<?php echo $data['unit_kerja'] ?>"selected><?php echo $data['unit_kerja'] ?></option>
												<option value="Umum">Umum & Legal</option>
												<option value="Akuntansi">Akuntansi</option>
												<option value="Keuangan">Keuangan</option>
												<option value="SDM">SDM</option>
												<option value="Simpan Pinjam">Simpan Pinjam</option>
												<option value="Pembelian">Pembelian</option>
												<option value="Toko">Toko</option>
												<option value="Administrasi Toko">Administrasi Toko</option>
												<option value="Semen Curah">Semen Curah</option>
												<option value="Transportasi & Distribusi">Transportasi & Distribusi</option>
												<option value="Gudang Semen Curah">Gudang Semen Curah</option>
												<option value="Perdu">Perdu</option>
												<option value="Gudang Perdu">Gudang Perdu</option>
												<option value="Kontraktor">Kontraktor</option>
												<option value="SPI">SPI</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jabatan</label>
										<div class="col-sm-3">
											<input type="text" name="jabatan" class="form-control" placeholder="Jabatan" value="<?php echo $data['jabatan'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Alamat</label>
										<div class="col-sm-4">
											<textarea name="alamat" class="form-control" placeholder="Alamat" rows="3" required><?php echo $data['alamat'] ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Hak Akses</label>
										<div class="col-sm-3">
											<select name="akses" id="akses" class="form-control" required>
												<option value="<?php echo $data['hak_akses'] ?>" selected><?php echo $data['hak_akses'] ?></option>
												<option value="Kepala Unit">Kepala Unit</option>
												<option value="General Manager">General Manager</option>
												<option value="Pegawai">Pegawai</option>
												<option value="Senior Manager">Senior Manager</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jumlah Cuti</label>
										<div class="col-sm-3">
											<input type="number" name="jml" min="0" class="form-control" placeholder="Telepon" value="<?php echo $data['jml_cuti'] ?>"required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Aktif</label>
										<div class="col-sm-3">
											<select name="aktif" id="aktif" class="form-control" required>
												<option value="<?php echo $data['active']; ?>" selected><?php echo $data['active']; ?></option>
												<option value="Aktif">Aktif</option>
												<option value="Tidak Aktif">Tidak Aktif</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Password</label>
										<div class="col-sm-4">
											<input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $data['password'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Foto (Abaikan Jika Tidak Diubah)</label>
										<div class="col-sm-3">
											<input type="file" name="foto" class="form-control" accept="image/*">
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="perbarui" class="btn btn-success">Update</button>
									<button type="submit" name="cancel" onclick="cancelEdit()" class="btn btn-danger">Cancel</button>
								</div>
							</div><!-- /.panel -->
						</form>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
include ("layout_bottom.php");
?>
<!-- <script>
	// Fungsi untuk mengarahkan kembali ke halaman sebelumnya saat tombol "Cancel" ditekan
	function cancelEdit() {
		window.history.back(); // Mengarahkan kembali ke halaman sebelumnya dalam riwayat perambanan
	}
</script> -->