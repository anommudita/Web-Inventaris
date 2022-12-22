<?php
// jika tidak ada session login maka tendang ke hal berikut
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

require 'barang/functions.php';

if (!isset($_GET['lab'])) {
    echo "<script>
    document.location.href ='index.php';
    </script>";
}
$Lab = $_GET['lab'];
$id_barang = $_GET["id_barang"];
$barang = query("SELECT * FROM barang WHERE id_barang = $id_barang && lab = $Lab")[0];


if (isset($_POST["submit"])) {
    // cek apakah sudah berhasil ditambahkan atau tidak;
    // data from diambil oleh $_POST dan ditangkap oleh $data;
    // Popup sesuai dengan intruksi salah atau benar;

    if (update($_POST) > 0) {

        echo "<script>
        alert('barang berhasil Update');
        document.location.href ='barang.php?lab=" . $Lab . "';
    </script>
    ";
    } else {
        echo "<script>
        alert('barang gagal Update');
        
    </script>
    ";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sb-admin-2.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon image-unnes">
                    <img src="img/unnes.png" alt="logo unnes" width="50">
                </div>
                <div class="sidebar-brand-text mx-3 font">Inventaris Lab Teknik Elektro</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Fitur
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Akun</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Account Rule </h6>
                        <a class="collapse-item" href="kepala_laboran.php">Kepala Laboran</a>
                        <a class="collapse-item" href="laboran.php">laboran</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-vial"></i>
                    <span>Laboratorium</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lab Teknik Elektro:</h6>
                        <a class="collapse-item" href="utilities-color.html">Lab 1</a>
                        <a class="collapse-item" href="utilities-border.html">Lab 2</a>
                        <a class="collapse-item" href="utilities-animation.html">Lab 3</a>
                        <a class="collapse-item" href="utilities-other.html">Lab 4</a>
                        <a class="collapse-item" href="utilities-color.html">Lab 5</a>
                        <a class="collapse-item" href="utilities-border.html">Lab 6</a>
                        <a class="collapse-item" href="utilities-animation.html">Lab 7</a>
                        <a class="collapse-item" href="utilities-other.html">Lab 8</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Lainnya
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="tentang.html">
                    <i class="fas fa-info-circle"></i>
                    <span>Tentang</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 mt-5 mb-3">Edit Barang</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 p-4 col-12 col-lg-8">
                        <form method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id_barang"
                                    placeholder="Masukan NIP Laboran" required autocomplete="off" name="id_barang"
                                    value="<?= $barang["id_barang"]; ?>">
                                <input type="hidden" class="form-control" id="gambarLama" srequired autocomplete="off"
                                    name="gambarLama" value="<?= $barang["gambar"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="nama_alat">Nama Alat</label>
                                <input type="text" class="form-control" id="nama_alat" placeholder="Masukan NIP Laboran"
                                    required autocomplete="off" name="nama_alat" value="<?= $barang["nama_alat"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control" required id="jumlah"
                                    placeholder="Masukan Username Laboran" autocomplete="off" name="jumlah"
                                    value="<?= $barang["jumlah"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="kondisi">Kondisi</label>
                                <input type="text" class="form-control" required id="kondisi"
                                    placeholder="Masukan Password Laboran" autocomplete="off" name="kondisi"
                                    value="<?= $barang["kondisi"]; ?>">
                            </div>


                            <input type="hidden" name="lab" value="<?= $barang["lab"]; ?>">

                            <div class="form-group">
                                <label for="jabatan">Gambar</label>
                                <img src="img/<?= $barang['gambar']; ?>" width="100px" alt="gambar"> <br>
                                <input type="file" class="form-control" required id="gambar"
                                    placeholder="Masukan jabatan" autocomplete="off" name="gambar"
                                    value="<?= $barang["gambar"]; ?>">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mt-4 float-right">Simpan</button>
                        </form>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


            <!-- Footer -->
            <footer class="sticky-footer bg-white footer1">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->


            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>
            <script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>