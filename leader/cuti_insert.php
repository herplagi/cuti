<?php
include("sess_check.php");

$nip	= $_POST['nip'];
$ajuan = date('Y-m-d');
$mulai	= $_POST['mulai'];
$akhir	= $_POST['akhir'];
$ket	= $_POST['keterangan'];
$sen_manager	= $_POST['sen_manager'];

$start = new DateTime($mulai);
$finish = new DateTime($akhir);
$int = $start->diff($finish);
$dur = $int->days;
$durasi = $dur+1;

$stt = "Menunggu Approval Senior Manager";

$id = date('dmYHis');

$pgw = "SELECT * FROM employee WHERE nip='$nip'";
$qpgw = mysqli_query($conn,$pgw);
$ress = mysqli_fetch_array($qpgw);

$jml = $ress['jml_cuti'];


if($durasi>$jml){
	echo "<script type='text/javascript'>
			alert('Durasi cuti lebih banyak dari jumlah cuti tersedia!.'); 
			document.location = 'cuti_create.php'; 
		</script>";	
}else{
	$sql 	= "INSERT INTO cuti (no_cuti, nip, tgl_pengajuan, tgl_awal, tgl_akhir, durasi, keterangan, sen_manager, stt_cuti) 
				VALUES ('$id','$nip','$ajuan','$mulai','$akhir','$durasi','$ket','$sen_manager','$stt')";
	$query 	= mysqli_query($conn,$sql);
	if($query){
		echo "<script type='text/javascript'>
				alert('Pengajuan cuti berhasil!'); 
				document.location = 'cuti_waitapp.php'; 
			</script>";

	}else {
		echo "<script type='text/javascript'>
				alert('Terjadi kesalahan, silahkan coba lagi!.'); 
				document.location = 'cuti_create.php'; 
			</script>";
	}
}
?>