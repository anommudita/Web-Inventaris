<?php
// jika tidak ada session login maka tendang ke hal berikut
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}



require 'barang/functions.php';
$isi = $_SESSION['akun'];
if (!isset($_GET['lab'])) {
    echo "<script>
    document.location.href ='index.php';
    </script>";
}
$Lab = $_GET['lab'];

// cek apakah tombol submit sudah ditekan atau belum 
if (isset($_POST["submit"])) {
    // cek apakah sudah berhasil ditambahkan atau tidak;
    // data from diambil oleh $_POST dan ditangkap oleh $data;
    // Popup sesuai dengan intruksi salah atau benar;

    if (tambah($_POST) > 0) {

        echo "<script>
                alert('barang berhasil ditambahkan');
                document.location.href ='barang_laboran.php?lab=" . $Lab . "';
        </script>
        ";
    } else {
        echo "<script>
            alert('barang gagal ditambahkan');
            document.location.href = 'barang_laboran.php?lab=" . $Lab . "';
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="js/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sb-admin-2.min.css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/inventaris.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/inventaris.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body id="page-top">

    <div style="display: flex; width:100%;">
        <div class="sidebar-kepala">
            <div class="undiksha1"></div>

            <div class="profil bg-white"></div>

            <h5 class="text-center mt-3 text-white"><?= $isi['nama'] ?></h5>
            <p class="text-center text-white"><?= $isi['jabatan'] ?></p>

            <ul>
                <a style="text-decoration: none !important;" href="profil_laboran.php">
                    <li class="items"> <i class="fa fa-user"></i> Profil</li>
                </a>
                <!-- <a href="#">
                    <li class="items"> <i class="fa fa-tools"></i> Inventarisasi</li>
                </a> -->
                <div class="dropdown">
                    <button class="dropdown-toggle items" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-tools"></i> Inventarisasi
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php
                        foreach ($laboratorium as $lab) : ?>
                        <li><a class="dropdown-item"
                                href="barang_laboran.php?lab=<?= $lab['id_laboratorium'] ?>"><?= $lab['nama_laboratorium'] ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <a style="text-decoration: none !important;" href="#">
                    <li class="items"> <i class="fa fa-database"></i> Data Alat</li>
                </a>
                <a style="text-decoration: none !important;" href="#">
                    <li class="items"> <i class="fa fa-users"></i> Kontak</li>
                </a>
                <a style="text-decoration: none !important;" href="logout.php">
                    <li class="items"> <i class="fa fa-sign-out-alt"></i> Logout</li>
                </a>
            </ul>
        </div>
        <div style="width: 100%;">
            <!-- <button class="btn btn-danger mt-3 ml-4" onclick="window.location.href='logout.php'">Logout</button> -->
            <header class="d-flex align-items-center">
                <h1 class="teknik ml-4">Inventarisasi Teknik Elektro</h1>
            </header>


            <!-- Content Wrapper -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800 mt-5 mb-3">Tambah Barang</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 p-4 col-12 col-lg-8">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_alat">Nama Alat</label>
                                    <input type="text" class="form-control" required id="nama_alat"
                                        placeholder="Masukan Nama Alat" autocomplete="off" name="nama_alat">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" class="form-control" required id="jumlah"
                                        placeholder="Masukan Jumlah Barang" autocomplete="off" name="jumlah">
                                </div>

                                <div class="form-group">
                                    <label for="kondisi">Kondisi</label>
                                    <input type="text" class="form-control" required id="kondisi"
                                        placeholder="Masukan Kondisi Barang" autocomplete="off" name="kondisi">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" id="lab" value="<?= $Lab ?>" autocomplete="off" name="lab">
                                </div>

                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" class="form-control" required id="gambar"
                                        placeholder="Masukan Gambar" autocomplete="off" name="gambar">
                                </div>
                                <button type="submit" name="submit"
                                    class="btn btn-primary mt-4 float-right">Simpan</button>
                            </form>
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
                            <span>Copyright &copy; Your Website 2021</span>
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
                        <a class="btn btn-primary" href="login.html">Logout</a>
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