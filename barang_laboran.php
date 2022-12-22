<?php
// jika tidak ada session login maka tendang ke hal berikut
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}



require 'barang/functions.php';
$link = mysqli_connect("localhost", "root", "", "inventaris");
$row = mysqli_query($link, "SELECT * FROM barang");

$total = mysqli_num_rows($row);

$normal = mysqli_query($link, "SELECT * FROM barang WHERE kondisi = 'Baik'");
$nBarang = mysqli_num_rows($normal);

$rusak = mysqli_query($link, "SELECT * FROM barang WHERE kondisi = 'Rusak'");
$rBarang = mysqli_num_rows($rusak);

$mati = mysqli_query($link, "SELECT * FROM barang WHERE kondisi = 'Mati'");
$mBarang = mysqli_num_rows($mati);

$laboratorium = query("SELECT * FROM laboratorium");
$isi = $_SESSION['akun'];
// var_dump($isi);

$persenNormal = 100 * $nBarang / $total;
$persenRusak = 100 * $rBarang / $total;
$persenMati = 100 * $mBarang / $total;

$Lab = $_GET['lab'];

$barang = query("SELECT * FROM barang WHERE lab = $Lab");

if (!isset($_GET['lab'])) {
    echo "<script>
    document.location.href ='index.php';
    
</script>";
}

$barang = query("SELECT * FROM barang WHERE lab = $Lab");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <script src="js/vendor/ckeditor/ckeditor.js"></script>

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

            <!-- <div>
                <h1 class="teknik">Inventaris Teknik Elektro</h1>
            </div> -->


            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800 mt-5 mb-3">Barang</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                                <a href="tambah_barang1.php?lab=<?= $Lab ?>" class="btn btn-primary">Tambah</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center" id="dataTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Alat</th>
                                                <th>Jumlah</th>
                                                <th>Kondisi</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Alat</th>
                                                <th>Jumlah</th>
                                                <th>Kondisi</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($barang as $data) : ?>
                                            <tr>
                                                <td><?= $i += 1 ?></td>
                                                <td><?= $data['nama_alat'] ?></td>
                                                <td><?= $data['jumlah'] ?> </td>
                                                <td><?= $data['kondisi'] ?></td>
                                                <td><img src="img/<?= $data['gambar'] ?>" class="rounded"
                                                        alt="<?= $data['gambar'] ?>" width="130px">
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-row" data-toggle="buttons">
                                                        <a href="edit_barang_laboran.php?id_barang=<?= $data["id_barang"]; ?>&lab=<?= $Lab ?>"
                                                            class="btn btn-warning mr-2">Edit</a>
                                                        <a href="hapus_barang_laboran.php?id_barang=<?= $data["id_barang"]; ?>&lab=<?= $Lab ?>"
                                                            onclick="return confirm('yakin dihapus?')"
                                                            class="btn btn-danger mr-2">Hapus</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <!-- End of Main Content -->
            </div>

</body>

</html>