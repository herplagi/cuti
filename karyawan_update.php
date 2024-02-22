<?php
	include("sess_check.php");
	
	// query database memperbarui data pada database
	if(isset($_POST['perbarui'])) {
		$niplama=$_POST['niplama'];
		$nip=$_POST['nip'];
		$nama=$_POST['nama'];
		$jml=$_POST['jml'];
		$jk=$_POST['jk'];
		$telp=$_POST['telp'];
		$unit_kerja=$_POST['unit_kerja'];
		$jabatan=$_POST['jabatan'];
		$alamat=$_POST['alamat'];
		$akses=$_POST['akses'];
		$cekfoto=$_FILES["foto"]["name"];
		$pass=$_POST['password'];
		$aktif=$_POST['aktif'];
		
	if($nip!=""){
		$sqlcek = "SELECT * FROM employee WHERE nip='$nip'";
		$ress = mysqli_query($conn, $sqlcek);
		$rows = mysqli_num_rows($ress);
		if($rows<1){
			if($cekfoto!=""){
				$foto=substr($_FILES["foto"]["name"],-5);
				$newfoto = "foto".$nip.$foto;				
				move_uploaded_file($_FILES["foto"]["tmp_name"],"foto/".$newfoto);
				$sql = "UPDATE employee SET
					nip='". $nip ."',
					nama_emp='". $nama ."',
					jk_emp='". $jk ."',
					telp_emp='". $telp ."',
					unit_kerja='". $unit_kerja ."',
					jabatan='". $jabatan ."',
					alamat='". $alamat ."',
					hak_akses='". $akses ."',
					jml_cuti='". $jml ."',
					password='". $pass ."',
					active='". $aktif ."',
					foto_emp='". $newfoto ."'
					WHERE nip='". $niplama ."'";
				$ress = mysqli_query($conn, $sql);
				header("location: karyawan.php?act=update&msg=success");
			}else{
				$sql = "UPDATE employee SET
					nip='". $nip ."',
					nama_emp='". $nama ."',
					jk_emp='". $jk ."',
					telp_emp='". $telp ."',
					unit_kerja='". $unit_kerja ."',
					jabatan='". $jabatan ."',
					alamat='". $alamat ."',
					hak_akses='". $akses ."',
					jml_cuti='". $jml ."',
					password='". $pass ."',
					active='". $aktif ."'
					WHERE nip='". $niplama ."'";
				$ress = mysqli_query($conn, $sql);
				header("location: karyawan.php?act=update&msg=success");
			}
		}else{
			header("location: karyawan_edit.php?nip=$niplama&act=add&msg=double");			
		}
	}else{
		if($cekfoto!=""){
			$foto=substr($_FILES["foto"]["name"],-5);
			$newfoto = "foto".$niplama.$foto;				
			move_uploaded_file($_FILES["foto"]["tmp_name"],"foto/".$newfoto);
				$sql = "UPDATE employee SET
					nama_emp='". $nama ."',
					jk_emp='". $jk ."',
					telp_emp='". $telp ."',
					unit_kerja='". $unit_kerja ."',
					jabatan='". $jabatan ."',
					alamat='". $alamat ."',
					hak_akses='". $akses ."',
					jml_cuti='". $jml ."',
					password='". $pass ."',
					active='". $aktif ."',
					foto_emp='". $newfoto ."'
					WHERE nip='". $niplama ."'";
			$ress = mysqli_query($conn, $sql);
			header("location: karyawan.php?act=update&msg=success");
		}else{
				$sql = "UPDATE employee SET
					nama_emp='". $nama ."',
					jk_emp='". $jk ."',
					telp_emp='". $telp ."',
					unit_kerja='". $unit_kerja ."',
					jabatan='". $jabatan ."',
					alamat='". $alamat ."',
					hak_akses='". $akses ."',
					jml_cuti='". $jml ."',
					password='". $pass ."',
					active='". $aktif ."'
					WHERE nip='". $niplama ."'";
			$ress = mysqli_query($conn, $sql);
			header("location: karyawan.php?act=update&msg=success");
		}
	}
}
?>