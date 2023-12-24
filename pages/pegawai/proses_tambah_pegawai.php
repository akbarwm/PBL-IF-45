<?php
include('../../config/koneksi.php'); // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];

    // Query untuk memasukkan data ke dalam database
    $query = "INSERT INTO data_pegawai (nip, nama, jabatan) VALUES ('$nip', '$nama', '$jabatan')";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika data berhasil dimasukkan, arahkan kembali ke halaman index pegawai
        echo "<script>alert('Data berhasil ditambahkan.');window.location='pegawai_index.php';</script>";
        exit();
    } else {
        // Jika terjadi kesalahan dalam query
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
