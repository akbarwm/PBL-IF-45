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
                    <h1>Halaman Tambah Keterangan Usaha</h1>
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
                    <!-- Tambahkan input yang lain sesuai kebutuhan -->

                    <h3 style="padding-top: 10px;">Tambah Data Usaha</h3>
                    <div class="form-group">
                        <label>Memiliki Usaha</label>
                        <input type="text" name="memiliki_usaha" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Usaha Sejak</label>
                        <input type="text" name="usaha_sejak" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Alamat Usaha</label>
                        <input type="text" name="alamat_usaha" class="form-control" required="">
                    </div>

                    <h3 style="padding-top: 10px;">Keperluan</h3>
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
                    <form enctype="multipart/form-data" method="post" action="proses_upload.php">
                        <div class="form-group">
                            <label>Foto KTP/KK</label><p>(File dalam bentuk .jpg/.jpeg/.png)</p>
                            <input type="file" name="file_ktp_kk" class="form-control" accept=".jpg, .jpeg, .png" required>
                        </div>
                        <div class="form-group">
                            <label>Foto Tempat Usaha</label><p>(File dalam bentuk .jpg/.jpeg/.png)</p>
                            <input type="file" name="file_foto_usaha" class="form-control" accept=".jpg, .jpeg, .png" required>
                        </div>
                        <div class="form-group">
                            <label>Surat Sempadan</label><p>(File dalam bentuk .docx/.pdf)</p>
                            <input type="file" name="file_surat_sempadan" class="form-control" accept=".docx, .pdf">
                        </div>
                        <div class="form-group">
                            <label>Surat Pernyataan Usaha</label><p>(File dalam bentuk .docx/.pdf)</p>
                            <input type="file" name="file_surat_pernyataan_usaha" class="form-control" accept=".docx, .pdf" required>
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
    $memiliki_usaha = $_POST['memiliki_usaha'];
    $usaha_sejak = $_POST['usaha_sejak'];
    $alamat_usaha = $_POST['alamat_usaha'];
    $keperluan = $_POST['keperluan'];
    $pengantar =  $_POST['pengantar'];

    // Mengambil ekstensi file
    $ekstensi_ktp = pathinfo($_FILES['file_ktp_kk']['name'], PATHINFO_EXTENSION);
    $ekstensi_foto_usaha = pathinfo($_FILES['file_foto_usaha']['name'], PATHINFO_EXTENSION);
    $ekstensi_surat_sempadan = pathinfo($_FILES['file_surat_sempadan']['name'], PATHINFO_EXTENSION);
    $ekstensi_pernyataan_usaha = pathinfo($_FILES['file_surat_pernyataan_usaha']['name'], PATHINFO_EXTENSION);

    // Membuat nama file unik untuk menghindari konflik nama
    $file_ktp_kk = uniqid('ktp_kk_') . '.' . $ekstensi_ktp;
    $file_foto_usaha = uniqid('foto_usaha_') . '.' . $ekstensi_foto_usaha;
    $file_surat_sempadan = uniqid('surat_sempadan_') . '.' . $ekstensi_surat_sempadan;
    $file_surat_pernyataan_usaha = uniqid('surat_pernyataan_usaha_') . '.' . $ekstensi_pernyataan_usaha;

    // Move uploaded files to the correct directory
    move_uploaded_file($_FILES['file_ktp_kk']['tmp_name'], 'img/' . $file_ktp_kk);
    move_uploaded_file($_FILES['file_foto_usaha']['tmp_name'], 'img/' . $file_foto_usaha);
    move_uploaded_file($_FILES['file_surat_sempadan']['tmp_name'], 'dokumen/' . $file_surat_sempadan);
    move_uploaded_file($_FILES['file_surat_pernyataan_usaha']['tmp_name'], 'dokumen/' . $file_surat_pernyataan_usaha);

    // Menyimpan data ke dalam tabel data_usaha
    $query_insert = mysqli_query($koneksi, "INSERT INTO data_usaha (nik, nama, user_id, memiliki_usaha, usaha_sejak, alamat_usaha, keperluan, pengantar, file_ktp_kk, file_foto_usaha, file_surat_sempadan, file_surat_pernyataan_usaha) VALUES ('$nik', '$nama', '$user_id', '$memiliki_usaha', '$usaha_sejak', '$alamat_usaha', '$keperluan', '$pengantar', '$file_ktp_kk', '$file_foto_usaha', '$file_surat_sempadan', '$file_surat_pernyataan_usaha')") or die(mysqli_error($koneksi));

    if ($query_insert) {
        echo "<script>alert('Data berhasil disimpan.');window.location='usaha-index.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }

}

?>

<?php
include('../../templates/footer.php');
?>
