<?php
// jika tidak ada session login maka tendang ke hal berikut
require "laboratorium/functions.php";
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
$isi = $_SESSION['akun'];
$result = query("SELECT * FROM laboran WHERE username='" . $isi['username'] . "'");
if ($result == NULL) {
    $result2 = query("SELECT * FROM kepala_laboran WHERE username='" . $isi['username'] . "'");
}
if (!$result2 == NULL) {
    header("Location: index_kepala.php");
}
if (!$result == NULL) {
    header("Location: index_laboran.php");
}

// var_dump($isi);
// if (isset($result)) {
//     header("Location: profil.php");
// } else {
//     header("Location: graph.php");
// }
// var_dump($isi);
// die;
$laboratorium = query("SELECT * FROM laboratorium");


//count laboratorium
$get1 = mysqli_query($link, "SELECT * FROM laboratorium");
$count1 = mysqli_num_rows($get1);


//count Alat
$get2 = mysqli_query($link, "SELECT * FROM barang");
$count2 = mysqli_num_rows($get2);


//count Kepala_laboran
$get3 = mysqli_query($link, "SELECT * FROM kepala_laboran");
$count3 = mysqli_num_rows($get3);

//count Laboran
$get4 = mysqli_query($link, "SELECT * FROM laboran");
$count4 = mysqli_num_rows($get4);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventaris</title>

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
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
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
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Akun</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Account Rule </h6>
                        <a class="collapse-item" href="laboran.php">laboran</a>
                        <a class="collapse-item" href="kepala_laboran.php">Kepala Laboran</a>
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

                        <?php
                        foreach ($laboratorium as $lab) : ?>
                        <a class="collapse-item"
                            href="barang.php?lab=<?= $lab['id_laboratorium'] ?>"><?= $lab['nama_laboratorium'] ?></a>
                        <?php endforeach; ?>

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
                <a class="nav-link" href="Pengaturan.php">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="tentang.php">
                    <i class="fas fa-info-circle"></i>
                    <span>Tentang</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
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

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">
                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                            <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Laboratorium</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count1; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-vial fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Alat</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count2 ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-cogs  fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kepala Laboran -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Kepala Laboran</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count3 ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Laboran -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Laboran</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count4 ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <div class="col-lg-6 ">
                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Pemberitahuan</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                                src="img/alert.svg" alt="">
                                        </div>
                                        <p>Dikarenakan proses pengerjaan yang terburu-buru, beberapa fitur mungkin saja
                                            mengalami masalah. Untuk meminimalisir terjadinya kesalahan atau tata letak
                                            yang tidak sesuai, pengguna dimohon untuk memperhatikan beberapa
                                            <strong>aturan penggunaan sistem</strong> yang berlaku.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Aturan Penggunaan</h6>
                                    </div>
                                    <div class="card-body">
                                        <p>Aturan sistem yang berlaku :</p>
                                        <ol>
                                            <li>Gunakan gambar dengan format png, jpeg, dan jpg</li>
                                            <li>Gunakan gambar dengan ukuran yang dibawah 1Mb</li>
                                            <li>Jangan memuat ulang halaman ketika proses upload</li>
                                            <li>Setiap kolom form wajib diisi</li>
                                            <li>Pembaharuan gambar tidak diizinkan</li>
                                            <li>Pastikan penambahan akun tidak duplikat</li>
                                            <li>Penambahan atau pembaharuan jabatan tidak diizinkan</li>
                                        </ol>
                                        <p>Catatan :</p>
                                        <p>Jangan lupa untuk memperbaharui aturan penggunaan ketika sistem diperbaiki
                                            atau diperbaharui.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->


                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Team Undiksha 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

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

</body>

</html>