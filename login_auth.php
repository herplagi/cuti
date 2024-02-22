<?php
session_start();
include("dist/config/koneksi.php");

if (isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        header("location: login.php?err=empty");
    } else {
        $username = $_POST['username'];
        $password = $_POST['password']; 
        $username = htmlentities(trim(strip_tags($username)));
        $password = htmlentities(trim(strip_tags($password)));

        // Cek ke tabel Admin
        $sql = "SELECT * FROM admin WHERE user_adm='$username' AND pass_adm='$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $_SESSION['admin'] = strtolower($row['id_adm']);
            header("location: index.php?login=success");
        } else {
            // Cek ke tabel Employee berdasarkan hak akses
            $sql = "SELECT * FROM employee WHERE nip='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            if ($row) {
                $role = strtolower($row['hak_akses']);
                $_SESSION[$role] = strtolower($row['nip']);

                switch ($role) {
                    case 'kepala unit':
                        header("location: leader/index.php?login=success");
                        break;
                    case 'general manager':
                        header("location: manager/index.php?login=success");
                        break;
                    case 'pegawai':
                        header("location: pegawai/index.php?login=success");
                        break;
                    case 'senior manager':
                        header("location: supervisor/index.php?login=success");
                        break;
                    default:
                        header("location: login.php?err=not_found");
                }
            } else {
                header("location: login.php?err=not_found");
            }
        }
    }
}
?>