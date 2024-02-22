<?php
include("sess_check.php");

$nip=$_POST['nip'];
$foto=substr($_FILES["foto"]["name"],-5);
$newfoto = "foto".$nip.$foto;

	$sql = "UPDATE employee SET foto_emp='". $newfoto ."' WHERE nip='". $nip ."'";
	$ress = mysqli_query($conn, $sql);
	if($ress){
		move_uploaded_file($_FILES["foto"]["tmp_name"],"../foto/".$newfoto);
		echo "<script>alert('Ubah Foto Berhasil!');</script>";
		echo "<script type='text/javascript'> document.location = 'ubah_foto.php'; </script>";
	}else{
		echo("Error description: " . mysqli_error($conn));
		echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
		echo "<script type='text/javascript'> document.location = 'ubah_foto.php'; </script>";
	}
?>