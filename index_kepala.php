<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "inventaris");
$row = mysqli_query($link, "SELECT * FROM barang");

$total = mysqli_num_rows($row);

$normal = mysqli_query($link, "SELECT * FROM barang WHERE kondisi = 'Baik'");
$nBarang = mysqli_num_rows($normal);

$rusak = mysqli_query($link, "SELECT * FROM barang WHERE kondisi = 'Rusak'");
$rBarang = mysqli_num_rows($rusak);

$mati = mysqli_query($link, "SELECT * FROM barang WHERE kondisi = 'Mati'");
$mBarang = mysqli_num_rows($mati);


$isi = $_SESSION['akun'];
// var_dump($isi);

$persenNormal = 100 * $nBarang / $total;
$persenRusak = 100 * $rBarang / $total;
$persenMati = 100 * $mBarang / $total;
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
    <link href="css/inventaris.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body class="background-graph">
    <div style="display: flex; width:100%;">
        <div class="sidebar-kepala">
            <div class="undiksha1"></div>

            <div class="profil bg-white"></div>

            <h5 class="text-center mt-3 text-white"><?= $isi['nama'] ?></h5>
            <p class="text-center text-white"><?= $isi['jabatan'] ?></p>

            <ul>
                <a style="text-decoration: none !important;" href="profil_kepala.php">
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
                        <li><a class="dropdown-item" href="#">Lab 1</a></li>
                        <li><a class="dropdown-item" href="#">Lab 2</a></li>
                        <li><a class="dropdown-item" href="#">Lab 3</a></li>
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

            <!-- <div>
                <h1 class="teknik">Inventaris Teknik Elektro</h1>
            </div> -->

            <div class="fluid-container d-flex justify-content-center margin-barang p-4">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Normal</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= $nBarang ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hand-point-left fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Rusak</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rBarang ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-heart-broken  fa-2x text-gray-300"></i>
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
                                        Mati</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= $mBarang ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-skull fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Containt Graph -->
            <div class="fluid-container d-flex justify-content-center">
                <div class="col-lg-6 mb-4">
                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Normal <span
                                    class="float-right"><?= round($persenNormal, 1) ?>%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: <?= $persenNormal ?>%" aria-valuenow="20" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Rusak <span
                                    class="float-right"><?= round($persenRusak, 1) ?>%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: <?= $persenRusak ?>%" aria-valuenow="40" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Mati <span
                                    class="float-right"><?= round($persenMati, 1) ?>%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar"
                                    style="width: <?= $persenMati ?>%" aria-valuenow="60" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end  Content graph-->



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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>