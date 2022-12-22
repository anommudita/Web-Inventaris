<?php
// jika tidak ada session login maka tendang ke hal berikut
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}



require 'kepala_laboran/functions.php';
$id_kepala_laboran = $_GET["id_kepala_laboran"];
// Popup sesuai dengan intruksi salah atau benar;
if (delete($id_kepala_laboran) > 0) {
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'kepala_laboran.php';
    </script>
    ";
} else {
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'kepala_laboran.php';
    </script>
    ";
}