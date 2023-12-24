<?php
include('../../templates/header.php');
include('../../templates/sidebar.php');
include('../../config/koneksi.php');

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("location: ../../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data dari tabel login_penduduk berdasarkan NIK
$query_penduduk = mysqli_query($koneksi, "SELECT * FROM login_penduduk WHERE id = '$user_id'");
$data_penduduk = mysqli_fetch_assoc($query_penduduk);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Tambah Domisili</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" role="form" enctype="multipart/form-data">
                    <!-- Tampilkan data dari login_penduduk -->
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" required="" value="<?= $data_penduduk['nik']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required="" value="<?= $data_penduduk['nama']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" required="" value="<?= $data_penduduk['tempat_lahir']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" required="" value="<?= $data_penduduk['tanggal_lahir']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" class="form-control" required="" value="<?= $data_penduduk['jenis_kelamin']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <input type="text" name="agama" class="form-control" required="" value="<?= $data_penduduk['agama']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label><br>
                        <input type="text" name="alamat" class="form-control" required="" value="<?= $data_penduduk['alamat']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Keperluan</label>
                        <input type="text" name="keperluan" class="form-control" required="">
                    </div>
                   <div class="form-group">
                    <label>Pilih Surat Pengantar</label>
                    <select name="pengantar" class="form-control">
                        <?php
                        if ($_SESSION['hak_akses'] == 'penduduk' || $_SESSION['hak_akses'] == 'admin') {
                            $user_id = $_SESSION['user_id'];
                            $query = "SELECT * FROM surat_pengantar_rt WHERE user_id = '$user_id' ORDER BY upload_time DESC";
                            $datas = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                
                            // Melakukan perulangan untuk menampilkan file
                            while ($row = mysqli_fetch_assoc($datas)) {
                                $file_path =  $row['file_name'];
                        ?>
                                <option value="<?= $file_path; ?>"><?= $row['file_name']; ?></option>
                        <?php
                            }
                        } else {
                        ?>
                            <option value="" disabled selected>Tidak Ada Surat yang Tersedia</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                  <h3 style="padding-top: 10px;">Upload Dokumen</h3>
                    <div class="form-group">
                        <label>Foto KTP/KK</label>
                        <p>(File dalam bentuk .jpg/.jpeg/.png)</p>
                        <input type="file" name="file_ktp_kk" class="form-control" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
                </form>
            </div>
        </div>
        <!-- /.card-body -->
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
//melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
if (isset($_POST['submit'])) {

    // Mengambil data dari formulir
    $nik = $data_penduduk['nik'];
    $nama = $data_penduduk['nama'];
    $user_id = $_SESSION['user_id'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $keperluan = $_POST['keperluan'];
    $pengantar = $_POST['pengantar'];

    // Mengambil ekstensi file
    $ekstensi_ktp = pathinfo($_FILES['file_ktp_kk']['name'], PATHINFO_EXTENSION);
    $file_ktp_kk = uniqid('ktp_kk_') . '.' . $ekstensi_ktp;
    move_uploaded_file($_FILES['file_ktp_kk']['tmp_name'], 'img/' . $file_ktp_kk);
    

   $query_insert = mysqli_query($koneksi, "INSERT INTO data_domisili (nik, nama, user_id, tempat_lahir, tgl_lahir, jenis_kelamin, agama, alamat, keperluan, pengantar, file_ktp_kk) VALUES ('$nik', '$nama', '$user_id', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$agama', '$alamat','$keperluan', '$pengantar', '$file_ktp_kk')") or die(mysqli_error($koneksi));

    if ($query_insert) {
        echo "<script>alert('Data berhasil disimpan.');window.location='domisili-index.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }

}

?>

<?php
include('../../templates/footer.php');
?>
