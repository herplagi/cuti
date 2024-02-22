<?php
	include("sess_check.php");
		$id = $_GET['nip'];	
		$sql = "DELETE FROM employee WHERE nip='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: karyawan.php?act=delete&msg=success");
?>