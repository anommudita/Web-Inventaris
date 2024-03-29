<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "inventaris");
// 
// var_dump($_SESSION["akun"]);
$isi = $_SESSION["akun"];
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
                <a style="text-decoration: none !important;" href="#">
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
                <h1 class="teknik ml-4">Profil kepala Laboran</h1>
            </header>

            <div class="container p-5">
                <div class="container d-flex justify-content-around align-items-center box">
                    <div class="container">
                        <table>
                            <tr class="renggang">
                                <th>
                                    Nama
                                </th>
                                <th>
                                    : <?= $isi['nama'] ?>
                                </th>
                            </tr>
                            <tr class="renggang">
                                <th>
                                    Username
                                </th>
                                <th>
                                    : <?= $isi['username'] ?>
                                </th>
                            </tr>
                            <tr class="renggang">
                                <th>
                                    NIP
                                </th>
                                <th>
                                    : <?= $isi['nip'] ?>
                                </th>
                            </tr>
                            <tr class="renggang">
                                <th>
                                    jabatan
                                </th>
                                <th>
                                    : <?= $isi['jabatan'] ?>
                                </th>
                            </tr>
                        </table>
                    </div>
                    <div class="container">
                        <div class="profil bg-white"></div>
                    </div>
                    <div class="container">
                        Edit
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