<?php
include('../../templates/header.php');
include('../../templates/sidebar.php');

?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Halaman Edit Keterangan Domisili</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <?php
    include('../../config/koneksi.php');
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $data = mysqli_query($koneksi, "SELECT * FROM data_domisili WHERE id = '$id'");
      $row = mysqli_fetch_assoc($data);
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
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" required="" value="<?= $row['tempat_lahir']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" required="" value="<?= $row['tgl_lahir']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="jenis_kelamin" class="form-control" required="" value="<?= $row['jenis_kelamin']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <input type="text" name="agama" class="form-control" required="" value="<?= $row['agama']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label><br>
                    <input type="text" name="alamat" class="form-control" required="" value="<?= $row['alamat']; ?>" readonly>
                </div>

              <h3 style="padding-top: 10px;">Keperluan</h3>
              <div class="form-group">
                <label>Keperluan </label>
                <input type="text" name="keperluan" class="form-control" required="" value="<?= $row['keperluan']; ?>">
              </div>
               <div class="form-group">
                <label>Status Data: </label>
              <?php
                    if ($_SESSION['hak_akses'] === 'admin') {
                    ?>
                        <select class="form-control col-sm-4 select2" name="status_data" required="">
                            <option value="Proses" <?= ($row['status_data'] == 'Proses') ? 'selected' : ''; ?>>Proses</option>
                            <option value="Selesai" <?= ($row['status_data'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                            <option value="Ditolak" <?= ($row['status_data'] == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                        </select>
                    <?php
                    } elseif ($_SESSION['hak_akses'] === 'penduduk') {
                        // Untuk penduduk, tampilkan nilai status validasi yang ada sebagai readonly
                        echo "<input type='text' class='form-control' value='{$row['status_data']}' readonly>";
                    }
                    ?>
                    </div>
                <div class="form-group">
                    <label>Pilih Pegawai</label>
                    <?php
                    if ($_SESSION['hak_akses'] === 'admin') {
                        ?>
                        <select class="form-control col-sm-4" name="pegawai">
                            <option value="">Pilih Pegawai</option>
                            <?php
                            $pegawaiData = mysqli_query($koneksi, "SELECT nip, nama, jabatan FROM data_pegawai") or die(mysqli_error($koneksi));
                            while ($pegawai = mysqli_fetch_assoc($pegawaiData)) {
                                ?>
                                <option value="<?= $pegawai['nip']; ?>" <?php echo ($row['nip_pegawai'] == $pegawai['nip']) ? 'selected' : ''; ?>><?= $pegawai['nama']; ?> - <?= $pegawai['jabatan']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php
                    } else {
                        echo "<input type='text' class='form-control' value='{$row['nama_pegawai']} - {$row['jabatan_pegawai']}' readonly>";
                    }
                    ?>
                </div>
              <div class="form-group">
                <label>Keterangan</label>
                <?php
                  if ($_SESSION['hak_akses'] === 'admin') {
                  ?>
                      <input type="text" name="keterangan" class="form-control" required="" value="<?= $row['keterangan']; ?>">
                  <?php
                  } else {
                      echo "<input type='text' class='form-control' value='{$row['keterangan']}' readonly>";
                  }
                  ?>
              <h3 style="padding-top: 10px;">Upload Ulang Gambar</h3>
              <div class="form-group">
                  <label>Foto KTP/KK</label>
                  <input type="file" name="file_ktp_kk" class="form-control">
              </div>

              <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
            </form>
          </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
          $id = $_POST['id'];
          $keperluan = $_POST['keperluan'];
          $status_data = $_POST['status_data'];
          $pegawai = $_POST['pegawai'];
          $keterangan = $_POST['keterangan'];

          if ($_FILES['file_ktp_kk']['name'] != '') {
            $file_ktp_kk = $_FILES['file_ktp_kk']['name'];
            $file_tmp = $_FILES['file_ktp_kk']['tmp_name'];
            $upload_dir = "img/";
            $target_file = $upload_dir . $file_ktp_kk;
            move_uploaded_file($file_tmp, $target_file);

            
            $query_update_file = "UPDATE data_domisili SET file_ktp_kk = '$file_ktp_kk' WHERE id = '$id'";
            
            mysqli_query($koneksi, $query_update_file);
        }
          $pegawai_nip = $_POST['pegawai'];
          $queryPegawai = mysqli_query($koneksi, "SELECT `nip`, `nama`, `jabatan` FROM `data_pegawai` WHERE `nip` = '$pegawai_nip'");
          $dataPegawai = mysqli_fetch_assoc($queryPegawai);
          $nip_pegawai = $dataPegawai['nip'];
          $nama_pegawai = $dataPegawai['nama'];
          $jabatan_pegawai = $dataPegawai['jabatan'];
          $query = "UPDATE data_domisili SET 
                    keperluan = '$keperluan',
                    status_data = '$status_data',
                    nip_pegawai = '$nip_pegawai', 
                    nama_pegawai = '$nama_pegawai', 
                    jabatan_pegawai = '$jabatan_pegawai', 
                    keterangan = '$keterangan'
                    WHERE id = '$id'";
          $result = mysqli_query($koneksi, $query);
          if ($result) {
            echo "<script>alert('Data berhasil diubah.');window.location='domisili-index.php';</script>";
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
