<?php
include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $whatsapp = $_POST['whatsapp'];
    $kewarganegaraan = $_POST['kewarganegaraan'];
    $alamat = $_POST['alamat'];
    $status_perkawinan = $_POST['status_perkawinan'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $kecamatan = $_POST['kecamatan'];
    $kelurahan = $_POST['kelurahan'];

    $query = "UPDATE `login_penduduk` SET 
              `nama`='$nama', 
              `whatsapp`='$whatsapp', 
              `kewarganegaraan`='$kewarganegaraan', 
              `alamat`='$alamat', 
              `status_perkawinan`='$status_perkawinan', 
              `rt`='$rt', 
              `rw`='$rw',
              `kecamatan`='$kecamatan',
              `kelurahan`='$kelurahan'
              WHERE `id`='$id'";

    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Data berhasil disimpan.');window.location='profil_penduduk.php';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
} else {
    echo "Metode request tidak valid";
}

$koneksi->close();
?>
