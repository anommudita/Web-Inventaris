<?php
// jika tidak ada session login maka tendang ke hal berikut
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

require 'laboran/functions.php';
$id_laboran = $_GET["id_laboran"];
// Popup sesuai dengan intruksi salah atau benar;
if (delete($id_laboran) > 0) {
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'laboran.php';
    </script>
    ";
} else {
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'laboran.php';
    </script>
    ";
}