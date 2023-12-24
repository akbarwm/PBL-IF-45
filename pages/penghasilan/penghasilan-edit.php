<?php
include('../../templates/header.php');
include('../../templates/sidebar.php');
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Halaman Edit Keterangan Penghasilan</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <?php
    include('../../config/koneksi.php');

    // Periksa apakah ID ada dalam URL
    if (isset($_GET['id'])) {
      $id = $_GET['id'];

      // Periksa apakah data dengan ID tertentu ada di database
      $data = mysqli_query($koneksi, "SELECT * FROM data_penghasilan WHERE id = '$id'");
      $row = mysqli_fetch_assoc($data);

      // Pastikan data ditemukan sebelum melanjutkan
      if ($row) {
    ?>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Data</h3>
          </div>
          <div class="card-body">
            <form action="" method="post" role="form" enctype="multipart/form-data">
              <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required="" value="<?= $row['nama']; ?>" readonly>
              </div>

              <!-- Tambahkan input yang lain sesuai kebutuhan -->

              <h3 style="padding-top: 10px;">Update Data Penghasilan</h3>
              <div class="form-group">
                <label>Penghasilan Perbulan </label>
                <input type="text" name="gaji" class="form-control" required="" onkeyup="formatInputRupiah(this)" value="<?= $row['gaji']; ?>">
              </div>
              <div class="form-group">
                <label>Tanggungan Keluarga/Anak Sejumlah </label>
                <input type="text" name="tanggungan" class="form-control" required="" value="<?= $row['tanggungan']; ?>">
              </div>
              <h3 style="padding-top: 10px;">Data Anak</h3>
              <div class="form-group">
                <label>Nama </label>
                <input type="text" name="nama_anak" class="form-control" required="" value="<?= $row['nama_anak']; ?>">
              </div>
              <div class="form-group">
                <label>Tempat Lahir </label>
                <input type="text" name="tempat_lahir_anak" class="form-control" required="" value="<?= $row['tempat_lahir_anak']; ?>">
              </div>
              <div class="form-group">
                <label>Tanggal Lahir </label>
                <input type="date" name="tanggal_lahir_anak" class="form" required="" value="<?= $row['tanggal_lahir_anak']; ?>">
              </div>
              <div class="form-group">
                <label>Sekolah/Perguruan Tinggi/Tempat Pendidikan</label>
                <input type="text" name="pendidikan" class="form-control" required="" value="<?= $row['pendidikan']; ?>">
              </div>
              <div class="form-group">
                <label>Jurusan </label>
                <input type="text" name="jurusan_anak" class="form-control" required="" value="<?= $row['jurusan_anak']; ?>">
              </div>
              <div class="form-group">
                <label>Hubungan Keluarga </label>
                <input type="text" name="hubungan_keluarga" class="form-control" required="" value="<?= $row['hubungan_keluarga']; ?>">
              </div>

              <h3 style="padding-top: 10px;">Keperluan</h3>
              <div class="form-group">
                <label>Keperluan </label>
                <input type="text" name="keperluan" class="form-control" required="" value="<?= $row['keperluan']; ?>">
              </div>
              <!-- Inside your form -->
              <div class="form-group">
                  <label>Status Validasi</label>
                  <?php
                  // Cek hak akses admin
                  if ($_SESSION['hak_akses'] === 'admin') {
                  ?>
                      <select class="form-control col-sm-4 select2" name="status_data" required="">
                          <option value="Proses" <?= ($row['status_data'] == 'Proses') ? 'selected' : ''; ?>>Proses</option>
                          <option value="Selesai" <?= ($row['status_data'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                          <option value="Ditolak" <?= ($row['status_data'] == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                      </select>
                  <?php
                  } else {
                      // Jika bukan admin, tampilkan status data readonly atau sesuai kebutuhan
                      echo "";
                  }
                  ?>
              </div>
              <div class="form-group">
              <label>Pilih Pegawai</label>
              <select class="form-control col-sm-4 select2" name="pegawai" required="">
                <option value="">Pilih Pegawai</option>
                <?php
                // Mengambil data pegawai dari database
                $queryPegawai = mysqli_query($koneksi, "SELECT `nip`, `nama`, `jabatan` FROM `data_pegawai`");
                while ($rowPegawai = mysqli_fetch_assoc($queryPegawai)) {
                  ?>
                  <option value="<?= $rowPegawai['nip']; ?>" <?= ($row['nip_pegawai'] == $rowPegawai['nip']) ? 'selected' : ''; ?>>
                    <?= $rowPegawai['nama']; ?> - <?= $rowPegawai['jabatan']; ?>
                  </option>
                <?php
                }
                ?>
              </select>
              <?php
              // Tambahkan kondisi untuk hak akses admin
              if ($_SESSION['hak_akses'] !== 'admin') {
                echo "<small>Anda tidak memiliki izin untuk mengubah pegawai.</small>";
              }
              ?>
            </div>
              <div class="form-group">
                <label>Keterangan</label>
                <?php
                  // Cek hak akses admin
                  if ($_SESSION['hak_akses'] === 'admin') {
                  ?>
                      <input type="text" name="keterangan" class="form-control" required="" value="<?= $row['keterangan']; ?>">
                  <?php
                  } else {
                      // Jika bukan admin, tampilkan status data readonly
                      echo "<input type='text' class='form-control' value='{$row['keterangan']}' readonly>";
                  }
                  ?>
              </div>
              <h3 style="padding-top: 10px;">Upload Ulang /File</h3>
              <div class="form-group">
                  <label>Foto KTP/KK</label>
                  <input type="file" name="file_ktp_kk" class="form-control">
              </div>
              <div class="form-group">
                  <label>File Surat Pernyataan Penghasilan</label>
                  <input type="file" name="pernyataan_penghasilan" class="form-control">
                </div>
              <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
            </form>
          </div>  

        <?php
        // Jika tombol submit diklik
        if (isset($_POST['submit'])) {
          // Ambil data dari formulir
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
            $status_data = $_POST['status_data'];
            $pegawai_nip = $_POST['pegawai'];
            $keterangan = $_POST['keterangan'];
            $pengantar = isset($_POST['pengantar']) ? $_POST['pengantar'] : '';

            if ($_FILES['file_ktp_kk']['name'] != '') {
                $file_ktp_kk = $_FILES['file_ktp_kk']['name'];
                $file_tmp = $_FILES['file_ktp_kk']['tmp_name'];
            
                // Tentukan direktori penyimpanan file
                $upload_dir = "img/";
                $target_file = $upload_dir . $file_ktp_kk;
            
                // Pindahkan file ke direktori upload
                move_uploaded_file($file_tmp, $target_file);
            
                // Update nama file dalam database
                $query_update_file = "UPDATE data_penghasilan SET file_ktp_kk = '$file_ktp_kk' WHERE id = '$id'";
                mysqli_query($koneksi, $query_update_file);
        }
            if ($_FILES['pernyataan_penghasilan']['name'] != '') {
                $pernyataan_penghasilan = $_FILES['pernyataan_penghasilan']['name'];
                $file_tmp = $_FILES['pernyataan_penghasilan']['tmp_name'];
            
                // Tentukan direktori penyimpanan file
                $upload_dir = "dokumen/";
                $target_file = $upload_dir . $pernyataan_penghasilan;
            
                // Pindahkan file ke direktori upload
                move_uploaded_file($file_tmp, $target_file);
            
                // Update nama file dalam database
                $query_update_file = "UPDATE data_penghasilan SET pernyataan_penghasilan = '$pernyataan_penghasilan' WHERE id = '$id'";
                mysqli_query($koneksi, $query_update_file);
        }          
            // Ambil data pegawai yang dipilih dari dropdown
            $pegawai_nip = $_POST['pegawai']; // NIP pegawai terpilih dari dropdown

            // Mengambil data pegawai dari database berdasarkan NIP yang terpilih
            $queryPegawai = mysqli_query($koneksi, "SELECT `nip`, `nama`, `jabatan` FROM `data_pegawai` WHERE `nip` = '$pegawai_nip'");
            $dataPegawai = mysqli_fetch_assoc($queryPegawai);
  
            // Menyimpan data pegawai ke variabel
            $nip_pegawai = $dataPegawai['nip'];
            $nama_pegawai = $dataPegawai['nama'];
            $jabatan_pegawai = $dataPegawai['jabatan'];
            

          // Query untuk mengupdate data
          $query = "UPDATE data_penghasilan SET 
                    gaji = '$gaji',
                    tanggungan = '$tanggungan', 
                    nama_anak = '$nama_anak',
                    tempat_lahir_anak = '$tempat_lahir_anak',
                    tanggal_lahir_anak = '$tanggal_lahir_anak',
                    pendidikan = '$pendidikan',
                    jurusan_anak = '$jurusan_anak',
                    hubungan_keluarga = '$hubungan_keluarga',
                    keperluan = '$keperluan',
                    status_data = '$status_data',
                    nip_pegawai = '$nip_pegawai', 
                    nama_pegawai = '$nama_pegawai', 
                    jabatan_pegawai = '$jabatan_pegawai',
                    keterangan = '$keterangan'
                    WHERE id = '$id'";

          // Eksekusi query
          $result = mysqli_query($koneksi, $query);

          // Periksa apakah query berhasil dijalankan
          if ($result) {
            echo "<script>alert('Data berhasil diubah.');window.location='penghasilan-index.php';</script>";
          } else {
            echo "Error: " . mysqli_error($koneksi);
          }
        }
        ?>
    <?php
      } else {
        echo "Data tidak ditemukan.";
      }
    } else {
      echo "ID tidak ditemukan.";
    }
    ?>
  </section>
</div>

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
