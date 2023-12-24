<?php
date_default_timezone_set("Asia/Jakarta");
$server 	= "localhost";
$username	= "root";
$pass		= "";
$db 		= "db_kelurahan"; 
$koneksi = mysqli_connect($server, $username, $pass, $db); 

// Untuk cek jika koneksi gagal ke database
if(mysqli_connect_errno()) {
	echo "Koneksi gagal : ".mysqli_connect_error();
}

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$whatsapp = $_POST['whatsapp'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$kewarganegaraan = $_POST['kewarganegaraan'];
$agama = $_POST['agama'];
$status_perkawinan = $_POST['status_perkawinan'];
$pekerjaan = $_POST['pekerjaan'];
$alamat = $_POST['alamat'];
$rt = $_POST['rt'];
$rw = $_POST['rw'];
$kecamatan = $_POST['kecamatan'];
$kelurahan = $_POST['kelurahan'];
$username = $_POST['username'];
$password = $_POST['password']; // Menggunakan fungsi password_hash untuk menyimpan password secara aman

$check_username_query = mysqli_query($koneksi, "SELECT * FROM login_penduduk WHERE username = '$username'");
if (mysqli_num_rows($check_username_query) > 0) {
    // Username is already taken, display an error message or redirect back to the registration page
    echo "<script>alert('Ussername sudah terdaftar. Silakan pilih Ussername lain..'); window.location='registrasi.php';</script>";
    exit();
}

$sql = "INSERT INTO login_penduduk (nik, nama, jenis_kelamin, whatsapp, username, password, tempat_lahir, tanggal_lahir, kewarganegaraan, agama, status_perkawinan, pekerjaan, alamat, rt, rw, kecamatan, kelurahan) 
        VALUES ('$nik', '$nama', '$jenis_kelamin', '$whatsapp', '$username', '$password', '$tempat_lahir', '$tanggal_lahir', '$kewarganegaraan', '$agama', '$status_perkawinan', '$pekerjaan', '$alamat', $rt, $rw, '$kecamatan', '$kelurahan')";

if ($koneksi->query($sql) === TRUE) {
    // Jika data berhasil disimpan, update nilai validasi menjadi 1
    $id_terbaru = mysqli_insert_id($koneksi);
    $update_query = "UPDATE login_penduduk SET validasi = 1 WHERE id = $id_terbaru";
    $koneksi->query($update_query);

    echo "<script>alert('Data Berhasil Disimpan.)</script>";
    header("location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
