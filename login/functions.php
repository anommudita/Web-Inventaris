<?php
// koneksi ke database;
$link = mysqli_connect("localhost", "root", "", "inventaris");

// menangkap perintah query;
// Read()
function query($query)
{
    // scope global supaya biasa memanggil $link dan tidak ditimpa;
    global $link;
    // result = lemari;
    // harus ada link dan string querynya;
    $result = mysqli_query($link, $query);

    // rows = kotak kosong yang akan dimasukan baju dari lemari; 
    $rows = [];
    // row = baju yang akan diambil dari lemari
    while ($row = mysqli_fetch_assoc($result)) {

        $rows[] = $row;
    }
    return $rows;
}