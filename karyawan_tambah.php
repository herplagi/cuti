<?php
include("sess_check.php");

// deskripsi halaman
$pagedesc = "Data Karyawan";
$menuparent = "master";
include("layout_top.php");
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

	function validateForm() {
		var nip = document.forms["karyawanForm"]["nip"].value;
		if (nip == "") {
			alert("NIP tidak boleh kosong");
			return false;
		}
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
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="karyawan_insert.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Tambah Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">NIP</label>
										<div class="col-sm-4">
											<input type="text" name="nip" id="nip" onBlur="checknipAvailability()" class="form-control" placeholder="NIP" required>
											<span id="user-availability-status" style="font-size:12px;"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Nama</label>
										<div class="col-sm-4">
											<input type="text" name="nama" class="form-control" placeholder="Nama" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jenis Kelamin</label>
										<div class="col-sm-3">
											<select name="jk" id="jk" class="form-control" required>
												<option value="" selected>--- Pilih Jenis Kelamin ---</option>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Telepon</label>
										<div class="col-sm-4">
											<input type="number" name="telp" min="0" class="form-control" placeholder="Telepon" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Unit Kerja</label>
										<div class="col-sm-4">
										<select name="unit_kerja" id="unit_kerja" style="width: 200px; height: 33.5px; border-color:#b7b9bd; border-radius: 5px;" required>
										<option value="" disabled selected>Pilih Unit...</option>
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
										<div class="col-sm-4">
											<input type="text" name="jabatan" class="form-control" placeholder="Jabatan" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Alamat</label>
										<div class="col-sm-4">
											<textarea name="alamat" class="form-control" placeholder="Alamat" rows="3" required></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jumlah Cuti</label>
										<div class="col-sm-3">
											<input type="number" name="jml" min="0" class="form-control" placeholder="Jumlah Cuti" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Hak Akses</label>
										<div class="col-sm-3">
											<select name="akses" id="akses" class="form-control" required>
												<option value="" selected>--- Pilih Hak Akses ---</option>
												<option value="Kepala Unit">Kepala Unit</option>
												<option value="General Manager">General Manager</option>
												<option value="Pegawai">Pegawai</option>
												<option value="Senior Manager">Senior Manager</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Foto</label>
										<div class="col-sm-3">
											<input type="file" name="foto" class="form-control" accept="image/*">
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="simpan" class="btn btn-success">Simpan</button>
								</div>
							</div><!-- /.panel -->
						</form>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
include("layout_bottom.php");
?>