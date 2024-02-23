<?php
include("sess_check.php");

$no=$_POST['no'];
$aksi=$_POST['aksi'];
$sen_manager=$_POST['sen_manager'];
$reject=$_POST['reject'];
$stt = "";

if($aksi=="2"){
	$stt="Rejected";
	$sql = "UPDATE cuti SET
			stt_cuti='". $stt ."',
			ket_reject='". $reject ."'
			WHERE no_cuti='". $no ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: approval_cuti.php?act=update&msg=success");
	
}else{
	$stt="Menunggu Approval Senior Manager";
	$num	=1;
	$sql = "UPDATE cuti SET
			stt_cuti='". $stt ."',
			sen_manager='". $sen_manager ."',
			kep_unit_app='". $num ."'
			WHERE no_cuti='". $no ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: approval_cuti.php?act=update&msg=success");
	
}
?>