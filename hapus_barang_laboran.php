<?php
// jika tidak ada session login maka tendang ke hal berikut
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}



require 'barang/functions.php';
$id_barang = $_GET["id_barang"];
$Lab = $_GET['lab'];
// Popup sesuai dengan intruksi salah atau benar;
if (delete($id_barang) > 0) {
    echo "<script>
            alert('barang berhasil dihapus');
            document.location.href = 'barang_laboran.php?lab=" . $Lab . "';
    </script>
    ";
} else {
    echo "<script>
            alert('barang berhasil dihapus');
            document.location.href = 'barang_laboran.php?lab=" . $Lab . "';
    </script>
    ";
}