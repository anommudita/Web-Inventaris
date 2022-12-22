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
    $nama_alat = htmlspecialchars($data["nama_alat"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $kondisi = htmlspecialchars($data["kondisi"]);
    $lab =  htmlspecialchars($data["lab"]);


    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO barang VALUES
            ('', '$nama_alat', '$jumlah', '$gambar', '$kondisi', '$lab')";

    mysqli_query($link, $query);
    // akan menjalankan query lalu memngembalikan nilai jika berhasil 1 jika gagal -1;
    return mysqli_affected_rows($link);
}


function delete($id_barang)
{
    global $link;

    $hapus = "DELETE FROM barang WHERE id_barang = $id_barang";
    mysqli_query($link, $hapus);
    return mysqli_affected_rows($link);
}


function update($data)
{
    global $link;

    // $id_laboran
    $id_barang = $data["id_barang"];
    $nama_alat = htmlspecialchars($data["nama_alat"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $kondisi = htmlspecialchars($data["kondisi"]);
    $lab = htmlspecialchars($data["lab"]);

    $gambarLama = htmlspecialchars($data["gambarLama"]);
    // cek user akan pilih gambar baru atau tidak;
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE barang SET 
                nama_alat = '$nama_alat',
                jumlah = '$jumlah',
                kondisi = '$kondisi',
                lab = '$lab',
                gambar = '$gambar'
                WHERE id_barang = $id_barang
                ";
    mysqli_query($link, $query);
    return mysqli_affected_rows($link);
}




// function upload gambar;
function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES["gambar"]['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek gambar apakah belum diupload;

    if ($error === 4) {

        echo "
            <script>
                alert('Masukan gambar terlebih dahulu!!!');
            </script>
        ";

        return false;
    }

    // hanya gambar boleh upload buka script yang aneh";

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
        <script>
            alert('yang anda upload bukan gambar!!!');
        </script>
    ";

        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "
        <script>
        alert('ukuran gambar terlalu besar!!!');
        </script>
        ";
        return false;
    }



    // generate nama gambar baru;
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    // pengecekan gambar sudah berhasil diupload;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}
