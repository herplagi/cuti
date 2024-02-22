<?php
include("sess_check.php");

// deskripsi halaman
$pagedesc = "Laporan Data Cuti";
include("layout_top.php");
include("dist/function/format_tanggal.php");
?>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Laporan Data Cuti</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12">
				<?php include("layout_alert.php"); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<form method="get" name="laporan" onSubmit="return valid();">
							<div class="form-group">
								<div class="col-sm-4">
									<label>Tanggal Awal</label>
									<input type="date" class="form-control" name="awal"
										placeholder="From Date(dd/mm/yyyy)" required>
								</div>
								<div class="col-sm-4">
									<label>Tanggal Akhir</label>
									<input type="date" class="form-control" name="akhir"
										placeholder="To Date(dd/mm/yyyy)" required>
								</div>
								<div class="col-sm-4">
									<label>Unit</label><br>
									<select name="unit" id="unit" style="width: 200px; height: 33.5px; border-color:#b7b9bd; border-radius: 5px;">
										<option value="" disabled selected>Pilih Unit...</option>
										<option value="">Umum & Legal</option>
										<option value="">Akuntansi</option>
										<option value="">Keuangan</option>
										<option value="">SDM</option>
										<option value="">Simpan Pinjam</option>
										<option value="">Pembelian</option>
										<option value="">Toko</option>
										<option value="">Administrasi Toko</option>
										<option value="">Semen Curah</option>
										<option value="">Transportasi & Distribusi</option>
										<option value="">Gudang Semen Curah</option>
										<option value="">Perdu</option>
										<option value="">Gudang Perdu</option>
										<option value="">Kontraktor</option>
										<option value="">SPI</option>
									</select>
								</div>
								<div class="col-sm-4">
									<label>&nbsp;</label><br />
									<input type="submit" name="submit" value="Lihat Laporan" class="btn btn-primary">
								</div>
							</div>
						</form>
					</div>
				</div>
				<?php
				if (isset($_GET['submit'])) {
					$no = 0;
					$mulai = $_GET['awal'];
					$selesai = $_GET['akhir'];
					$sql = "SELECT cuti.*, employee.* FROM cuti, employee WHERE cuti.nip=employee.nip 
										AND cuti.tgl_pengajuan BETWEEN '$mulai' AND '$selesai' ORDER BY cuti.tgl_pengajuan DESC";
					$query = mysqli_query($conn, $sql);
					?>

					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<table class="table table-striped table-bordered table-hover" id="tabel-data">
										<thead>
											<tr>
												<th width="1%">No</th>
												<th width="10%">NIP</th>
												<th width="10%">Nama Karyawan</th>
												<th width="5%">Tgl Pengajuan</th>
												<th width="5%">Tgl Awal</th>
												<th width="5%">Tgl Akhir</th>
												<th width="5%">Keterangan</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											while ($data = mysqli_fetch_array($query)) {
												echo '<tr>';
												echo '<td class="text-center">' . $i . '</td>';
												echo '<td>' . $data['npp'] . '</td>';
												echo '<td>' . $data['nama_emp'] . '</td>';
												echo '<td class="text-center text-nowrap">' . format_tanggal($data['tgl_pengajuan']) . '</td>';
												echo '<td class="text-center text-nowrap">' . format_tanggal($data['tgl_awal']) . '</td>';
												echo '<td class="text-center text-nowrap">' . format_tanggal($data['tgl_akhir']) . '</td>';
												echo '<td>' . $data['keterangan'] . '</td>';
												echo '</tr>';
												$i++;
											}
											?>
										</tbody>
									</table>
									<div class="form-group">
										<a href="laporan_cetak.php?awal=<?php echo $mulai; ?>&akhir=<?php echo $selesai; ?>"
											target="_blank" class="btn btn-warning">Cetak</a>
									</div>
								</div>
								<!-- Large modal -->

																																																					</div><!-- /.panel -->
																																																				</div><!-- /.col-lg-12 -->
																																																			</div><!-- /.row -->
				<?php } ?>
			</div><!-- /.container-fluid -->
		</div><!-- /#page-wrapper -->
		<!-- bottom of file -->
		<script type="text/javascript">
			$(document).ready(function () {
				$('#tabel-data').DataTable({
					"responsive": true,
					"processing": true,
					"columnDefs": [
						{ "orderable": false, "targets": [4] }
					]
				});

				$('#tabel-data').parent().addClass("table-responsive");
			});
		</script>
		<?php
		include("layout_bottom.php");
		?>