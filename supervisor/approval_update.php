<?php
include("sess_check.php");

$no=$_POST['no'];
$aksi=$_POST['aksi'];
$mng=$_POST['mng'];
$reject=$_POST['reject'];
$stt = "";
$null = 0;

if($aksi=="2"){
	$stt="Rejected";
	$sql = "UPDATE cuti SET
			stt_cuti='". $stt ."',
			kep_unit_app='". $null ."',
			ket_reject='". $reject ."'
			WHERE no_cuti='". $no ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: approval_cuti.php?act=update&msg=success");
	
}else{
	$stt="Menunggu Approval General Manager";
	$num	=1;
	$sql = "UPDATE cuti SET
			stt_cuti='". $stt ."',
			gen_manager='". $mng ."',
			smg_app='". $num ."'
			WHERE no_cuti='". $no ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: approval_cuti.php?act=update&msg=success");
	
}
?>