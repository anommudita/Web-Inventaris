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



// function insert
function tambah($data)
{
    // scope global supaya biasa memanggil $link dan tidak ditimpa;
    global $link;
    // ambil data dari $_POST tiap element dalam form;
    $nip = htmlspecialchars($data["nip"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $nama =  htmlspecialchars($data["nama"]);
    $jabatan =  htmlspecialchars($data["jabatan"]);

    // $password = password_hash($password, PASSWORD_DEFAULT);
    // query insert data
    $query = "INSERT INTO laboran VALUES
            ('', '$username', '$password', '$nama', '$jabatan', '$nip')";

    mysqli_query($link, $query);
    // akan menjalankan query lalu memngembalikan nilai jika berhasil 1 jika gagal -1;
    return mysqli_affected_rows($link);
}



function delete($id_laboran)
{
    global $link;

    $hapus = "DELETE FROM laboran WHERE id_laboran = $id_laboran";
    mysqli_query($link, $hapus);
    return mysqli_affected_rows($link);
}


function update($data)
{
    global $link;

    // $id_laboran
    $id_laboran = $data["id_laboran"];
    $nip = htmlspecialchars($data["nip"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $nama = htmlspecialchars($data["nama"]);
    $jabatan = htmlspecialchars($data["jabatan"]);



    $query = "UPDATE laboran SET 
                username = '$username',
                password = '$password',
                nama = '$nama',
                jabatan = '$jabatan',
                nip = '$nip'
                WHERE id_laboran = $id_laboran
                ";
    mysqli_query($link, $query);
    return mysqli_affected_rows($link);
}
