<?php
include("sess_check.php");

// Pastikan parameter no telah diterima dari URL
if(isset($_GET['no'])) {
    $no_cuti = $_GET['no'];
    
    // Lakukan penghapusan pengajuan cuti berdasarkan nomor cuti
    $sql = "DELETE FROM cuti WHERE no_cuti = '$no_cuti'";
    $result = mysqli_query($conn, $sql);

    // Periksa apakah penghapusan berhasil
    if($result) {
        // Jika berhasil, arahkan kembali ke halaman cuti_waitapp.php dengan pesan sukses
        header("location: cuti_waitapp.php?msg=success");
        exit();
    } else {
        // Jika gagal, arahkan kembali ke halaman cuti_waitapp.php dengan pesan gagal
        header("location: cuti_waitapp.php?msg=error");
        exit();
    }
} else {
    // Jika parameter no tidak diterima, arahkan kembali ke halaman cuti_waitapp.php dengan pesan error
    header("location: cuti_waitapp.php?msg=error");
    exit();
}
?>