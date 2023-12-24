<?php
include('../../templates/header.php');
include('../../templates/sidebar.php');
include('../../config/koneksi.php');

if (!isset($_SESSION['user_id'])) {
    header("location: ../../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query_penduduk = mysqli_query($koneksi, "SELECT * FROM login_penduduk WHERE id = '$user_id'");
$data_penduduk = mysqli_fetch_assoc($query_penduduk);
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Tambah Keterangan Penghasilan</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" required="" value="<?= $data_penduduk['nik']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required="" value="<?= $data_penduduk['nama']; ?>" readonly>
                    </div>
                    <h3 style="padding-top: 10px;">Tambah Data Penghasilan</h3>
                    <div class="form-group">
                        <label>Penghasilan Perbulan</label>
                        <input type="text" name="gaji" class="form-input" required="" onkeyup="formatInputRupiah(this)">
                    </div>
                    <div class="form-group">
                        <label>Tanggungan Keluarga/Anak Sejumlah</label>
                        <input type="text" name="tanggungan" class="form-control" required="">
                    </div>
                    <h3 style="padding-top: 10px;">Data Anak</h3>
                    <div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama_anak" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir_anak" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir_anak" class="form" required="">
                    </div>
                    <div class="form-group">
                        <label>Sekolah/Perguruan Tinggi/Tempat Pendidikan</label>
                        <input type="text" name="pendidikan" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan_anak" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Hubungan Keluarga</label>
                        <input type="text" name="hubungan_keluarga" class="form-control" required="">
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
                    <div class="form-group">
                        <label>Foto KTP/KK</label><p>(File dalam bentuk .jpg/.jpeg/.png)</p>
                        <input type="file" name="file_ktp_kk" class="form-control" accept = ".jpg, .jpeg, .png" required>
                    </div>
                    <div class="form-group">
                        <label>Surat Pernyataan Penghasilan</label><p>(File dalam bentuk .docx/.pdf)</p>
                        <input type="file" name="pernyataan_penghasilan" class="form-control" accept = ".docx, .pdf" required>
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
    $gaji = str_replace(['RP ', '.', ','], ['', '', ''], $_POST['gaji']);
    $gaji = floatval($gaji);
    $tanggungan = $_POST['tanggungan'];
    $nama_anak = $_POST['nama_anak'];
    $tempat_lahir_anak = $_POST['tempat_lahir_anak'];
    $tanggal_lahir_anak = $_POST['tanggal_lahir_anak'];
    $pendidikan = $_POST['pendidikan'];
    $jurusan_anak = $_POST['jurusan_anak'];
    $hubungan_keluarga = $_POST['hubungan_keluarga'];
    $keperluan = $_POST['keperluan'];
    $pengantar = $_POST['pengantar'];

    // Mengambil ekstensi file
    $ekstensi_ktp = pathinfo($_FILES['file_ktp_kk']['name'], PATHINFO_EXTENSION);
    $ekstensi_pernyataan_penghasilan = pathinfo($_FILES['pernyataan_penghasilan']['name'], PATHINFO_EXTENSION);

    // Membuat nama file unik untuk menghindari konflik nama
    $file_ktp_kk = uniqid('ktp_kk_') . '.' . $ekstensi_ktp;
    $pernyataan_penghasilan = uniqid('pernyataan_penghasilan_') . '.' . $ekstensi_pernyataan_penghasilan;

    // Move uploaded files to the correct directory
    move_uploaded_file($_FILES['file_ktp_kk']['tmp_name'], 'img/' . $file_ktp_kk);
    move_uploaded_file($_FILES['pernyataan_penghasilan']['tmp_name'], 'dokumen/' . $pernyataan_penghasilan);
    
    $query_insert = mysqli_query($koneksi, "INSERT INTO data_penghasilan (nik, nama, user_id, gaji, tanggungan, nama_anak, tempat_lahir_anak, tanggal_lahir_anak, pendidikan, jurusan_anak, hubungan_keluarga, keperluan, pengantar, file_ktp_kk, pernyataan_penghasilan) VALUES ('$nik', '$nama', '$user_id', '$gaji', '$tanggungan', '$nama_anak', '$tempat_lahir_anak', '$tanggal_lahir_anak', '$pendidikan', '$jurusan_anak', '$hubungan_keluarga', '$keperluan', '$pengantar', '$file_ktp_kk', '$pernyataan_penghasilan')") or die(mysqli_error($koneksi));

    if ($query_insert) {
        echo "<script>alert('Data berhasil disimpan.');window.location='penghasilan-index.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }

}

?>

<script>
  // Fungsi untuk memformat angka menjadi format Rupiah
  function formatRupiah(angka) {
    var number_string = angka.toString();
    var split = number_string.split(',');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return 'RP ' + rupiah;
  }

  // Fungsi untuk memformat input secara otomatis saat diketik
  function formatInputRupiah(input) {
    var value = input.value.replace(/[^\d]/g, '');
    input.value = formatRupiah(value);
  }
</script>

<?php
include('../../templates/footer.php');
?>
