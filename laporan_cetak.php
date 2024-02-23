<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");

if (isset($_GET['awal']) && isset($_GET['akhir'])) {
    $mulai = $_GET['awal'];
    $selesai = $_GET['akhir'];

    // Filter berdasarkan unit jika dipilih
    $unit_filter = '';
    if (!empty($_GET['unit'])) {
        $unit_filter = "AND employee.unit_kerja = '{$_GET['unit']}'";
    }

    // Query untuk mengambil data cuti berdasarkan periode dan unit yang dipilih
    $sql = "SELECT cuti.*, employee.* FROM cuti 
            INNER JOIN employee ON cuti.nip = employee.nip 
            WHERE cuti.tgl_pengajuan BETWEEN '$mulai' AND '$selesai' $unit_filter 
            ORDER BY cuti.tgl_pengajuan DESC";
    $query = mysqli_query($conn, $sql);
    
    // Retrieve the first row to get the unit_kerja
    $first_row = mysqli_fetch_assoc($query);
    
    // Reset query pointer to the beginning
    mysqli_data_seek($query, 0);
    
    // deskripsi halaman
    $pagedesc = "Laporan Data Cuti - Periode " . IndonesiaTgl($mulai) . " - " . IndonesiaTgl($selesai);
    $pagetitle = str_replace(" ", "_", $pagedesc);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="universitas andalas">

    <title><?php echo $pagetitle ?></title>

    <link href="libs/images/KKSP.png" rel="icon" type="images/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/offline-font.css" rel="stylesheet">
    <link href="dist/css/custom-report.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="libs/jquery/dist/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <section id="header-kop">
        <div class="container-fluid">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td class="text-left" width="20%">
                            <img src="libs/images/KKSP.png" alt="logo-dkm" width="70" />
                        </td>
                        <td class="text-center" width="60%">
                            <b>KKSP</b> <br>
                            Komplek PT. Semen Padang, Jl Raya Indarung, Kec. Lubuk Kilangan, Kota Padang, Sumatera
                            Barat 25237 <br>
                            Telp: (0751)-777987 <br>
                        <td class="text-right" width="20%">
                            <img src="libs/images/KKSP.png" alt="logo-dkm" width="70" height="70" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr class="line-top" />
        </div>
    </section>

    <section id="body-of-report">
        <div class="container-fluid">
            <h4 class="text-center">LAPORAN DATA CUTI</h4>
            <h5 class="text-center">Periode <?php echo IndonesiaTgl($mulai) . " - " . IndonesiaTgl($selesai) ?></h5>
            <h5 class="text-center">Unit Kerja: <?php echo $first_row['unit_kerja']; ?></h5>
            <br />
            <table class="table table-bordered table-keuangan">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th width="5%">NIP</th>
                        <th width="10%">Nama Pemohon</th>
                        <th width="5%">Tgl Pengajuan</th>
                        <th width="5%">Tgl Awal</th>
                        <th width="5%">Tgl Akhir</th>
                        <th width="10%">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)) {
                        echo '<tr>';
                        echo '<td class="text-center">' . $i . '</td>';
                        echo '<td>' . $data['nip'] . '</td>';
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
            <br />
        </div><!-- /.container -->
    </section>

    <script type="text/javascript">
        $(document).ready(function () {
            window.print();
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- jTebilang JavaScript -->
    <script src="libs/jTerbilang/jTerbilang.js"></script>

</body>

</html>
<?php } ?>
