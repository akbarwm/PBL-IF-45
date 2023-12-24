  <?php
  include('../../templates/header.php');
  include('../../templates/sidebar.php');

  ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Edit Keterangan Usaha</h1>
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
        $data = mysqli_query($koneksi, "SELECT * FROM data_usaha WHERE id = '$id'");
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
                  <label>NIK</label>
                  <input type="text" name="nik" class="form-control" required="" value="<?= $row['nik']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" required="" value="<?= $row['nama']; ?>" readonly>
                </div>

                <!-- Tambahkan input yang lain sesuai kebutuhan -->

                <h3 style="padding-top: 10px;">Detail Data Usaha</h3>
                <div class="form-group">
                  <label>Memiliki Usaha </label>
                  <input type="text" name="memiliki_usaha" class="form-control" required="" value="<?= $row['memiliki_usaha']; ?>">
                </div>
                <div class="form-group">
                  <label>Usaha Sejak </label>
                  <input type="text" name="usaha_sejak" class="form-control" required="" value="<?= $row['usaha_sejak']; ?>">
                </div>
                <div class="form-group">
                  <label>Alamat Usaha </label>
                  <input type="text" name="alamat_usaha" class="form-control" required="" value="<?= $row['alamat_usaha']; ?>">
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
                   <div class="form-group">
                    <label>Pilih Pegawai</label>
                    <select class="form-control col-sm-4" name="pegawai_id" <?php echo ($_SESSION['hak_akses'] !== 'admin') ? 'readonly disabled' : ''; ?>>
                        <option value="">Pilih Pegawai</option>
                        <?php
                        if ($_SESSION['hak_akses'] === 'admin') {
                            $pegawaiData = mysqli_query($koneksi, "SELECT nip, nama, jabatan FROM data_pegawai") or die(mysqli_error($koneksi));
                            while ($pegawai = mysqli_fetch_assoc($pegawaiData)) {
                        ?>
                                <option value="<?= $pegawai['nip']; ?>" <?php echo ($row['nip_pegawai'] == $pegawai['nip']) ? 'selected' : ''; ?>><?= $pegawai['nama']; ?> - <?= $pegawai['jabatan']; ?></option>
                        <?php
                            }
                        } else {
                            // Jika bukan admin, tampilkan sebagai readonly
                            echo "<option disabled selected>Anda tidak memiliki akses untuk memilih pegawai</option>";
                        }
                        ?>
                    </select>
                </div>

                </div>
                <div class="form-group">
                <label>Keterangan</label>
                <?php
                // Cek hak akses admin
                if ($_SESSION['hak_akses'] === 'admin') {
                ?>
                    <input type="text" name="keterangan" class="form-control" required="" value="<?= $row['keterangan']; ?>">
                <?php
                } elseif ($_SESSION['hak_akses'] === 'penduduk') {
                    // Jika bukan admin, tampilkan status data readonly
                    echo "<input type='text' class='form-control' value='{$row['keterangan']}' readonly>";
                }
                ?>
                  </div>
                <h3 style="padding-top: 10px;">Upload Ulang Gambar</h3>
                <div class="form-group">
                    <label>Foto KTP/KK</label>
                    <input type="file" name="file_ktp_kk" class="form-control">
                </div>
                <div class="form-group">
                    <label>Foto Tempat Usaha</label>
                    <input type="file" name="file_foto_usaha" class="form-control">
                </div>
                <div class="form-group">
                    <label>File Surat Sempadan</label>
                    <input type="file" name="file_surat_sempadan" class="form-control">
                </div>
                <div class="form-group">
                    <label>File Surat Pengantar Usaha</label>
                    <input type="file" name="file_surat_pernyataan_usaha" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
              </form>
            </div>
          </div>

          <?php
          // Jika tombol submit diklik
          if (isset($_POST['submit'])) {
            // Ambil data dari formulir
            $id = $_POST['id'];
            $memiliki_usaha = $_POST['memiliki_usaha'];
            $usaha_sejak = $_POST['usaha_sejak'];
            $alamat_usaha = $_POST['alamat_usaha'];
            $keperluan = $_POST['keperluan'];
            $status_data = $_POST['status_data'];
            $pegawai_nip = $_POST['pegawai_id'];
            $keterangan = $_POST['keterangan'];

            if ($_FILES['file_ktp_kk']['name'] != '') {
              $file_ktp_kk = $_FILES['file_ktp_kk']['name'];
              $file_tmp = $_FILES['file_ktp_kk']['tmp_name'];
          
              // Tentukan direktori penyimpanan file
              $upload_dir = "img/";
              $target_file = $upload_dir . $file_ktp_kk;
          
              // Pindahkan file ke direktori upload
              move_uploaded_file($file_tmp, $target_file);
          
              // Update nama file dalam database
              $query_update_file = "UPDATE data_usaha SET file_ktp_kk = '$file_ktp_kk' WHERE id = '$id'";
              mysqli_query($koneksi, $query_update_file);
          }
          if ($_FILES['file_foto_usaha']['name'] != '') {
            $file_foto_usaha = $_FILES['file_foto_usaha']['name'];
            $file_tmp = $_FILES['file_foto_usaha']['tmp_name'];
        
            // Tentukan direktori penyimpanan file
            $upload_dir = "img/";
            $target_file = $upload_dir . $file_foto_usaha;
        
            // Pindahkan file ke direktori upload
            move_uploaded_file($file_tmp, $target_file);
        
            // Update nama file dalam database
            $query_update_file = "UPDATE data_usaha SET file_foto_usaha = '$file_foto_usaha' WHERE id = '$id'";
            mysqli_query($koneksi, $query_update_file);
        }
        if ($_FILES['file_surat_sempadan']['name'] != '') {
          $file_surat_sempadan = $_FILES['file_surat_sempadan']['name'];
          $file_tmp = $_FILES['file_surat_sempadan']['tmp_name'];
      
          // Tentukan direktori penyimpanan file
          $upload_dir = "dokumen/";
          $target_file = $upload_dir . $file_surat_sempadan;
      
          // Pindahkan file ke direktori upload
          move_uploaded_file($file_tmp, $target_file);
      
          // Update nama file dalam database
          $query_update_file = "UPDATE data_usaha SET file_surat_sempadan = '$file_surat_sempadan' WHERE id = '$id'";
          mysqli_query($koneksi, $query_update_file);
      }
      if ($_FILES['file_surat_pernyataan_usaha']['name'] != '') {
        $file_surat_pernyataan_usaha = $_FILES['file_surat_pernyataan_usaha']['name'];
        $file_tmp = $_FILES['file_surat_pernyataan_usaha']['tmp_name'];
    
        // Tentukan direktori penyimpanan file
        $upload_dir = "dokumen/";
        $target_file = $upload_dir . $file_surat_pernyataan_usaha;
    
        // Pindahkan file ke direktori upload
        move_uploaded_file($file_tmp, $target_file);
    
        // Update nama file dalam database
        $query_update_file = "UPDATE data_usaha SET file_surat_pernyataan_usaha = '$file_surat_pernyataan_usaha' WHERE id = '$id'";
        mysqli_query($koneksi, $query_update_file);
    }    
          // Mengambil data pegawai dari database berdasarkan NIP yang terpilih
    $queryPegawai = mysqli_query($koneksi, "SELECT `nip`, `nama`, `jabatan` FROM `data_pegawai` WHERE `nip` = '$pegawai_nip'");
    $dataPegawai = mysqli_fetch_assoc($queryPegawai);

    // Menyimpan data pegawai ke variabel
    $nip_pegawai = $dataPegawai['nip'];
    $nama_pegawai = $dataPegawai['nama'];
    $jabatan_pegawai = $dataPegawai['jabatan'];


            // Query untuk mengupdate data
            $query = "UPDATE data_usaha SET 
                memiliki_usaha = '$memiliki_usaha', 
                usaha_sejak = '$usaha_sejak', 
                alamat_usaha = '$alamat_usaha', 
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
              echo "<script>alert('Data berhasil diubah.');window.location='usaha-index.php';</script>";
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

  <?php
  include('../../templates/footer.php');
  ?>
